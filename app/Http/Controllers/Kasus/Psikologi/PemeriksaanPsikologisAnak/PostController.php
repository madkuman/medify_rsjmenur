<?php

namespace App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function save(Request $request, $nomor_kasus)
    {
        DB::connection("kasus")->beginTransaction();
        try {
            $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($nomor_kasus);

            if (isset($request->id) && $request->id != 0) {
                $data = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\EditController::class)->edit($request,$kasus->id);
                $message = "Pemeriksaan Psikologis Anak berhasil diubah!";
            } else {
                $data = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\CreateController::class)->create($request,$kasus->id);
                $message = "Pemeriksaan Psikologis Anak berhasil ditambahkan!";
            }

            if(!is_null($data->penunjang_id)){
                app("App\Http\Controllers\Kasus\Penunjang\DeleteController")->delete($data->penunjang_id);
            }
            $now_timestamp = Carbon::now()->format('d-m-Y-H-i-s');
            $path = 'uploads/psikologi/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $path = $path.'psikogram_anak_'.$nomor_kasus.'_'.$data->id.'_'.$now_timestamp.'.pdf';
            $no_rm = $data->kasus->pasien->no_rm ?? '';
            $nama = $data->kasus->pasien->name ?? '';
            $title = $no_rm.'_'.$nama.'_'.$nomor_kasus.'_psikologi_hasil_psikogram_anak_'.$data->id;

            app("App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\ViewController")->print($nomor_kasus,$data->id,$path);
            $penunjang = app('App\Http\Controllers\Kasus\Penunjang\CreateController')->createData($path,
                $title, '', $kasus->id, 'pdf', 'psikologi', null, 'assets/icons/svg/pdf.svg');
            $data->penunjang_id = $penunjang->id;
            $data->save();

            $status = 1;
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
            $message = "Pemeriksaan psikologis anak gagal disimpan!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

    public function delete(Request $request)
    {
        DB::connection("kasus")->beginTransaction();
        try
        {  
	   		app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\DeleteController::class)->delete($request);

            $status = 1;
            $message = "Pemeriksaan Psikologis Anak berhasil dihapus!";
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
            $message = "Pemeriksaan Psikologis Anak gagal dihapus!";
            $title = "Gagal!";

            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }
}
