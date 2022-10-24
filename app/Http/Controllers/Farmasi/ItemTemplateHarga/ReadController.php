<?php

namespace App\Http\Controllers\Farmasi\ItemTemplateHarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemTemplateHarga;

class ReadController extends Controller
{
	public function getByItemTemplate($itemTemplateId)
	{
		return ItemTemplateHarga::where('item_template_id', $itemTemplateId)->get();
	}

	public function getByItemTemplatePenyedia($itemTemplateId, $penyedia)
	{
		return ItemTemplateHarga::where('supplier_id', $penyedia)
            					->where('item_template_id', $itemTemplateId)->first();
	}
}