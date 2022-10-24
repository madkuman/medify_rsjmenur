<?php

namespace App\Http\Controllers\RekamMedis\Permintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Permintaan;
use Auth;

class CreateController extends Controller
{
    	public function create($data)
    	{
    		/*array:5 [▼
		  "pasien" => "2232"
		  "lokasi" => "Poli Gigi 2"
		  "jenis_id" => "1"
		  "keterangan" => "ogah ngasih karena stok tinggal 100"
		]*/

		$permintaan = new Permintaan;
		$permintaan->pasien_id = $data['pasien_id'];
		$permintaan->status = 0;
		$permintaan->transaksi_id = 0;
		$permintaan->keterangan = $keterangan;
		$permintaan->created_by = Auth::user()->id();
		$permintaan->save();

    	}
}
