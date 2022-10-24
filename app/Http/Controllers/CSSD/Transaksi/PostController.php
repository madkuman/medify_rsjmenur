<?php

namespace App\Http\Controllers\CSSD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function permintaanBaru(Request $request)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{

			$data['type'] = 1;
			$data['ok_transaksi_id'] = $request->transaksi_ok_id;
			$data['status'] = 0;
			$data['keterangan'] = 'Permintaan Melalui Modul CSSD';
			$transaksi = app('App\Http\Controllers\CSSD\Transaksi\CreateController')->create($data);


			$data_detail['alkes_id'] = $request->alkes_id;
			$data_detail['alkes_jumlah'] = $request->alkes_jumlah;
			$data_detail['transaksi_id'] = $transaksi->id;
			$alkes_satuan = app('App\Http\Controllers\CSSD\TransaksiDetail\CreateController')->create($data_detail);

			$status = 1;
			$message = 'Alkes berhasil dibuat';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/transaksi/'.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();
			

			$status = -1;
			$message = 'Alkes gagal dibuat';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}

	public function ApiTransaksiBaru($data,$data_detail)
	{
		
		$data['status'] = 0;
		$transaksi = app('App\Http\Controllers\CSSD\Transaksi\CreateController')->create($data);

		$data_detail['transaksi_id'] = $transaksi->id;
		$alkes_satuan = app('App\Http\Controllers\CSSD\TransaksiDetail\CreateController')->create($data_detail);

		return $transaksi;

	}

	public function ApiTransaksiBaruPost()
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$data['type'] = 2; //1 UNTUK PERMINTAAN 2 UNTUK PENGEMBALIAN
			$data['ok_transaksi_id'] = 135; //ID TRANSAKSI KAMAR OPERASI
			$data['keterangan'] = 'Permintaan Melalui Modul Testing'; // KETERANGAN ISI SENDIRI BIASANYA SI PERMINTAAN MELALUI KAMAR OPERASI

			$data_detail['alkes_id'] = [4,5]; //ARRAY ID_ALKES DARI DB CSSD TABEL ALKES
			$data_detail['alkes_jumlah'] = [2,2]; //JUMLAH UNTUK MASING MASING ALKES

			$this->ApiTransaksiBaru($data,$data_detail); //PANGGIL FUNGSINYA
			
			DB::connection('cssd')->commit();
		}
		catch (\Exception $e) 
		{
			DB::connection('cssd')->rollBack();
		}
	}

	public function kirimAlkes(Request $request,$id)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$is_edit = $request->is_edit;
			if($is_edit == 'true') $delete_transaksi_detail = app('App\Http\Controllers\CSSD\TransaksiDetail\DeleteController')->deletePengirimanAlkes($id);
			$slugs = $request->slug;
			$transaksi_detail = app('App\Http\Controllers\CSSD\TransaksiDetail\EditController')->kirimAlkes($id,$slugs);
			$transaksi = app('App\Http\Controllers\CSSD\Transaksi\EditController')->editStatus($id,1);
			$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\EditController')->editOkTransaksiIDbySlug($slugs,$transaksi->ok_transaksi_id,$id);

			$status = 1;
			$message = 'Alkes berhasil dikirim';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/transaksi/'.$id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal dikirim';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}
	public function pengembalianBaru(Request $request)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$data['type'] = 2;
			$data['ok_transaksi_id'] = $request->transaksi_ok_id;
			$data['status'] = 0;
			$data['keterangan'] = 'Permintaan Melalui Modul CSSD';
			$transaksi = app('App\Http\Controllers\CSSD\Transaksi\CreateController')->create($data);


			$data_detail['alkes_id'] = $request->alkes_id;
			$data_detail['alkes_jumlah'] = $request->alkes_jumlah;
			$data_detail['transaksi_id'] = $transaksi->id;
			$alkes_satuan = app('App\Http\Controllers\CSSD\TransaksiDetail\CreateController')->create($data_detail);

			$status = 1;
			$message = 'Alkes berhasil dibuat';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/transaksi/'.$transaksi->id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal dibuat';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}



	public function kembalikanAlkes(Request $request,$id)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$is_edit = $request->is_edit;
			if($is_edit == 'true') $delete_transaksi_detail = app('App\Http\Controllers\CSSD\TransaksiDetail\DeleteController')->deletePengembalianAlkes($id);
			$slugs = $request->slug;
			
			
			$transaksi_detail = app('App\Http\Controllers\CSSD\TransaksiDetail\EditController')->kirimAlkes($id,$slugs);
			$transaksi = app('App\Http\Controllers\CSSD\Transaksi\EditController')->editStatus($id,1);
			$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\EditController')->editNullOkTransaksiIDbySlug($slugs);

			$status = 1;
			$message = 'Alkes berhasil dikembalikan';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/transaksi/'.$id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Alkes gagal dikembalikan';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}

	public function tolakTransaksi(Request $request,$id)
	{
		DB::connection('cssd')->beginTransaction();
		try
		{
			$transaksi = app('App\Http\Controllers\CSSD\Transaksi\EditController')->editStatus($id,-1,$request->keterangan);

			$status = 1;
			$message = 'Transaksi berhasil ditolak';
			$title = 'Berhasil!';

			DB::connection('cssd')->commit();

			return redirect('cssd/transaksi/'.$id)
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('cssd')->rollBack();

			$status = -1;
			$message = 'Transaksi gagal ditolak';
			$title = 'Terjadi Kesalahan!';


			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}
}
