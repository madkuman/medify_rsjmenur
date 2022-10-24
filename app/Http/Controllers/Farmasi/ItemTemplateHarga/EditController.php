<?php

namespace App\Http\Controllers\Farmasi\ItemTemplateHarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemTemplateHarga;
use App\Models\Farmasi\ItemsFarmasi;

class EditController extends Controller
{
	public function checkAndUpdate($itemFarmasiId, $penyedia, $harga)
	{
	    $float_harga = $harga;
		$itemTemplate = ItemsFarmasi::find($itemFarmasiId)->item_detail;
		$item_harga = app('App\Http\Controllers\Farmasi\ItemTemplateHarga\ReadController')->getByItemTemplatePenyedia($itemTemplate->id, $penyedia);
        if(!$item_harga){
			$item_harga = new ItemTemplateHarga;
			$item_harga->item_template_id = $itemTemplate->id;
            $item_harga->harga = $harga;
			$item_harga->supplier_id = $penyedia;
            $item_harga->selected = 0;
		}else{
            $item_harga->harga = $harga;
            $item_harga->selected = 0;
        }
        $item_harga->save();
        $harga_max = ItemTemplateHarga::where('item_template_id', $itemTemplate->id)->orderBy('harga','desc')->first();
        if($harga_max){
            $itemTemplate->harga=$harga_max->harga;
            ItemTemplateHarga::where('item_template_id', $item_harga->item_template_id)->update(['selected'=> 0]);
            $harga_max->selected = 1;
            $harga_max->save();
            $itemTemplate->save();
        }
	}

	public function pilih($id)
	{
		$item_harga = ItemTemplateHarga::find($id);
		if($item_harga){
			ItemTemplateHarga::where('item_template_id', $item_harga->item_template_id)->update(['selected'=> 0]);
			$item_harga->selected = 1;
			$item_harga->save();
		}
		return $item_harga;
	}
}