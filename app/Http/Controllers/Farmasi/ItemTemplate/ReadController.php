<?php

namespace App\Http\Controllers\Farmasi\ItemTemplate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use stdClass;

class ReadController extends Controller
{

    public function search(Request $request)
    {
         $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
        if($search == "NOT")    $search = strtolower($search);
        $jenis = $request->get('jenis') ? strtolower($request->get('jenis')) : 0;
                
        if(!empty($search)) 
            $item = ItemsTemplate::search($search)->rule(\App\SearchRule\FarmasiItems::class);
        else
            $item = ItemsTemplate::latest();

        if($jenis) 
            $item = $item->where('jenis',$jenis);
        return $item->paginate(20);
    }

    public function single($id)
    {
        return ItemsTemplate::find($id);
    }

    public function getByIds($ids, $eager = [])
    {
        if(is_numeric($ids)) $ids = [$ids];
        return ItemsTemplate::with($eager)->whereIn('id',$ids)->get();
    }

    public function select2Search(Request $request)
    {
        $search = $request->keyword;
        $limit = $request->limit ?? 10;
        $page = $request->page;

        $query = ItemsTemplate::with([])
            ->where('nama', 'like', '%' . $search . '%')
            ->offset(($page - 1) * $limit)
            ->limit($limit);

        $results = $query->get();
        $results_formatted = $results->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        });

        return json_encode([
            'results' => $results_formatted,
            'pagination' => (object) [
                'more' => $results->count() == $limit,
            ]
        ]);
    }

    public function select2GetSelected($array_ids)
    {
        $data = ItemsTemplate::whereIn('id', $array_ids)->get();
        $data_formatted = $data->map(function($item){
            return [
                'id' => $item->id,
                'text' => $item->nama,
            ];
        });

        return $data_formatted;
    }

    public function getNonGenerikFormularium($kategori_generik, $kategori_formularium)
    {
        $query = "
            SELECT DISTINCT(template.id) as id
            FROM item_template template
            WHERE NOT EXISTS (
                SELECT * FROM items_kategori kategori
                WHERE kategori.item_template_id = template.id
                AND kategori.kategori_id = $kategori_generik
                AND kategori.deleted_at IS NULL
            )
            AND EXISTS (
                SELECT * FROM items_kategori kategori
                WHERE kategori.item_template_id = template.id
                AND kategori.kategori_id = $kategori_formularium
                AND kategori.deleted_at IS NULL
            )
        ";

        $data = DB::connection('farmasi')->select($query);
        return $data;
    }

    public function getNonGenerikNonFormularium($kategori_generik, $kategori_formularium)
    {
        $query = "
            SELECT DISTINCT(template.id) as id
            FROM item_template template
            WHERE NOT EXISTS (
                SELECT * FROM items_kategori kategori
                WHERE kategori.item_template_id = template.id
                AND kategori.kategori_id = $kategori_generik
                AND kategori.deleted_at IS NULL
            )
            AND NOT EXISTS (
                SELECT * FROM items_kategori kategori
                WHERE kategori.item_template_id = template.id
                AND kategori.kategori_id = $kategori_formularium
                AND kategori.deleted_at IS NULL
            )
        ";

        $data = DB::connection('farmasi')->select($query);
        return $data;
    }

    public function getItemKategori($slug)
    {
        $kategori = Kategori::where('slug',$slug)->pluck('id')->toArray();
        $items_kategori = ItemsKategori::whereIn('kategori_id',$kategori)->pluck('item_template_id')->toArray();
        $item_template = ItemsTemplate::whereIn('id',$items_kategori)->get();
        return $item_template;
    }
}
