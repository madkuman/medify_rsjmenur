<?php

namespace App\Http\Controllers\Farmasi\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\AturanHarga;
use App\Models\Farmasi\AturanShift;
use DB;
use Bugsnag;
use Image;
use File;
use Storage;

class EditController extends Controller
{
    public function edit(Request $request)
	{
		$id = $request->input('farmasi_id');
		$farm = $request->input('farmasi');
		$name = $request->input('name');
		$kasie = $request->input('kasie');
        $no_sipa = $request->input('no_sipa');
		$phone = $request->input('phone');
		$refer = $request->input('refer');
		$shift = $request->input('shift');
		$bulat = $request->input('pembulatan');
		$is_produksi = $request->input('is_produksi');
		$hari = $request->input('perharian');
		$cash = $request->input('cash');
		$consis = $request->input('consis');
		$kemoterapi = $request->input('kemoterapi');
		$stok_kurang_confirm = $request->input('stok_kurang_confirm');
		$perusahaan_tipe_id = $request->input('perusahaan_tipe_id');
		$min = $request->input('harga_min');
		$max = $request->input('harga_max');
		$mulai = $request->input('waktu_mulai');
		$selesai = $request->input('waktu_selesai');
		$nama_shift = $request->input('nama_shift');
		$keterangan_shift = $request->input('keterangan_shift');
		$laba = $request->input('laba');

		DB::connection('farmasi')->beginTransaction();
		DB::connection('keuangan')->beginTransaction();
		DB::connection('mysql')->beginTransaction();

		try {
			$pharmacy = Farmasi::find($id);
			if ($name == $pharmacy->nama) {
				# code...
			}
			else{
				if(!is_null(Farmasi::where('nama', $name)->first())) 
					return redirect()->back()
						->with('status', -1)
						->with('message', 'Farmasi telah terdaftar')
						->with('title', 'Gagal');	
			}

			$pharmacy->nama = $name;
			$pharmacy->kasie = $kasie;
            $pharmacy->no_sipa = $no_sipa;
			$pharmacy->telepon = $phone;
			$pharmacy->pembulatan = is_null($bulat) ? $bulat : 1;
			$pharmacy->perharian = is_null($hari) ? $hari : 1;
			$pharmacy->cash = is_null($cash) ? $cash : 1;
			$pharmacy->consis = is_null($consis) ? $consis : 1;
			$pharmacy->kemoterapi = is_null($kemoterapi) ? $kemoterapi : 1;
			$pharmacy->is_produksi = is_null($is_produksi) ? $is_produksi : 1;
			$pharmacy->stok_kurang_confirm = is_null($stok_kurang_confirm) ? $stok_kurang_confirm : 1;
			$pharmacy->save();

			//EDIT DELETE LABA
			foreach ($pharmacy->aturan_harga as $atur) {
				if(is_array($refer) && in_array($atur->id, $refer)) {
					$key = array_search($atur->id, $refer);
					$atur->perusahaan_tipe_id = $perusahaan_tipe_id[$key];
					$atur->harga_min = $min[$key];
					$atur->harga_max = $max[$key];
					$atur->laba = $laba[$key];
					$atur->save();
				}
				else {
					$harga = AturanHarga::find($atur->id);
					$harga->delete();
				}
			}
			if (is_array($refer))
				foreach ($refer as $key => $value) {
					if ($value == '0') {
						$harga = new AturanHarga;
						$harga->farmasi_id = $pharmacy->id;
						$harga->perusahaan_tipe_id = $perusahaan_tipe_id[$key];
						$harga->harga_min = $min[$key];
						$harga->harga_max = $max[$key];
						$harga->laba = $laba[$key];
						$harga->save();
					} else continue;
				}

			//EDIT DELETE SHIFT
			foreach ($pharmacy->aturan_shift as $atur) {
				if(is_array($shift) && in_array($atur->id, $shift)) {
					$key = array_search($atur->id, $shift);
					$atur->nama = $nama_shift[$key];
					$atur->keterangan = $keterangan_shift[$key];
					$atur->waktu_min = $mulai[$key];
					$atur->waktu_max = $selesai[$key];
					$atur->save();
				}
				else {
					$shift = AturanShift::find($atur->id);
					$shift->delete();
				}
			}
			if(is_array($shift))
				foreach ($shift as $key => $value) {
					if ($value == '0') {
						$shift = new AturanShift;
						$shift->farmasi_id = $pharmacy->id;
						$shift->nama = $nama_shift[$key];
						$shift->keterangan = $keterangan_shift[$key];
						$shift->waktu_min = $mulai[$key];
						$shift->waktu_max = $selesai[$key];
						$shift->save();
					} else continue;
				}


			$name ='Farmasi - '.$pharmacy->nama;
			$lokasi = app('App\Http\Controllers\Hospital\Lokasi\EditController')->edit($pharmacy->lokasi_id,$name);
			
			DB::connection('keuangan')->commit();
			DB::connection('mysql')->commit();
			DB::connection('farmasi')->commit();
			return back()
					->with('message', 'Pengaturan Farmasi berhasil diubah')
	            	->with('status', 1)
	            	->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('keuangan')->rollBack();
			DB::connection('mysql')->rollBack();
    		DB::connection('farmasi')->rollBack();

    		return redirect()->back()
    		->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
    		->with('status', -1)
    		->with('title', 'Gagal');
		}
		
		/*else
			return redirect('/apotek/new')->with('failed', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi');*/
	}

	public function editShift(Request $req, $slug)
	{
		try {
			$farmasi = Farmasi::where('slug', $slug)->first();
			$farmasi->current_shift_id = $req['shift'];
			$farmasi->save();

			$msg = 'Shift saat ini berhasil diubah';
			$status = 1;
			$title = 'Berhasil';
	
		} catch (Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			$msg = 'Shift saat ini gagal diubah';
			$status = -1;
			$title = 'Gagal';
		}
     	return redirect()->back()
			->with('message', $msg)
			->with('status', $status)
			->with('title', $title);
	}

}