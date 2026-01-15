<?php

namespace App\Http\Controllers\Kasus\Farmasi\KonselingObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\RekonsiliasiObatDetail;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{
	public function save(Request $req, $nomor_kasus)
    {
        DB::connection("kasus")->beginTransaction();
        try {
            $kasus = Kasus::where("nomor_kasus",$nomor_kasus)->first();
            if(isset($req->id) && $req->id != 0){
                app("App\Http\Controllers\Kasus\Farmasi\KonselingObat\EditController")->edit($req);
            }else{
                app("App\Http\Controllers\Kasus\Farmasi\KonselingObat\CreateController")->create($req, $kasus);
            }
            $status = 1;
            $message = "Konseling Obat berhasil ditambahkan!";
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
            $message = "Konseling Obat gagal ditambahkan!";
            $title = "Gagal!";
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

	public function delete(Request $req){
    	DB::connection("kasus")->beginTransaction();
        try {  
	   		$id = $req->id;
			$assesment_saraf = AlatBantu::find($id);
			if($assesment_saraf = AlatBantu::find($id)) {
				$assesment_saraf->deleted_by = Auth::user()->id;
				$assesment_saraf->save();
				$assesment_saraf->delete();
			}
            $status = 1;
            $message = "Konseling Obat berhasil dihapus!";
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
            $message = "Assesment Saraf gagal dihapus!";
            $title = "Gagal!";
            return back()
            ->with("message", $message)
            ->with("title",$title)
            ->with("status", $status);
        }
    }

    public function submitTTD($id, Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        try {
            // upload image from canvas
            $img_base64 = $request->imgBase64;
            $img_base64 = str_replace('data:image/png;base64,', '', $img_base64);
            $img_base64 = str_replace(' ', '+', $img_base64);   
            $img_data = base64_decode($img_base64);
            $img_dir = app('App\Http\Controllers\Functions\ImageUploader')->upload($img_data,'ttd');
            $success = file_put_contents($img_dir['file_original'], $img_data);

            if ($success) {
                $data = AlatBantu::find($request->id);
                $data2 = json_decode($data->val, true);
                $data2['tgl_tanda_tangan_pasien'] = date("Y/m/d");
                $data2['ttd_img_pasien'] = $img_dir['file_original'];
                $data2['nama_pasien'] = $request->nama_pasien ?? '';
                $data->val = json_encode($data2);
                $data->save();

                $data['type'] = 'success';
                $data['title'] = 'Berhasil';
                $data['text'] = 'Berhasil menandatangani form ini';
                $data['url'] = 'kasus/'.$request->kasus->nomor_kasus.'/farmasi/konseling-obat';
                DB::connection('kasus')->commit();
            }
            else {
                DB::connection('kasus')->rollback();
                $data['type'] = 'error';
                $data['title'] = 'Gagal';
                $data['text'] = 'Gagal mengunggah tanda tangan. Silahkan hapus tanda tangan dan coba lagi.';
                $data['url'] = 0;
            }

            return json_encode($data);

        } catch (\Exception $e) {
            DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal menandatangani form ini. Silahkan coba lagi';
            $data['url'] = 0;

            return json_encode($data);
        }
    }

}
