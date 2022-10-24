<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function create(Request $request)
    {
    	// dd($request);
    	try {
    		$cons_id = config('app.bpjs_cons_id');
    		$secret = config('app.bpjs_secret');

    		$tgl_rujukan = explode("-", $request->tanggal_rujuk);
    		$tgl_rujukan = implode("-", array_reverse($tgl_rujukan));

    		$data = [
				'bpjs_stage'		=> config('app.bpjs_stage'),
				'medify_cons_id'		=> $cons_id,
				'medify_secret' 		=> $secret, 
				'no_sep' 				=> $request->sep,
				'tgl_rujukan' 			=> $tgl_rujukan,
				'ppk_rujuk' 			=> json_decode($request->faskes)->kode,
				'jns_pelayanan' 		=> $request->jenis_rujuk,
				'catatan' 				=> $request->catatan,
				'diag_rujukan' 			=> $request->diagnosis,
				'tipe_rujukan' 			=> $request->tipe_rujuk,
				'poli_rujukan' 			=> json_decode($request->poli)->kode,
				'user' 					=> Auth::user()->id
			];

			if(config('app.bpjs_enable', false)){
		    	$result =  app('App\Http\Controllers\BPJS\API\Rujukan\CreateController')->create($data);
		    	if($result->metaData->code != 200)
		    		return back()
				    	->with('message', $result->metaData->message)
						->with('title',"Gagal")
						->with('status', -1);
		    }

    		DB::connection('kasus')->beginTransaction();
    		$rujuk_luar = app('App\Http\Controllers\BPJS\Rujukan\CreateController')->create($request, $result->response->rujukan->noRujukan);

    		$status = 1;
			$message = 'Berhasil menambah rujukan';
			$title = 'Berhasil!';

            DB::connection('kasus')->commit();

    	} catch (\Exception $e) {
    		DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}

    	return redirect('/bpjs/rujukan/'.$rujuk_luar->no_rujukan)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
    }

    public function edit(Request $request, $no_rujukan)
    {
    	// dd($request);
    	try {
    		$cons_id = config('app.bpjs_cons_id');
    		$secret = config('app.bpjs_secret');

    		DB::connection('kasus')->beginTransaction();
    		$rujuk_luar = app('App\Http\Controllers\BPJS\Rujukan\EditController')->edit($request, $no_rujukan);
    		// dd(preg_split('/[\s]+/', $rujuk_luar->tanggal_rujuk)[0]);

			$data = [
				'bpjs_stage'		=> config('app.bpjs_stage'),
				'medify_cons_id'		=> $cons_id,
				'medify_secret' 		=> $secret, 
				'no_rujukan' 			=> $no_rujukan,
				'ppk_rujuk' 			=> $rujuk_luar->ppk_faskes,
				'tipe'					=> $rujuk_luar->tipe_rujuk,
				'jns_pelayanan' 		=> $rujuk_luar->jenis_rujuk,
				'catatan' 				=> $rujuk_luar->catatan,
				'diag_rujukan' 			=> $rujuk_luar->diagnosis,
				'tipe_rujukan' 			=> $rujuk_luar->tipe_rujuk,
				'poli_rujukan' 			=> $rujuk_luar->poli_rujuk,
				'user' 					=> Auth::user()->id
			];

			if(config('app.bpjs_enable', false)){
		    	$result =  app('App\Http\Controllers\BPJS\API\Rujukan\EditController')->edit($data);
				// dd($result, $result->response->rujukan->noRujukan);
		    }

    		$status = 1;
			$message = 'Berhasil melakukan perubahan';
			$title = 'Berhasil!';

            DB::connection('kasus')->commit();

    	} catch (\Exception $e) {
    		DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}

    	return redirect('/bpjs/rujukan/'.$no_rujukan)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
    }

    public function delete(Request $request)
    {
    	// dd($request);
    	try {
    		$cons_id = config('app.bpjs_cons_id');
    		$secret = config('app.bpjs_secret');

    		DB::connection('kasus')->beginTransaction();
    		$rujuk_luar = app('App\Http\Controllers\BPJS\Rujukan\DeleteController')->delete($request);

			$data = [
				'bpjs_stage'		=> config('app.bpjs_stage'),
				'medify_cons_id'		=> $cons_id,
				'medify_secret' 		=> $secret, 
				'no_rujukan' 			=> $request->no_rujukan,
				'user' 					=> Auth::user()->id
			];

			if(config('app.bpjs_enable', false)){
		    	$result =  app('App\Http\Controllers\BPJS\API\Rujukan\DeleteController')->delete($data);
				// dd($result, $result->response->rujukan->noRujukan);
		    }

    		$status = 1;
			$message = 'Berhasil menghapus data';
			$title = 'Berhasil!';

            DB::connection('kasus')->commit();

    	} catch (\Exception $e) {
    		DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}

    	return redirect('/bpjs/rujukan')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
    }

	public function createRujukanV2(Request $request){
		try {
			$header_array = $this->getInitThirdPartyBPJS()->getHeader();
			$set_data_create = app(\App\Http\Controllers\BPJS\Rujukan\CreateController::class)->setCreateRujukanV2($request);
			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/2.0/insert';
			// dd($url);
			$res = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Content-Encoding' => 'deflate',
				],
				\GuzzleHttp\RequestOptions::JSON => $set_data_create
			]);
			$rujukan = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)) {
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
				return (json_encode($rujukan_decoded));
			} else {
				return $rujukan;
			}
		} catch (\Throwable $th) {
			return $this->bugsnag($th);
		}
	}

	public function updateRujukanV2(Request $request){
		try {
			$header_array = $this->getInitThirdPartyBPJS()->getHeader();
			$set_data_create = app(\App\Http\Controllers\BPJS\Rujukan\EditController::class)->setUpdateRujukanV2($request);
			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/2.0/insert';
			// dd($url);
			$res = $client->request('POST', $url, [
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Content-Encoding' => 'deflate',
				],
				\GuzzleHttp\RequestOptions::JSON => $set_data_create
			]);
			$rujukan = $res->getBody()->getContents();
			if (config('app.bpjs_decrypt', false)) {
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
				return (json_encode($rujukan_decoded));
			} else {
				return $rujukan;
			}
		} catch (\Throwable $th) {
			return $this->bugsnag($th);
		}
	}

	public function setCreateV2(Request $request)
	{
		try {
			$data = app(\App\Http\Controllers\BPJS\Rujukan\CreateController::class)->setDataCreateRujukanV2($request);

			$data = new Request($data);

			if(config('app.bpjs_enable', false)){
		    	$result =  $this->createRujukanV2($data);
				$resp = json_decode($result);
		    	if($resp->metaData->code != 200)
		    		return back()
				    	->with('message', $resp->metaData->message)
						->with('title',"Gagal")
						->with('status', -1);
		    }

			DB::connection('kasus')->beginTransaction();
    		$rujuk_luar = app('App\Http\Controllers\BPJS\Rujukan\CreateController')->create($request, $resp->response->rujukan->noRujukan);
			DB::connection('kasus')->commit();
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);	
		}

		if(!empty($request->from_kasus)){
			$kasus = Kasus::find($request->kasus_id);
			return redirect('/kasus/'.$kasus->nomor_kasus.'/pengaturan')
			->with('message', 'Berhasil menyimpan data')
			->with('title', 'Berhasil')
			->with('status', 1);
		}

		return redirect('/bpjs/rujukan')
			->with('message', 'Berhasil menyimpan data')
			->with('title', 'Berhasil')
			->with('status', 1);
	}

	public function setEditV2(Request $request)
	{
		try {
			$data = app(\App\Http\Controllers\BPJS\Rujukan\EditController::class)->setUpdateRujukanDataV2($request);

			$data = new Request($data);

			if(config('app.bpjs_enable', false)){
		    	$result =  $this->updateRujukanV2($data);
				$resp = json_decode($result);
		    	if($resp->metaData->code != 200)
		    		return back()
				    	->with('message', $resp->metaData->message)
						->with('title',"Gagal")
						->with('status', -1);
		    }

			DB::connection('kasus')->beginTransaction();
    		$rujuk_luar = app('App\Http\Controllers\BPJS\Rujukan\EditController')->edit($request, $request->no_rujukan);
			DB::connection('kasus')->commit();
		} catch (\Exception $e) {
			DB::connection('kasus')->rollback();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);	
		}

		return redirect('/bpjs/rujukan')
			->with('message', 'Berhasil mengubah data')
			->with('title', 'Berhasil')
			->with('status', 1);
	}

	public function deleteRujukan(Request $request)
	{
		try {
			DB::connection('kasus')->beginTransaction();
			$header_array = $this->getInitThirdPartyBPJS()->getHeader();
			$set_data_create = app(\App\Http\Controllers\BPJS\Rujukan\DeleteController::class)->setDeleteRujukan($request);
			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl() . '/Rujukan/delete';
			// dd($url);
			$res = $client->request('DELETE', $url, [
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
					'Content-Encoding' => 'deflate',
				],
				\GuzzleHttp\RequestOptions::JSON => $set_data_create
			]);
			$rujukan = $res->getBody()->getContents();
			app(\App\Http\Controllers\BPJS\Rujukan\DeleteController::class)->delete($request);
			if (config('app.bpjs_decrypt', false)) {
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app('App\Http\Controllers\ThirdParty\BPJS\RequestController')->stringDecrypt($timestamp, $rujukan_decoded->response));
				$rujukan = (json_encode($rujukan_decoded));
			}
			DB::connection('kasus')->commit();
			return $rujukan;
		} catch (\Throwable $th) {
			DB::connection('kasus')->rollback();
			return $this->bugsnag($th);
		}
	}
}
