<?php

namespace App\Http\Controllers\RekamMedis\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Transaksi;
use App\Models\Pasien\Pasien;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    	public function setujuPengiriman($data)
    	{
    		$transaksi = Transaksi::find($data['id']);
    		$data = $this->setujuPermintaan($transaksi->id);

            $transaksi = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateRMTransaksiID($transaksi->id,$transaksi->pasien_id);


    		return $data;
    	}

    	public function setujuPermintaan($transaksi_id)
    	{
            $transaksi = Transaksi::find($transaksi_id);

            //get last group holder
            $pasien = Pasien::find($transaksi->pasien_id);

    		$transaksi->sender_confirmed_by = Auth::user()->id;
    		$transaksi->sender_confirmed_at = Carbon::now();
            if($pasien->rm_current_holder->type == 2)
            {
                $last_holder_id = $pasien->rm_current_holder->id;
                $transaksi->sender_confirmed_group_id = $last_holder_id;
            }
    		$transaksi->status = 1;
    		$transaksi->save();

    		$data['transaksi'] = $transaksi;
    		$data['message'] = 'Permintaan Berhasil Dikonfirmasi';
    		return $data;
    	}

    	public function konfirmasiPenerimaan($id)
    	{
    		$transaksi = Transaksi::find($id);
            if(!empty($transaksi->id))
            {
                if(empty($transaksi->holder_confirmed_at))
                {

                    $transaksi->holder_confirmed_by = Auth::user()->id;
                    $transaksi->holder_confirmed_at = Carbon::now();
                    $transaksi->status = 2;
                    $transaksi->save();

                    $data['transaksi'] = $transaksi;
                    $data['message'] = 'File berhasil dikonfirmasi';
                    $data['type'] = 'success';
                    $data['title'] = 'Berhasil';
                }
                else
                {
                    $data['transaksi'] = $transaksi;
                    $data['message'] = 'Anda telah mengkonfirmasi penerimaan untuk file ini';
                    $data['type'] = 'warning';
                    $data['title'] = 'Gagal';
                }
            }
            else
            {
                $data['transaksi'] = $transaksi;
                $data['message'] = 'Tidak ditemukan transaksi';
                $data['type'] = 'warning';
                $data['title'] = 'Gagal';
            }
    		return $data;
    	}

        public function tolakPengiriman($id,$keterangan_sender)
        {
            $transaksi = Transaksi::find($id);

            //get last group holder
            $pasien = Pasien::find($transaksi->pasien_id);

            $transaksi->sender_confirmed_by = Auth::user()->id ?? 1;
            $transaksi->sender_confirmed_at = Carbon::now();
            if($pasien->rm_current_holder->type == 2)
            {
                $last_holder_id = $pasien->rm_current_holder->id;
                $transaksi->sender_confirmed_group_id = $last_holder_id;
            }
            $transaksi->sender_keterangan = $keterangan_sender;
            $transaksi->status = -1;
            $transaksi->save();

            $data['transaksi'] = $transaksi;
            $data['message'] = 'Permintaan Berhasil Ditolak';
            return $data;
        }



        public function tolakPenerimaan($id,$holder_keterangan)
        {
            $transaksi = Transaksi::find($id);

            $transaksi->holder_confirmed_by = Auth::user()->id;
            $transaksi->holder_confirmed_at = Carbon::now();
            $transaksi->holder_keterangan = $holder_keterangan;
            $transaksi->status = -2;
            $transaksi->save();

            $data['transaksi'] = $transaksi;
            $data['message'] = 'Permintaan Berhasil Ditolak';
            return $data;
        }

        public function editStatusPrint($transaksi)
        {
            $ids = $transaksi->pluck('id')->toArray();
            $temp_transaksi = Transaksi::whereIn('id',$ids)->update(['status_print' => 1]);
            return 1;
        }
}
