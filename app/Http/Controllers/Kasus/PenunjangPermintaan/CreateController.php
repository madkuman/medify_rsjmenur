<?php

namespace App\Http\Controllers\Kasus\PenunjangPermintaan;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Radiology\Transaction\CreateController as CreateRadiologi;
use App\Http\Controllers\LabPK\Transaksi\CreateController as CreateLabPK;
use App\Models\Kasus\PenunjangPermintaan;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
	protected $createRadiologi;
	protected $createLabPK;

	public function __construct(CreateRadiologi $createRadiologi, CreateLabPK $createLabPK)
	{
		$this->createRadiologi = $createRadiologi;
		$this->createLabPK = $createLabPK;
	}


	public function radiologi($request, $radiologi)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			//get lokasi
			//$lokasi = $kasus->lokasi->lokasi;

			//buat permintaan
			$permintaan = new PenunjangPermintaan;
			$permintaan->kasus_id = $request['kasus_id'];
			$permintaan->modul_id = 6;
			$permintaan->created_by = !empty($request->dokter) ? $request->dokter : Auth::user()->id;
			$permintaan->transaksi_id = $radiologi['id'];
			//dd($permintaan);
			$permintaan->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($request['kasus_id'],'create','penunjang-radiologi',$radiologi['id']);

			//buat transaksi di radiologi
			//$transaksi = $this->createRadiologi->createPermintaan($services,$lokasi, $kasus->pasien_id,$kasus->id);


			//update permintaanPenunjang berdasarkan transaksi yang didapet di radiologi
		 	DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $permintaan;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }

		
	}

	public function labpa($request, $labpa)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			//get lokasi
			//$lokasi = $kasus->lokasi->lokasi;

			//buat permintaan
			$permintaan = new PenunjangPermintaan;
			$permintaan->kasus_id = $request['kasus_id'];
			$permintaan->modul_id = 11;
			$permintaan->created_by = !empty($request->dokter) ? $request->dokter : Auth::user()->id;
			$permintaan->nama_dokter = $request->dokter;
			$permintaan->transaksi_id = $labpa['id'];
			//dd($permintaan);
			$permintaan->save();
			
			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($request['kasus_id'],'create','penunjang-labpa',$labpa['id']);

			//buat transaksi di radiologi
			//$transaksi = $this->createRadiologi->createPermintaan($services,$lokasi, $kasus->pasien_id,$kasus->id);


			//update permintaanPenunjang berdasarkan transaksi yang didapet di radiologi

			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $permintaan;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}

	public function labpk($request, $labpk)
	{
		DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
			//get lokasi
			//$lokasi = $kasus->lokasi->lokasi;

			//buat permintaan
			$permintaan = new PenunjangPermintaan;
			$permintaan->kasus_id = $request['kasus_id'];
			$permintaan->modul_id = 10;
			$permintaan->created_by = !empty($request->dokter) ? $request->dokter : Auth::user()->id;
			$permintaan->nama_dokter = $request->dokter;
			$permintaan->transaksi_id = $labpk['id'];
			$permintaan->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($request['kasus_id'],'create','penunjang-labpk',$labpk['id']);

			//buat transaksi di radiologi
			//$transaksi = $this->createLabPK->createPermintaan($services,$lokasi, $kasus->pasien_id,$kasus->id,$jam_sampling);

			//update permintaanPenunjang berdasarkan transaksi yang didapet di radiologi
			//$permintaan->transaksi_id = $transaksi->id;
			//$permintaan->save();

			DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return $permintaan;

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}
}
