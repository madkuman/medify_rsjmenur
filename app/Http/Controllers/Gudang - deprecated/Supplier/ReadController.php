<?php

namespace App\Http\Controllers\Gudang\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Supplier;
use Illuminate\Http\Response;

class ReadController extends Controller
{
    public function getAll()
    {
	    $suppliers = Supplier::orderBy('created_at','desc')->get();    		
    	return $suppliers;
    }

    public function getPage($page)
    {
        $response = new Response();
        try {
            $suppliers = Supplier::orderBy('updated_at','desc')->skip($page*12)->take(12)->get();         
            $count = count(Supplier::get());
        } catch (Exception $e) {
            return $response->setStatusCode(500, 'Supplier retrieve Failed');
        }
        return json_encode(['data' => $suppliers, 'count' => $count]);
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
        $supplier = Supplier::where('slug', $slug)->first();
        //$history = app('App\Http\Controllers\Warehouse\Transaction\ReadController')->getTransactionBySupplier($supplier->id,0);
        //$history = json_decode($history);
        return $supplier;
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
