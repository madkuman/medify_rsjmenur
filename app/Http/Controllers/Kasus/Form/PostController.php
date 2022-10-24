<?php

namespace App\Http\Controllers\Kasus\Form;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\FormHasil;
use App\Models\Kasus\FormInput;
use App\Models\Kasus\FormInputOpsi;
use DB;
use Auth;

class PostController extends Controller
{
	public function create(Request $request, $nomor_kasus, $slug, $form_id)
	{
		$data = $request->all();
		DB::connection('kasus')->beginTransaction();
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
					$input = FormInput::find($input_id);
					$input = $this->getInputObject($input,$value,$data);
					$hasil_array[] = $input;
				}
			}
			$hasil->hasil = $hasil_array;
			$hasil_json = json_encode($hasil);

			
			$form_hasil = app('App\Http\Controllers\Kasus\FormHasil\CreateController')->create($kasus->id,$form_id,$hasil_json);

			
			$status = 1;
			$message = 'Form berhasil dibuat!';
			$title = 'Berhasil!';
			$url = 'kasus/'.$nomor_kasus.'/form/'.$slug.'/custom/'.$form_id.'/hasil/'.$form_hasil->id;

			DB::connection('kasus')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch(\Exception $e)
		{
			DB::connection('kasus')->rollback();
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
		DB::connection('kasus')->beginTransaction();
		try
		{
			$hasil = FormHasil::find($hasil_id);
			$hasil->delete();
			
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$hasil = new \stdClass();
			$hasil_array = [];

			foreach ($data as $key => $value) {
				$input_id = explode('-', $key);
				if($input_id[0] == 'input')
				{
					$input_id = $input_id[1];
					$input = FormInput::find($input_id);
					$input = $this->getInputObject($input,$value,$data);
					$hasil_array[] = $input;
				}
			}
			$hasil->hasil = $hasil_array;
			$hasil_json = json_encode($hasil);

			
			$form_hasil = app('App\Http\Controllers\Kasus\FormHasil\CreateController')->create($kasus->id,$form_id,$hasil_json);

			$status = 1;
			$message = 'Form berhasil dibuat!';
			$title = 'Berhasil!';
			$url = 'kasus/'.$nomor_kasus.'/form/'.$slug.'/custom/'.$form_id.'/hasil/'.$form_hasil->id;

			DB::connection('kasus')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch(\Exception $e)
		{
			DB::connection('kasus')->rollback();
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

	private function getInputObject($input,$opsi_value,$request_data)
	{
		$type_checkboxes = ['checkboxes','checkboxes-score'];
		$type_multiple = ['radio','radio-score'];

		if(in_array($input->type, $type_checkboxes)) $opsi = $this->getOpsiObjectCheckboxes($opsi_value,$request_data);
		else if(in_array($input->type, $type_multiple)) $opsi = $this->getOpsiObjectMultiple($opsi_value,$request_data);
		else $opsi = $this->getOpsiObjectNonMultiple();

		$obj_input = new \stdClass();
		$obj_input->id = $input->id;
		$obj_input->value = $opsi_value;
		$obj_input->deskripsi = $opsi->deskripsi;
		$obj_input->skor = $opsi->skor;
		$obj_input->keterangan = $opsi->keterangan;


		return $obj_input;
	}

	private function getOpsiObjectCheckboxes($opsi_value, $request_data)
	{
		$result_deskripsi = [];
		$result_skor = [];
		$result_keterangan = [];
		foreach($opsi_value as $value)
		{
			$input_opsi = FormInputOpsi::find($value);
			$result_keterangan[] = (!empty($request_data['opsi-keterangan-'.$input_opsi->id]) ? $request_data['opsi-keterangan-'.$input_opsi->id] : ''  );
			$result_deskripsi[] = $input_opsi->deskripsi;
			$result_skor[] = $input_opsi->skor;
		}
		$opsi = new \stdClass();
		$opsi->deskripsi = $result_deskripsi;
		$opsi->skor = $result_skor;
		$opsi->keterangan = $result_keterangan;

		return $opsi;
	}

	private function getOpsiObjectMultiple($opsi_value,$request_data)
	{
		$input_opsi = FormInputOpsi::find($opsi_value);
		$opsi = new \stdClass();
		$opsi->deskripsi = $input_opsi->deskripsi;
		$opsi->skor = $input_opsi->skor;
		$opsi->keterangan = (!empty($request_data['opsi-keterangan-'.$input_opsi->id]) ? $request_data['opsi-keterangan-'.$input_opsi->id] : ''  );
		return $opsi;

	}

	private function getOpsiObjectNonMultiple()
	{
		$opsi = new \stdClass();
		$opsi->deskripsi = null;
		$opsi->skor = null;
		$opsi->keterangan = null;
		return $opsi;

	}

	public function delete($nomor_kasus,$slug,$form_id,$hasil_id,Request $request)
	{
		$data = $request->all();
		DB::connection('kasus')->beginTransaction();
		try
		{
			$hasil = FormHasil::find($hasil_id);
			$hasil->delete();
			
			$status = 1;
			$message = 'Form berhasil dihapus!';
			$title = 'Berhasil!';
			$url = 'kasus/'.$nomor_kasus.'/form/'.$slug.'/custom/'.$form_id;

			DB::connection('kasus')->commit();

			return redirect($url)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch(\Exception $e)
		{
			DB::connection('kasus')->rollback();
			dd($e,$data);

			

			$status = -1;
			$message = 'Form gagal dihapus!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
