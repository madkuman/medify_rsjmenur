<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik;

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
	   		app("App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik\DeleteController")->delete($req);

            $status = 1;
            $message = "Skoring Derajat Gejala Psikotik berhasil dihapus!";
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
            $message = "Skoring Derajat Gejala Psikotik gagal dihapus!";
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
            	app("App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik\EditController")->edit($req);
            }else{
           		app("App\Http\Controllers\Kasus\Asesmen\SkoringDerajatGejalaPsikotik\CreateController")->create($req, $kasus->id);
            }


            $status = 1;
            $message = "Skoring Derajat Gejala Psikotik berhasil ditambahkan!";
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
            $message = "Skoring Derajat Gejala Psikotik gagal ditambahkan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}