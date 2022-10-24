<?php

namespace App\Http\Controllers\AlatMedis;

use App\Models\AlatMedis\Items;
use App\Models\Kasus\TransaksiAlatMedis;
use DB;
use Illuminate\Http\Request;
use App\Models\Kasus\ItemAlatMedis;
use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;
use Illuminate\Database\Eloquent\Builder;
use DataTables;
use Session;

class ReadController extends Controller
{
    public function getAlatMedis($value='')
    {
    	$data = ItemsTemplate::select('id', 'name')
    						->withCount([
							'itemAlatMedis' => function (Builder $query) {
							    $query->where('status', '0');
							}])
							->get();

		return $data;
    }

    public function viewsAlatMedis($value='')
    {
    	$data = ItemsTemplate::select(DB::raw('items_template.id,
    											name,
    											count(*) as total, 
    											sum(case when status = 0 then 1 else 0 end) AS tersedia'))
    						->join('items', 'items_template.id', '=', 'items.items_template_id')
    						->groupBy('items_template_id')
							->get();
        // dd($data);
		return $data;
    }
    public function getJsonItemsTemplate(Request $request)
    {
        $itemtemplate = ItemsTemplate::query();
        return DataTables::of($itemtemplate)
            ->addColumn('jumlah', function ($itemtemplate) {
                $id_itemtemplate = $itemtemplate->id;
                $count_stock = count(Items::where('items_template_id', $id_itemtemplate)->get());
                return $count_stock;
            })
            ->filter(function ($query) use ($request) {
                if($request->input('search')['value']){
                    $query->orWhere('name', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('merk', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('model', 'LIKE', "%".$request->input('search')['value']."%");
                    $query->orWhere('description', 'LIKE', "%".$request->input('search')['value']."%");
                }
                if ($request->input('nama')) {
                    $query->where('name', 'like', "%{$request->input('nama')}%");
                }
                if ($request->input('merk')) {
                    $query->where('merk', 'like', "%{$request->input('merk')}%");
                }
                if ($request->input('model')) {
                    $query->where('model', 'like', "%{$request->input('model')}%");
                }
                if ($request->input('description')) {
                    $query->where('description', 'like', "%{$request->input('description')}%");
                }
            })
            ->make(true);
    }
    public function itemstemplateSingle($id)
    {
        if($itemtemplate = ItemsTemplate::where('slug',$id)->first()) {
            $item = ItemsTemplate::where('slug', $id)->get();
            return $item;
        }else{
            Session::flash('danger', "Item Template Tidak Ada");
            return redirect()->back();
        }
    }
    public function countStock($id)
    {
        if($itemtemplate = ItemsTemplate::where('slug',$id)->first()) {
            $count_stock = count(Items::where('items_template_id', $itemtemplate->id)->get());
            return $count_stock;
        }
    }
    public function getJsonItems($id)
    {
        if($itemtemplate = ItemsTemplate::where('slug',$id)->first()){
            $items = Items::where('items_template_id', $itemtemplate->id)->with(['itemstemplate','user','transaksi','transaksi.kasus'])->get();
            return DataTables::of($items)
                ->addColumn('pasien', function ($items) {
                    $last_index=$items->transaksi->last();
                    if(!empty($last_index)&&$items->status==1) {
                        $pasien = $last_index->kasus['pasien']['name'];
                    }elseif($items->status==0){
                        $pasien ='-';
                    }
                    return $pasien;
                })
                ->make();
        }else{
            $items = [];
            return DataTables::of($items)->make();
        }
    }
    public function countHistory($id_items)
    {
        if($items = Items::find($id_items)) {
            $count_history = count(TransaksiAlatMedis::where('item_id', $id_items)->with(['user', 'kasus'])->get());
            return $count_history;
        }
    }
    public function itemsTemplateHistory($id_items)
    {
        if($items = Items::find($id_items)) {
            $itemtemplate = ItemsTemplate::find($items->items_template_id);
            return $itemtemplate;
        }
    }
    public function itemsHistory($id_items)
    {
        if($items = Items::find($id_items)) {
            $items = Items::find($id_items);
            return $items;
        }
    }
    public function getJsonHistoryItems($id_items)
    {
        $transaksi = TransaksiAlatMedis::where('item_id',$id_items)->with(['user','kasus'])->orderBY('created_at','DESC')->get();
        return DataTables::of($transaksi)
            ->addColumn('pasien', function ($transaksi) {
                $pasien = $transaksi->kasus['pasien']['name'];
                return $pasien;
            })
            ->addColumn('location', function ($transaksi) {
                $location = $transaksi->kasus['lokasi']['lokasi']['nama'];
                return $location;
            })
            ->addColumn('created_at', function ($transaksi) {
                $created_at = date('d F Y, H:i', strtotime($transaksi->created_at));
                return $created_at;
            })
            ->make();
    }
}
