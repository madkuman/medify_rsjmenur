<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SKDirawat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KetKelahiran;
use Auth;
use DB;
use Carbon\Carbon;

define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class PostController extends Controller
{	
	public function create($nomor_kasus,Request $request) // 1=cowok, 2=cewek
    {
    	// dd($request);
        try {
            DB::connection('kasus')->beginTransaction();
            $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
            $ket = new KetKelahiran;
            $ket->kasus_id = $kasus->id;
            $ket->nama_ibu = $kasus->pasien->name;
            $ket->nama_ayah = $request->suami;
            $ket->tanggal = Carbon::parse($request->tanggal);
            $ket->jam = $request->jam_kelahiran;
            $ket->dokter_id = $request->dokter;
            $ket->perawat_id = $request->perawat;
            $ket->created_by = Auth::user()->id;
            $ket->kelamin = $request->kelamin;
            $ket->save();
            $status = 1;
			$message = 'Keterangan kelahiran berhasil dibuat';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','alat-keterangan kelahiran',$ket->id);

            DB::connection('kasus')->commit();
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
        } catch (Exception $e) {
        	DB::connection('kasus')->rollBack();
            if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Keterangan Kelahiran Gagal Dibuat!';
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
		DB::connection('mysql')->beginTransaction();
		try
		{
			$id = $request->id;
			$ket = KetKelahiran::find($id);
			$ket->delete();

			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-keterangan kelahiran',$ket->id);


			$status = 1;
			$message = 'Keterangan Kelahiran berhasil dihapus!';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Keterangan Kelahiran gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
	}
}
