<?php

namespace App\Http\Controllers\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keperawatan\RencanaAsuhan;

class CreateController extends Controller
{
    	public function create($jenis_id, $diagnosa, $tujuan, $form_drm, $created_by, $prefix,$durasi_tujuan,$sub_tujuan)
    	{
    		$kep = new RencanaAsuhan;
    		$kep->jenis_id = $jenis_id;
    		$kep->diagnosa = $diagnosa;
    		$kep->tujuan = $tujuan;
            $kep->durasi_tujuan = $durasi_tujuan;
            $kep->sub_tujuan = $sub_tujuan;
			$kep->form_drm = $form_drm;
			$kep->created_by = $created_by;
            $kep->prefix = is_null($prefix) ? $prefix : 1;
    		$kep->save();

    		return $kep;
    	}
}
