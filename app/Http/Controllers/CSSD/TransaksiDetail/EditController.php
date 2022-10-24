<?php

namespace App\Http\Controllers\CSSD\TransaksiDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\TransaksiDetail;
use App\Models\CSSD\AlkesSatuan;

class EditController extends Controller
{
	public function kirimAlkes($transaksi_id,$slugs)
	{
		if(count($slugs) > 0)
		{
			foreach($slugs as $slug)
			{
				$satuan = AlkesSatuan::where('slug',$slug)->first();
				$transaksi_detail = TransaksiDetail::where('transaksi_id',$transaksi_id)->where('item_template_id',$satuan->item_template_id)->whereNull('alkes_satuan_id')->first();
				if(!empty($transaksi_detail->id))
				{
				//jika nemu maka akan edit
					$transaksi_detail->alkes_satuan_id = $satuan->id;
					$transaksi_detail->save();
				}
				else
				{
				//jika nemu maka akan create baru
					$transaksi = app('App\Http\Controllers\CSSD\TransaksiDetail\CreateController')->createSingle($transaksi_id,$satuan->item_template_id,$satuan->id,1);
				}
			}
		}
	}
}
