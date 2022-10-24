<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;
use Auth;

class PostController extends Controller
{
    public function delete(Request $req){
    	DB::connection("kasus")->beginTransaction();
        try
        {  
	   		app("App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang\DeleteController")->delete($req);

            $status = 1;
            $message = "Ringkasan Pasien Pulang berhasil dihapus!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Ringkasan Pasien Pulang gagal dihapus!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

    public function save(Request $req, $nomor_kasus){
 		DB::connection("kasus")->beginTransaction();
        try
        {

			$kasus = Kasus::with(['lokasi.lokasi.departemen'])->where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
            	app("App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang\EditController")->edit($req);
            }else{
           		app("App\Http\Controllers\Kasus\Asesmen\RingkasanPasienPulang\CreateController")->create($req, $kasus->id);
            }

            if (config('medify.third-party.jkn_online.on')) {
				$transaksi = $kasus->rawat_jalan_transaksi_last_attr;
				$profesi = Auth::user()->profesi;

				if ($kasus->lokasi->lokasi->departemen->id == 2 && $transaksi->task_id_jkn < 5) {
					$carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
					$carbon_today = strtotime($carbon_today) * 1000;
					$data['kodebooking'] = $transaksi->id;
					$data['taskid'] = 5;
					$data['waktu'] = $carbon_today;
	
					$returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
					$returned = json_decode($returned);
					if(($returned->metadata->code ?? null) != "200"){
						$data_log['kodebooking'] = $transaksi->id;
						$data_log['response'] = json_encode($returned);
	
						app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
					}
					$transaksi->task_id_jkn = 5;
					$transaksi->save();
				}

            }


            $status = 1;
            $message = "Ringkasan Pasien Pulang berhasil ditambahkan!";
            $title = "Berhasil!";
           
            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);

        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Ringkasan Pasien Pulang gagal ditambahkan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}