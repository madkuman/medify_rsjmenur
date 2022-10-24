<?php

namespace App\Http\Controllers\Kasus\Asesmen\MonitoringTransfusiDarah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\MonitoringTransfusiDarah;
use DB;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$monitoring_transfusi_darah = MonitoringTransfusiDarah::find($req->id);
    	
		$monitoring_transfusi_darah->tanggal = Carbon::createFromFormat('d-m-Y', $req['tanggal']);
		$monitoring_transfusi_darah->jam = $req->jam;
		$monitoring_transfusi_darah->menit_15_sebelum_td = $req->menit_15_sebelum_td;
		$monitoring_transfusi_darah->menit_15_sebelum_nadi = $req->menit_15_sebelum_nadi;
		$monitoring_transfusi_darah->menit_15_sebelum_t = $req->menit_15_sebelum_t;
		$monitoring_transfusi_darah->menit_15_sebelum_rr = $req->menit_15_sebelum_rr;
		$monitoring_transfusi_darah->jam_mulai_transfusi = $req->jam_mulai_transfusi;
		$monitoring_transfusi_darah->menit_15_setelah_td = $req->menit_15_setelah_td;
		$monitoring_transfusi_darah->menit_15_setelah_nadi = $req->menit_15_setelah_nadi;
		$monitoring_transfusi_darah->menit_15_setelah_t = $req->menit_15_setelah_t;
		$monitoring_transfusi_darah->menit_15_setelah_rr = $req->menit_15_setelah_rr;
		$monitoring_transfusi_darah->jam_1_setelah_td = $req->jam_1_setelah_td;
		$monitoring_transfusi_darah->jam_1_setelah_nadi = $req->jam_1_setelah_nadi;
		$monitoring_transfusi_darah->jam_1_setelah_t = $req->jam_1_setelah_t;
		$monitoring_transfusi_darah->jam_1_setelah_rr = $req->jam_1_setelah_rr;
		$monitoring_transfusi_darah->reaksi_selama_transfusi = $req->reaksi_selama_transfusi;
		$monitoring_transfusi_darah->jam_selesai_transfusi = $req->jam_selesai_transfusi;
		$monitoring_transfusi_darah->jam_4_setelah_td = $req->jam_4_setelah_td;
		$monitoring_transfusi_darah->jam_4_setelah_nadi = $req->jam_4_setelah_nadi;
		$monitoring_transfusi_darah->jam_4_setelah_t = $req->jam_4_setelah_t;
		$monitoring_transfusi_darah->jam_4_setelah_rr = $req->jam_4_setelah_rr;
		$monitoring_transfusi_darah->reaksi_transfusi = $req->reaksi_transfusi;
		$monitoring_transfusi_darah->golongan_darah = $req->golongan_darah;
		$monitoring_transfusi_darah->rhesus = $req->rhesus;
    	$monitoring_transfusi_darah->save();
    }
}