<?php

namespace App\Http\Controllers\Hospital\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\TransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail;
use DB;

class CreateController extends Controller
{
	public function create($modul,$utama,$pasien_id)
	{
		$transaksi = new TransaksiMasuk;
        $transaksi->pasien_id = $pasien_id;
		$transaksi->save();

        $transaksi_detail = $this->createDetail($transaksi->id,$modul,$utama);

		return $transaksi_detail;
	}

    public function createDetail($transaksi_masuk_id,$modul,$utama)
    {
        $transaksi = new TransaksiMasukDetail;
        $transaksi->transaksi_masuk_id = $transaksi_masuk_id;
        $transaksi->modul_id = $modul;
        $transaksi->utama = $utama;
        $transaksi->save();

        return $transaksi;

    }

    /* SAAT PAKE YANG PENUNJANG DAN CORE
    public function createUtama($modul,$transaksimasuk_id,$transaksilocal_id=NULL)
    {
        $transaksi = new TransaksiUtama;
        $transaksi->modul_id = $modul;
        $transaksi->transaksi_masuk_id = $transaksimasuk_id;
        $transaksi->transaksi_lokal_id = $transaksilocal_id;
        $transaksi->save();

        return $transaksi;
    }

    public function createPenunjang($modul,$transaksimasuk_id,$transaksilocal_id=NULL)
    {
        $transaksi = new TransaksiPenunjang;
        $transaksi->modul_id = $modul;
        $transaksi->transaksi_masuk_id = $transaksimasuk_id;
        $transaksi->transaksi_lokal_id = $transaksilocal_id;
        $transaksi->save();

        return $transaksi;
    }
    */

}
