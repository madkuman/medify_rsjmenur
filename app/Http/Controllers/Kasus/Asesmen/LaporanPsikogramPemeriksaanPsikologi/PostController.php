<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi;

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
	   		app("App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\DeleteController")->delete($req);

            $status = 1;
            $message = "Laporan Psikogram Pemeriksaan Psikologi berhasil dihapus!";
            $title = "Berhasil!";
            $tab = "psikogram";

            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status)
            ->with("tab", $tab);
        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Laporan Psikogram Pemeriksaan Psikologi gagal dihapus!";
            $title = "Gagal!";
            $tab = "psikogram";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status)
            ->with("tab", $tab);
        }
    }

    public function save(Request $req, $nomor_kasus){
 		DB::connection("kasus")->beginTransaction();
        try
        {

			$kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
            	$data = app("App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\EditController")->edit($req);
            }else{
           		$data = app("App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\CreateController")->create($req, $kasus->id);
            }

            if(!is_null($data->penunjang_id)){
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($data->penunjang_id);
            }
            $now_timestamp = Carbon::now()->format('d-m-Y-H-i-s');
            $path = 'uploads/psikologi/laporan_psikogram_pemeriksaan_psikologi'.$nomor_kasus.'_'.$data->id.'_'.$now_timestamp.'.pdf';
            $no_rm = $data->kasus->pasien->no_rm ?? '';
            $nama = $data->kasus->pasien->name ?? '';
            $title = $no_rm.'_'.$nama.'_'.$nomor_kasus.'_psikologi_laporan_psikogram_pemeriksaan_psikologi_'.$data->id;

            app("App\Http\Controllers\Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\ViewController")->print($nomor_kasus,$data->id,$path);
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($path,
                $title, '', $kasus->id, 'pdf', 'psikologi', null, 'assets/icons/svg/pdf.svg');
            $data->penunjang_id = $penunjang->id;
            $data->save();


            $status = 1;
            $message = "Laporan Psikogram Pemeriksaan Psikologi berhasil ditambahkan!";
            $title = "Berhasil!";
            $tab = "psikogram";
           
            DB::connection("kasus")->commit();
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status)
            ->with("tab", $tab);

        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Laporan Psikogram Pemeriksaan Psikologi gagal ditambahkan!";
            $title = "Gagal!";
            $tab = "psikogram";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status)
            ->with("tab", $tab);
        }
    }
}