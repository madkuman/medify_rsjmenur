<?php

namespace App\Http\Controllers\Kasus\FormLabPK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Urikkes\LabPKFormHasil;
use App\Models\LabPK\PemeriksaanForm;
use DB;
use Auth;

class PostController extends Controller
{
	public function create(Request $request, $nomor_kasus, $slug, $form_id)
	{
		$data = $request->all();
		DB::connection('urikkes')->beginTransaction();
		try
		{

			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$hasil = new \stdClass();
			$hasil_array = [];
			foreach ($data as $key => $value) {
				$input_id = explode('-', $key);
				if($input_id[0] == 'input')
				{
					$input_id = $input_id[1];

					$input = new \stdClass();
					$input->id = $input_id;
					$input->value = $value;

					$inputLab = PemeriksaanForm::find($input_id);
					$input->referensi = $inputLab->referensi;
					$input->satuan = $inputLab->satuan;
					$input->label = $inputLab->label;
					$hasil_array[] = $input;
				}
			};
			$hasil->hasil = $hasil_array;
			$hasil_json = json_encode($hasil);

			
			$form_hasil = app('App\Http\Controllers\Kasus\FormLabPKHasil\CreateController')->create($kasus->id,$form_id,$hasil_json);

			
			$status = 1;
			$message = 'Form berhasil dibuat!';
			$title = 'Berhasil!';
			$url = 'kasus/'.$nomor_kasus.'/form/'.$slug.'/labpk/'.$form_id.'/hasil/'.$form_hasil->id;

			DB::connection('urikkes')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch(\Exception $e)
		{
			DB::connection('urikkes')->rollback();
			dd($e,$data,$key);

			$status = -1;
			$message = 'Form gagal dibuat!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}


	public function edit(Request $request, $nomor_kasus, $slug, $form_id, $hasil_id)
	{
		$data = $request->all();
		DB::connection('urikkes')->beginTransaction();
		try
		{
			$hasil = LabPKFormHasil::find($hasil_id);
			$hasil->delete();
			
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$hasil = new \stdClass();
			$hasil_array = [];

			foreach ($data as $key => $value) {
				$input_id = explode('-', $key);
				if($input_id[0] == 'input')
				{
					$input_id = $input_id[1];

					$input = new \stdClass();
					$input->id = $input_id;
					$input->value = $value;	
					$inputLab = PemeriksaanForm::find($input_id);
					$input->referensi = $inputLab->referensi;
					$input->satuan = $inputLab->satuan;
					$input->label = $inputLab->label;
					$hasil_array[] = $input;
				}
			};
			$hasil->hasil = $hasil_array;
			$hasil_json = json_encode($hasil);

			
			$form_hasil = app('App\Http\Controllers\Kasus\FormLabPKHasil\CreateController')->create($kasus->id,$form_id,$hasil_json);

			$status = 1;
			$message = 'Form berhasil dibuat!';
			$title = 'Berhasil!';
			$url = 'kasus/'.$nomor_kasus.'/form/'.$slug.'/labpk/'.$form_id.'/hasil/'.$form_hasil->id;

			DB::connection('urikkes')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch(\Exception $e)
		{
			DB::connection('urikkes')->rollback();

			

			$status = -1;
			$message = 'Form gagal dibuat!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
