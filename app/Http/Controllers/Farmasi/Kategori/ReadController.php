<?php

namespace App\Http\Controllers\Farmasi\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsKategori;
use Illuminate\Http\Response;

class ReadController extends Controller
{
    public function getAll()
    {
	    $kategori = Kategori::groupBy('nama')->latest()->get();    		
    	return $kategori;
    }

    public function searchSupplier($key)
    {
        $response = new Response();
        $key = preg_replace("/[^[:alnum:][:space:]]/u", '', $key);
        try {
            $suppliers = Supplier::search($key)->get();         
        } catch (Exception $e) {
            return $response->setStatusCode(500, 'Supplier retrieve Failed');
        }
        return json_encode(['data' => $suppliers, 'count' => count($suppliers)]);
    }    

    public function getSingle($slug)
    {
        $kategori = Kategori::where('slug', $slug)->with('item.detail_item')->first();

        return $kategori;
    }

    public function getById($id)
    {
        $kategori = Kategori::find($id);

        return $kategori;
    }

    public function pluckSupplier()
    {
        try {
            $supplier = Supplier::pluck('nama', 'id');
        } catch (Exception $e) {
            return FALSE;
        }
        return $supplier;
    }

    public function getKategoriByManySlug($slugs)
    {
        $kategori = Kategori::whereIn('slug', $slugs)->with('item.detail_item')->get();

        return $kategori;
    }

    public function getItemTemplateIdByItemKategori($kategori_id)
    {
        $item_template_id = ItemsKategori::where('kategori_id',$kategori_id)->pluck('item_template_id')->toArray();

        return $item_template_id;
    }
}
