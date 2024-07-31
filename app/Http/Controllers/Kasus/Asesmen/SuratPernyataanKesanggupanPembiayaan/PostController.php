<?php

namespace App\Http\Controllers\Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create($nomor_kasus, Request $req)
	{	
		try {
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$ect = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				$ect[$key] = $val == "on" ? 'Ya' : $val ;
			}

			$alatBantu = new AlatBantu();
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "surat-pernyataan-kesanggupan-pembiayaan";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($ect);
			$alatBantu->save();

			$status = 1;
			$message = 'Surat Pernyataan Kesanggupan Pembiayaan berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','surat-pernyataan-kesanggupan-pembiayaan',$alatBantu->id);

			DB::connection('kasus')->commit();
			return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

		} catch (Exception $e) {

			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Surat Pernyataan Kesanggupan Pembiayaan gagal dibuat!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}


    public function delete($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{	
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$jiwa = AlatBantu::find($id);
			$jiwa->delete();

			$status = 1;
			$message = 'Asesmen Observasi Tindakan ECT berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-resume-pulang',$jiwa->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {
			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Asesmen Keperawatan Jiwa gagal dihapus!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}

	public function APIAddTTD($nomor_kasus, Request $request)
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
				$alat_bantu = AlatBantu::find($request->id);												
				$decode = json_decode($alat_bantu->val);								
				$decode->img_ttd = $img_dir['file_original'];				
				$alat_bantu->val = json_encode($decode);				
				$alat_bantu->save();
				
				$data['type'] = 'success';
	            $data['title'] = 'Berhasil';
	            $data['text'] = 'Berhasil menandatangani form ini';
	            $data['url'] = 'kasus/'.$nomor_kasus.'/asesmen/surat-pernyataan-kesanggupan-pembiayaan';
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
