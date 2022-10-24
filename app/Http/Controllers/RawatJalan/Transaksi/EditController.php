<?php

namespace App\Http\Controllers\RawatJalan\Transaksi;

use App\Jobs\QueueArtisan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;

class EditController extends Controller
{
	public function editPasienPembayaran($kasus_id,$pasien_pembayaran_id_baru)
	{
		$transaksi = Transaksi::where('kasus_id',$kasus_id)->first();
		$transaksi->pasien_pembayaran_id=$pasien_pembayaran_id_baru;
		$transaksi->save();

		return 1;
	}

	public function editTransaksiRM($transaksi_id,$transaksi_rm_id)
	{
		$transaksi = Transaksi::find($transaksi_id);
		$transaksi->rm_transaksi_id = $transaksi_rm_id;
		$transaksi->save();
		return $transaksi;
	}

	public function editTransaksiPengembalianRM($transaksi_id,$transaksi_rm_id)
	{
		$transaksi = Transaksi::find($transaksi_id);
		$transaksi->rm_transaksi_pengembalian_id = $transaksi_rm_id;
		$transaksi->save();
		return $transaksi;
	}

    public function simpanRetribusi($retribusi,$transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->retribusi_list = $retribusi;
        $transaksi->save();
        return $transaksi;
    }

    public function editTransaksiStatus($transaksi_id,$status)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->status = $status;
        $transaksi->save();
        if(config('medify.third-party.jkn_online.on') && $status == 0){
            if($transaksi->is_online == 1) { // task id 1-3 untuk daftar online, untuk daftar offline ada apipendaftaranpasien
                $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $carbon_today = strtotime($carbon_today);
                $pasien = $transaksi->pasien;
                if ($pasien->is_baru == 1) {
                    $waktu = ($carbon_today - (rand(300,600))) * 1000;
                    $data_1['kodebooking'] = $transaksi->id;
                    $data_1['taskid'] = 1;
                    $data_1['waktu'] = $waktu;

                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 1, 'waktu' => $waktu]));

                    $waktu = ($carbon_today - (rand(60,300))) * 1000;
                    $data_2['kodebooking'] = $transaksi->id;
                    $data_2['taskid'] = 2;
                    $data_2['waktu'] = $waktu;

                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 2, 'waktu' => $waktu]));
                }
                $carbon_today = $carbon_today *1000;
                $data['kodebooking'] = $transaksi->id;
                $data['taskid'] = 3;
                $data['waktu'] = $carbon_today;
                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 3, 'waktu' => $carbon_today]));
            }
        }
    }
}
