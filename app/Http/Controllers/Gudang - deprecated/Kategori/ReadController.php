<?php

namespace App\Http\Controllers\Gudang\Kategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Kategori;
use App\Models\Gudang\ItemsKategori;
use Illuminate\Http\Response;

class ReadController extends Controller
{
    public function getAll()
    {
	    $kategori = Kategori::latest()->get();    		
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
        $kategori = Kategori::where('slug', $slug)->first();

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
}
