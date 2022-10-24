<?php

namespace App\Http\Controllers\Gudang\LogDistribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\LogDistribusi;
use DB;
use Response;

class ReadController extends Controller
{
    public function getAll()
    {
    	$log = ItemsRecord::whereHas('transaction_detail', function($query) {
            $query->where('status', 1);
        })->latest()->with('item_detail')->with('transaction_detail.client_detail')->with('transaction_detail')->get();
        //dd($log);
    	return json_encode(['data' => $log, 'count' => count($log)]);
    }

    public function getPage($page)
    {
        $log = ItemsRecord::orderBy('created_at','desc')->with('item_detail')->with('transaction_detail.seller_detail')->with('transaction_detail.buyer_detail')->whereHas('transaction_detail', function($query) {
            $query->where('status', 1);
        })->skip($page*20)->take(20)->get();
        //dd($log);
        $count = count(ItemsRecord::whereHas('transaction_detail', function($query) {
            $query->where('status', 1);
        })->get());
        return json_encode(['data' => $log, 'count' => $count]);
    }

    public function getPurchase($id)
    {
        $purchase = ItemsRecord::where('log_in',$id)->with('out_detail')->with('out_detail.transaction_detail')->with('out_detail.transaction_detail.buyer_detail')->get();
        //dd($history);
        return json_encode($purchase);
    }

    public function getItemRecord($id, $page)
    {
    	$history = ItemsRecord::where('item_id',$id)->whereHas('transaction_detail', function($query) {
            $query->where('status', 1);
        })->with('item_detail')->with('transaction_detail.seller_detail')->with('transaction_detail.buyer_detail')->latest()->skip($page*10)->take(10)->get();
        $count = ItemsRecord::where('item_id',$id)->with('item_detail')->whereHas('transaction_detail' , function($query) {
            $query->where('status', 1);
        })->get();
        $count = count($count);
        //dd($history);
    	return json_encode(['data' => $history, 'count' => $count]);
    }

    public function getFilter($page)
    {
        $input = request()->all();        
        
        $response = new Response();
        $result = ItemsRecord::query();

        try {
            if($input['min_qty'])
            {
                $result->where('qty', '>=', $input['min_qty']);
            }
            if($input['max_qty'])
            {
                $result->where('qty', '<=', $input['max_qty']);
            }
            if($input['min_date'])
            {
                $min_date = new DateTime($input['min_date']);
                $result->where('created_at', '>=', $min_date->format('Y-m-d'));
            }
            if($input['max_date'])
            {
                $max_date = new DateTime($input['max_date']);
                $result->where('created_at', '<=', $max_date->format('Y-m-d'));
            }
            if($input['jenis'])
            {
                $result->whereHas('transaction_detail', function($det) use($input){
                    $det->where('type', $input['jenis']);
                });
            }
            if($input['barang'])
            {
                $result->whereHas('item_detail', function($det) use($input){
                    $det->where('id', $input['barang']);
                });
            }
            if($input['client'])
            {
                $result->whereHas('transaction_detail', function($det) use($input){
                    $det->where('client', $input['client']);
                });                
            }
            $count = count($result->get());
            $result = $result->latest()->with('item_detail')->with('transaction_detail.seller_detail')->with('transaction_detail.buyer_detail')->whereHas('transaction_detail')->skip($page*20)->take(20)->get();

        } catch (Exception $e) {
            return $response->setStatusCode(500, 'Query Error');
        }
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return json_encode(['data' => $result, 'count' => $count, 'input' => $input]);
    }

    public function getOld($id)
    {
        $old = ItemsRecord::where('transaction_id',$id)->where('original',1)->with('item_detail')->withTrashed()->get();
        //dd($history);
        return json_encode(['data' => $old]);
    }
}
