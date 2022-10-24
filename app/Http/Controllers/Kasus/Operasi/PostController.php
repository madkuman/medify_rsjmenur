<?php

namespace App\Http\Controllers\Kasus\Operasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function permintaan($nomor_kasus, Request $request)
	{
		// dd($request);
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
        		$keterangan = $request['keterangan'];
        		$jenis_spesialis_id = $request['jenis_spesialis_id'];

			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$diagnosis = app('App\Http\Controllers\Kasus\Diagnosis\ReadController')->getDiagnosisByKasus($kasus->id);
			$diagnosis_string = $diagnosis->icd10->code_icd.' - '.$diagnosis->icd10->long_desc;
			$input_diagnosis = $diagnosis->icd10->id;
			$dokter_id = Auth::user()->id;
			$transaksi_operasi = app('App\Http\Controllers\KamarOperasi\Transaksi\PostController')->daftarOperasiKasus($kasus->pasien_id,$kasus->id,$diagnosis_string,$input_diagnosis, $dokter_id,$kasus->pasien_pembayaran_id, $keterangan,$jenis_spesialis_id,$request->icd9_id);

			$transaksi_global = app('App\Http\Controllers\Kasus\OperasiPermintaan\CreateController')->create($kasus->id,$transaksi_operasi->id, $keterangan);

			$status = 1;
			$message = 'Pasien berhasil didaftarkan';
			$title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

       	} catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}
}
