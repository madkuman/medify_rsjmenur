<?php

namespace App\Http\Controllers\BPJS\API\Peserta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;

class PostController extends Controller
{
    public function syncPasien($min, $max)
    {
    	$pasien = Pasien::with('pembayaran.perusahaan')->whereBetween('id', [$min, $max])->get()->pluck('pembayaran')->all();
    	$pembayarans = [];
    	foreach ($pasien as $pembayaran) {
    		$pembayarans = array_merge($pembayarans, $pembayaran->all());
    	}
    	foreach ($pembayarans as $pembayaran) {
    		if(isset($pembayaran->perusahaan) && !isset($pembayaran->kelas_id)){
    			if($pembayaran->perusahaan->tipe->slug == 'bpjs' && !empty($pembayaran->no_asuransi)){
					$bpjs = app('App\Http\Controllers\BPJS\API\Peserta\ReadController')->getByKartu($pembayaran->no_asuransi, "21-05-2019");
					$bpjs = json_decode($bpjs);
					if($bpjs->metaData->code == 200){
						$pembayaran->kelas_id = $bpjs->response->peserta->hakKelas->kode;
						$pembayaran->save();
					}
				}elseif($pembayaran->perusahaan->tipe->slug == 'tunai'){
    				$pembayaran->kelas_id = 2;
    				$pembayaran->save();
    			}
    		}
    	}
    	// dd($pembayarans);
    	return 1;

    }
}
