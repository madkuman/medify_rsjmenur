<?php

namespace App\Http\Controllers\AlatMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function createItemsTemplate(Request $req)
    {
        $itemstemplate = app('App\Http\Controllers\AlatMedis\CreateController')->createItemsTemplate($req);
        return redirect()->back();
    }
    public function editItemsTemplate(Request $req,$id)
    {
        $itemstemplate = app('App\Http\Controllers\AlatMedis\EditController')->editItemsTemplate($req,$id);
        return redirect()->back();
    }
    public function deleteItemsTemplate(Request $req,$id)
    {
        $itemstemplate = app('App\Http\Controllers\AlatMedis\DeleteController')->deleteItemsTemplate($req,$id);
        return redirect()->route('items.index');
    }
    public function createItems(Request $request,$id_items)
    {
        $items = app('App\Http\Controllers\AlatMedis\CreateController')->createItems($request,$id_items);
        return redirect()->back();
    }
    public function deleteItems(Request $request,$id_items)
    {
        $data['items'] = app('App\Http\Controllers\AlatMedis\DeleteController')->deleteItems($request,$id_items);
        return redirect()->route('alat-medis.item.detail',$data);
    }


}
