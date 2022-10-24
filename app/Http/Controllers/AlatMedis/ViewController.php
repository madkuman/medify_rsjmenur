<?php

namespace App\Http\Controllers\AlatMedis;

use DB;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function views($value='')
    {
    	$items = app('App\Http\Controllers\AlatMedis\ReadController')->viewsAlatMedis();
        
		return view('alat-medis.views', ['items' => $items, 'sidebar_active' => 'views']);
    }

    public function viewsJson($value='')
    {
    	$items = app('App\Http\Controllers\AlatMedis\ReadController')->viewsAlatMedis();

		return response()->json(['items'=>$items]);
    }
    public function index()
    {
        $sidebar_active = 'items';
        return view('alat-medis.item.index',compact('sidebar_active'));

    }
    public function itemstemplateSingle($id)
    {
        $data['sidebar_active']= 'items';
        $data['item'] = app('App\Http\Controllers\AlatMedis\ReadController')->itemstemplateSingle($id);
        $data['count_stock']=app('App\Http\Controllers\AlatMedis\ReadController')->countStock($id);
        return view('alat-medis.item.detail',$data);
    }
    public function itemsHistory($id_items)
    {
        $data['sidebar_active']= 'items';
        $data['itemtemplate'] = app('App\Http\Controllers\AlatMedis\ReadController')->itemsTemplateHistory($id_items);
        $data['items'] = app('App\Http\Controllers\AlatMedis\ReadController')->itemsHistory($id_items);
        $data['count_history']=app('App\Http\Controllers\AlatMedis\ReadController')->countHistory($id_items);
        return view('alat-medis.item.log',$data);
    }

}
