<?php

namespace App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;

class PostController extends Controller
{
    public function delete(Request $req){
    	DB::connection("kasus")->beginTransaction();
        try
        {  
	   		app("App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara\DeleteController")->delete($req);

            $status = 1;
            $message = "Tes IQ Keswara berhasil dihapus!";
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
            $message = "Tes IQ Keswara gagal dihapus!";
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

			$kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
            	$data = app("App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara\EditController")->edit($req);
            }else{
           		$data = app("App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara\CreateController")->create($req, $kasus->id);
            }

            if(!is_null($data->penunjang_id)){
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($data->penunjang_id);
            }
            $now_timestamp = Carbon::now()->format('d-m-Y-H-i-s');
            $path = 'uploads/psikologi/tes_iq_keswara_'.$nomor_kasus.'_'.$data->id.'_'.$now_timestamp.'.pdf';
            $no_rm = $data->kasus->pasien->no_rm ?? '';
            $nama = $data->kasus->pasien->name ?? '';
            $title = $no_rm.'_'.$nama.'_'.$nomor_kasus.'_psikologi_tes_iq_keswara_'.$data->id;

            app("App\Http\Controllers\Kasus\AlatBantu\TesIQKeswara\ViewController")->print($nomor_kasus,$data->id,$path);
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($path,
                $title, '', $kasus->id, 'pdf', 'psikologi', null, 'assets/icons/svg/pdf.svg');
            $data->penunjang_id = $penunjang->id;
            $data->save();


            $status = 1;
            $message = "Tes IQ Keswara berhasil ditambahkan!";
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
            $message = "Tes IQ Keswara gagal ditambahkan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}