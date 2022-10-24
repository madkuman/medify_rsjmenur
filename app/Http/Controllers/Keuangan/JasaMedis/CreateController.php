<?php

namespace App\Http\Controllers\Keuangan\JasaMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PemasukanDetail;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\JasaMedis;
use App\User;

class CreateController extends Controller
{
    public function APICreate($deskripsi, $total, $pemasukan_detail_id, $user_id, $tarif_id)
    {
        $tarif = Tarif::find($tarif_id);
        $user = User::find($user_id);

        $jasmed_total = 0;

        if($user->profesi == 1)
        {
            if(!empty($tarif->tarif_kode->dokter))
            $jasmed_total = $total*$tarif->tarif_kode->dokter/100;
        }

        if($jasmed_total > 0)
        {
            $jasmed = new JasaMedis;
            $jasmed->deskripsi = $deskripsi;
            $jasmed->total = $jasmed_total;
            $jasmed->pemasukan_detail_id = $pemasukan_detail_id;
            $jasmed->user_id = $user_id;
            $jasmed->grup_id = NULL;
            $jasmed->save();
        }
        return;
    }
}
