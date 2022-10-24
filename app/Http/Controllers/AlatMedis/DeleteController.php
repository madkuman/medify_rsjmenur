<?php

namespace App\Http\Controllers\AlatMedis;

use App\Http\Controllers\Controller;
use App\Models\AlatMedis\Items;
use App\Models\AlatMedis\ItemsTemplate;
use Illuminate\Http\Request;
use Session;
use File;
use Storage;

class DeleteController extends Controller
{
    public function deleteItemsTemplate($req)
    {
        if($itemtemplate = ItemsTemplate::find($req->id)) {

            if (File::exists($itemtemplate->image_ori)) {
                File::delete($itemtemplate->image_ori);
            }
            if (File::exists($itemtemplate->image_thumb)) {
                File::delete($itemtemplate->image_thumb);
            }
            $itemtemplate->delete();
            Session::flash('success', "Delete Item Template Success");
        }else{
            Session::flash('danger', "Delete Item Template Failed");
        }

        return $itemtemplate;
    }
    public function deleteItems($request,$id_items)
    {
        if($items = Items::find($request->id)) {
            $itemtemplate = ItemsTemplate::where('id',$items->items_template_id)->get();
            $itemstemplate=$itemtemplate[0]->slug;
            $items->delete();
            Session::flash('success', "Delete Item Success");
            return $itemstemplate;
        }else{
            Session::flash('danger', "Delete Item  Failed");
        }
    }
}
