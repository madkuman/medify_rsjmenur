<?php

namespace App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class PostController extends Controller
{
    public function delete(Request $req, $nomor_kasus){
    	DB::connection("kasus")->beginTransaction();
        $kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
        try
        {  
	   		app("App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi\DeleteController")->delete($req);

            $status = 1;
            $message = "Penandaan Area Operasi berhasil dihapus!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return  redirect('kasus/'.$kasus->nomor_kasus.'/asesmen/penandaan-area-operasi')
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Penandaan Area Operasi gagal dihapus!";
            $title = "Gagal!";

            return redirect('kasus/'.$kasus->nomor_kasus.'/asesmen/penandaan-area-operasi')
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

    public function save(Request $req, $nomor_kasus){
 		DB::connection("kasus")->beginTransaction();
        try
        {
            $tanggal = Carbon::parse($req->tanggal);
            $req['tanggal_operasi'] = $tanggal;
			$kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
            	app("App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi\EditController")->edit($req);
            }else{
           		app("App\Http\Controllers\Kasus\Asesmen\PenandaanAreaOperasi\CreateController")->create($req, $kasus->id);
            }


            $status = 1;
            $message = "Penandaan Area Operasi berhasil ditambahkan!";
            $title = "Berhasil!";
           
            DB::connection("kasus")->commit();
            
            return redirect('kasus/'.$kasus->nomor_kasus.'/asesmen/penandaan-area-operasi')
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);

        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Penandaan Area Operasi gagal ditambahkan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}