<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhanDetail;

class PostController extends Controller
{
	public function create(Request $request)
	{
		$diagnosa = $request->diagnosa;
		$tujuan = $request->tujuan;
		$durasi_tujuan = $request->durasi_tujuan;
		$sub_tujuan = $request->sub_tujuan;
		$prefix = $request->prefix;
		$jenis_id = $request->jenis_id;
		$form_drm = $request->form_drm;
		$created_by = $request->created_by;
		$opsi_diagnosa = $request->opsi_diagnosa;
		$opsi_data_penunjang = $request->opsi_data_penunjang;
		$opsi_data_subjektif = $request->opsi_data_subjektif;
		$opsi_data_objektif = $request->opsi_data_objektif;
		$opsi_tujuan = $request->opsi_tujuan;
		$opsi_mandiri = $request->opsi_mandiri;
		$opsi_kolaborasi = $request->opsi_kolaborasi;

		if($durasi_tujuan == "on") $durasi_tujuan = 1;

		$rencanaasuhan = app('App\Http\Controllers\Keperawatan\RencanaAsuhan\CreateController')
		->create($jenis_id,$diagnosa,$tujuan,$form_drm, $created_by, $prefix,$durasi_tujuan,$sub_tujuan);

		foreach($opsi_diagnosa as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,1);
		}
		foreach($opsi_data_penunjang as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,2);
		}
		foreach($opsi_data_subjektif as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,3);
		}
		foreach($opsi_data_objektif as $item)
		{
			
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,4);
		}
		foreach($opsi_tujuan as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,5);
		}
		foreach($opsi_mandiri as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,6);
		}
		foreach($opsi_kolaborasi as $item)
		{
			if(!empty($item))
			$detail = app('App\Http\Controllers\Keperawatan\RencanaAsuhanDetail\CreateController')->create($rencanaasuhan->id,$item,7);
		}

		$message = 'Data Rencana Asuhan Berhasil Ditambahkan!';
        $title = 'Berhasil!';
        $status = 1;

        return redirect('keperawatan/rencana-asuhan/'.$rencanaasuhan->id)
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
	}
}
