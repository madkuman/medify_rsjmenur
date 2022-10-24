<?php

namespace App\Http\Controllers\KamarOperasi\Kamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Ruangan;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
	public function new(Request $request)
	{
		DB::connection('kamaroperasi')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$exist = $this->checkNamaKamar($request->input('kategori'), $request->input('name'));
			if($exist)
			{
				$message = 'Nama Kamar '.$request->input('name').' Sudah Ada!';
				$title = 'Gagal!';
				$status = -1;

				return redirect('kamaroperasi/kamar/create')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status)
				->withInput();
			}

			$kamar = new Ruangan;
			$kamar->name = $request->input('name');
			$kamar->farmasi_id = $request->input('farmasi');
			$kamar->kategori = $request->input('kategori');
			$kamar->ronde = $request->input('ronde');
			$logo = $request->file('logo');
			if ($logo) {
				$cleaned_name = preg_replace("/[^0-9a-zA-Z]/", "", $kamar->name);
				$filename = $cleaned_name.'.'.$logo->getClientOriginalExtension();
				$dir = public_path('/uploads/kamaroperasi/logo_ruangan');
				$logo->move($dir, $filename);
				$kamar->image_thumb = '/uploads/kamaroperasi/logo_ruangan/'.$filename;
			}
			$kamar->save();



			$name = 'Kamar Operasi - '.$kamar->name;
			$slug = 'kamar-operasi';

			$kategori_keuangan = app('App\Http\Controllers\Keuangan\Kategori\CreateController')->createBySlugName($slug,$name);		
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\CreateController')->createBySlug($name,$slug,$kategori_keuangan->id);

			$kamar->lokasi_id = $lokasi->id;
			$kamar->save();

			$message = 'Data Kamar Berhasil Ditambah!';
			$title = 'Berhasil!';
			$status = 1;


			DB::connection('kamaroperasi')->commit();
			DB::connection('mysql')->commit();

			return redirect('kamaroperasi/kamar')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kamaroperasi')->rollback();
			DB::connection('mysql')->rollback();


			$status = -1;
			$message = 'Kamar gagal dibuat!';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function checkNamaKamar($kategori, $nama)
	{
		$exist = Ruangan::where('kategori', $kategori)->where('name', $nama)->count();
		return $exist == 1;
	}
}
