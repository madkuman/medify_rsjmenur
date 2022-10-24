<?php

namespace App\Http\Controllers\RekamMedis\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Transaksi;
use App\Models\Pasien\Pasien;
use Auth,DB;

class CreateController extends Controller
{
    public function create($data)
    {
        $transaksi = new Transaksi;

        $transaksi->pasien_id = $data['pasien_id'];
        $transaksi->status = $data['status'];
        $transaksi->holder_type = $data['holder_type'];
        $transaksi->holder_user_id = $data['holder_user_id'];
        $transaksi->holder_group_id = $data['holder_group_id'];
        $transaksi->holder_keterangan = $data['holder_keterangan'];
        if($data['jenis'] == 3)//pengembalian
        {
            $transaksi->holder_confirmed_at = $data['holder_confirmed_at'];
            $transaksi->holder_confirmed_by = $data['holder_confirmed_by'];
        }
        $transaksi->lokasi = $data['lokasi'];
        $transaksi->tujuan_id = $data['tujuan_id'];
        $transaksi->jenis = $data['jenis'];
        $transaksi->sender_confirmed_at = $data['sender_confirmed_at'];
        $transaksi->sender_confirmed_by = $data['sender_confirmed_by'];
        $transaksi->sender_confirmed_group_id = null;
        $transaksi->sender_keterangan = $data['sender_keterangan'];
        $transaksi->created_by = Auth::user()->id;
        $transaksi->save();

        if($data['jenis'] != 1) //permintaan
        {
            $pasien = Pasien::find($transaksi->pasien_id);
            if($pasien->rm_current_holder->type == 2)
            {
                $last_holder_id = $pasien->rm_current_holder->id ?? 1;
                $transaksi->sender_confirmed_group_id = $last_holder_id;
                $transaksi->save();
            }

            $pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateRMTransaksiID($transaksi->id,$transaksi->pasien_id);
        }
        return $transaksi;
    }
}
