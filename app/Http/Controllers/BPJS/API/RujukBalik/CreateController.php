<?php

namespace App\Http\Controllers\BPJS\API\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class CreateController extends Controller
{
    public function create($param)
	{
		try {
			$content = app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\RujukBalik\CreateController::class)->create($param);

			#example-response
			// $content = '{"metaData":{"code":"200","message":"Sukses"},"response":{"DPJP":{"kode":"27510","nama":"Suwito, dr. Sp.PD"},"keterangan":"Capek Kerja","noSRB":"94111924","obat":{"list":[{"jmlObat":"1","nmObat":"Vitamin B1 (Thiamin HCl) tab 50 mg","signa":"1 x 1"},{"jmlObat":"1","nmObat":"Analog Insulin Mix Acting Inj 100 UI/ml ","signa":"1 x 1"}]},"peserta":{"alamat":"Jl. Medan Merdekah","asalFaskes":{"kode":"01691101","nama":"Klinik KALIGANGSAS"},"email":"email@gmail.com","kelamin":"P","nama":"SITI JUBAEDAH","noKartu":"000999979951","noTelepon":"081234567890","tglLahir":"1945-09-06"},"programPRB":"Systemic Lupus Erythematosus","saran":"Pasien harus cuti setiap minggu, edukasi agar jangan disuruh kerja terus, lama lama stress..","tglSRB":"2018-01-08"}}';
       
			return $content;
		} catch (RequestException $e) {
			if ($e->hasResponse()) {
				echo Psr7\str($e->getResponse());
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		} catch (\Exception $e){
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}
}
