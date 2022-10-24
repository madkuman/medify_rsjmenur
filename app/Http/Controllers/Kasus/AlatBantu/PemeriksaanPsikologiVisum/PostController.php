<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

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
	   		app("App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum\DeleteController")->delete($req);

            $status = 1;
            $message = "Pemeriksaan Psikologi Visum berhasil dihapus!";
            $title = "Berhasil!";
            $tab = "pemeriksaan_visum";

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
            $message = "Pemeriksaan Psikologi Visum gagal dihapus!";
            $title = "Gagal!";
            $tab = "pemeriksaan_visum";

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
            	$data = app("App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum\EditController")->edit($req);
            }else{
           		$data = app("App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum\CreateController")->create($req, $kasus->id);
            }

            if(!is_null($data->penunjang_id)){
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($data->penunjang_id);
            }
            $now_timestamp = Carbon::now()->format('d-m-Y-H-i-s');
            $path = 'uploads/psikologi/pemeriksaan_psikologi_visum'.$nomor_kasus.'_'.$data->id.'_'.$now_timestamp.'.pdf';
            $no_rm = $data->kasus->pasien->no_rm ?? '';
            $nama = $data->kasus->pasien->name ?? '';
            $title = $no_rm.'_'.$nama.'_'.$nomor_kasus.'_psikologi_pemeriksaan_psikologi_visum_'.$data->id;

            app("App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum\ViewController")->print($nomor_kasus,$data->id,$path);
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($path,
                $title, '', $kasus->id, 'pdf', 'psikologi', null, 'assets/icons/svg/pdf.svg');
            $data->penunjang_id = $penunjang->id;
            $data->save();


            $status = 1;
            $message = "Pemeriksaan Psikologi Visum berhasil ditambahkan!";
            $title = "Berhasil!";
            $tab = "pemeriksaan_visum";
           
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
            $message = "Pemeriksaan Psikologi Visum gagal ditambahkan!";
            $title = "Gagal!";
            $tab = "pemeriksaan_visum";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status)
            ->with("tab", $tab);
        }
    }
}