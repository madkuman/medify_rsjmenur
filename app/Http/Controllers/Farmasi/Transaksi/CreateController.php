<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;
use Image;
use File;
use Storage;
use Carbon\Carbon;

class CreateController extends Controller
{
	function createFromResepKasus($transaction, $request, $resep_kasus)
	{
		$kasus = $resep_kasus->kasus;
		$pembayaran = $kasus->pembayaran;
		if ($transaction == null) {
			$transaction = new TransaksiObat;
			$transaction->sep_id = $kasus->sep_id;
			$transaction->farmasi_id = $resep_kasus->farmasi_id;
			$transaction->created_by = auth()->id();
			$transaction->is_video = $request->is_video ?? 0;
			$transaction->pasien_id = $kasus->pasien_id;
			$transaction->metode_pembayaran_id = $pembayaran->id;
			$transaction->kasus_id = $kasus->id;
			$transaction->jenis_resep = $resep_kasus->jenis_resep;
			$transaction->lokasi_id = $kasus->lokasi->lokasi->id;
			$transaction->lokasi_text = $kasus->lokasi->lokasi->nama;
			$transaction->lokasi_id = $kasus->lokasi->lokasi_id;
			$transaction->lokasi_text = $kasus->lokasi->lokasi->nama;
			if ($request->input('dokter-jenis') == 'rsal') {
				$transaction->dokter_id = $request->input('dokter-rsal');
				$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($request->input('dokter-rsal'));
				if (!empty($dokter->name))
					$transaction->dokter_nama = $dokter->name;
				else {
					$transaction->dokter_id = 0;
					$transaction->dokter_nama = (!empty($dokter_luar)) ? $dokter_luar : '-';
				}
			} else {
				$transaction->dokter_id = 0;
				$transaction->dokter_nama = $request->input('dokter_luar');
			}
		} else {
			app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($transaction->resep_final);
		}
		$transaction->status = 0;
		$transaction->cito = $resep_kasus->cito;
		$transaction->save();

		$request->transaksi_id = $transaction->id;
		$resep = app(\App\Http\Controllers\Farmasi\Resep\CreateController::class)->createFromResepKasus($request, $resep_kasus);

		$transaction->resep_original = $resep->id;
		$transaction->no_resep = $resep->nomor_resep;
		$transaction->resep_final = $resep->id;
		$transaction->total_biaya_obat = $resep->jumlah_tagihan;
		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

		$resep = app(\App\Http\Controllers\Farmasi\Transaksi\EditController::class)->editStatus($transaction->id);

		return $transaction;
	}
	public function create(Request $request)
	{

		/*Atribut data yg perlu diset :
		farmasi = id apotek
		pasien = id pasien
		metode_pembayaran = id metode pembayaran
		kasus = id kasus resep
		sep_id = id sep
		(array)nama_obat = nama obat
		(array)obat = id obat pada gudang
		(array)jumlah = jumlah obat*/

		//(array)aturan = aturan obat

		DB::connection('farmasi')->beginTransaction();

		$farm = Farmasi::find($request->input('nama-apotek')); //$request->input('farmasi'));


		try {
			$transaction = $this->doCreate($request);

			DB::connection('farmasi')->commit();

			if ($request->no_redirect) {
				return $transaction;
			}

			//dd($transaction);
			return redirect('farmasi/' . $farm->slug . '/transaksi/' . $transaction->slug)
				->with('message', 'Transaksi baru berhasil dibuat')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('farmasi')->rollBack();

			return redirect()->back()
				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function doCreate(Request $request)
	{
		$kasus = Kasus::find($request->input('kasus_id'));
		$pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->get($request->input('metode_pembayaran'));
		$transaction = new TransaksiObat;
		$transaction->pasien_id = $request->input('pasien'); //$request->input('pasien');
		$transaction->metode_pembayaran_id = $pembayaran['id'];
		$transaction->kasus_id = $request->input('kasus_id');
		$transaction->jenis_resep = $request->jenis_resep;
		if (!empty($request->lokasi_id)) {
			$transaction->lokasi_id = $request->lokasi_id;
			$lokasi = Lokasi::find($request->lokasi_id);
			$transaction->lokasi_text = $lokasi->nama;
		} else {
			if ($kasus) {
				$transaction->lokasi_id = $kasus->lokasi->lokasi_id;
				$transaction->lokasi_text = $kasus->lokasi->lokasi->nama;
			}
		}
		$transaction->sep_id = $request->input('sep_id');
		$transaction->farmasi_id = $request->input('nama-apotek'); //$request->input('farmasi');
		$transaction->status = $request->status ? $request->status : 0;
		$transaction->deskripsi = $request->keterangan;
		$transaction->created_by = Auth::user()->id;
		if ($request->input('dokter-jenis') == 'rsal') {
			$transaction->dokter_id = $request->input('dokter-rsal');
			$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($request->input('dokter-rsal'));
			if (!empty($dokter->name))
				$transaction->dokter_nama = $dokter->name;
			else {
				$transaction->dokter_id = 0;
				$transaction->dokter_nama = (!empty($dokter_luar)) ? $dokter_luar : '-';
			}
		} else {
			$transaction->dokter_id = 0;
			$transaction->dokter_nama = $request->input('dokter_luar');
		}
		if ($request->input('cito')) {
			$transaction->cito = 1;
		}
		if ($request->input('eksekutif')) {
			$transaction->eksekutif = 1;
		}
		$transaction->is_video = $request->is_video ?? 0;
		$transaction->save();

		$request->transaksi_id = $transaction->id;
		$request->tipe = 0;
		$resep = app('App\Http\Controllers\Farmasi\Resep\CreateController')->create($request);

		$transaction->resep_original = $resep->id;
		$transaction->no_resep = $resep->nomor_resep;
		$transaction->resep_final = $resep->id;
		$transaction->total_biaya_obat = $resep->jumlah_tagihan;
		$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
		$transaction->save();

		$resep = app('App\Http\Controllers\Farmasi\Transaksi\EditController')->editStatus($transaction->id);

		return $transaction;
	}

	public function createOwn(Request $request)
	{
		// dd($request->all());
		$tanggal = explode('/', $request->tanggal_transaksi);
		// dd($tanggal);
		$tanggal_transaksi = implode('-', $tanggal);
		// dd($tanggal_transaksi);
		$status = $request->input('status_pasien');
		$farmasi = $request->input('farmasi');
		$nama_pasien = $request->input('nama_pasien');
		$pasien = $request->input('pasien');
		$kasus_id = $request->input('kasus');
		$antrian = $request->input('no_antrian');
		$shift = $request['shift'];
		// $tanggal_transaksi = $request->tanggal_transaksi;
		$dokter_jenis = $request['dokter-jenis'];
		$dokter_rsal = $request['dokter-rsal'];
		$dokter_luar = $request['dokter-luar'];

		DB::connection('farmasi')->beginTransaction();

		$farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
		$kasus = Kasus::find($kasus_id);

		try {
			$transaction = new TransaksiObat;
			if (!$status) $transaction->pasien_id = $pasien;
			else $transaction->nama_pasien = (!empty($nama_pasien)) ? $nama_pasien : 'Pasien Bebas';

			if (!empty($request->lokasi_id)) {
				$transaction->lokasi_id = $request->lokasi_id;
				$lokasi = Lokasi::find($request->lokasi_id);
				$transaction->lokasi_text = $lokasi->nama;
			} else {
				if ($kasus) {
					$transaction->lokasi_id = $kasus->lokasi->lokasi_id;
					$transaction->lokasi_text = $kasus->lokasi->lokasi->nama;
				}
			}

			if ($kasus) {


				$transaction->metode_pembayaran_id = $kasus->pasien_pembayaran_id;
				$transaction->kasus_id = $kasus_id;
				if ($kasus->aktif_sep) $transaction->sep_id = $kasus->aktif_sep->no_sep;
			}
			$transaction->shift_id = $shift;
			$transaction->farmasi_id = $farm->id; //$request->input('farmasi');
			$transaction->status = 0;
			$transaction->no_antrian = $antrian;
			$transaction->created_at = Carbon::createFromFormat('d-m-Y', $tanggal_transaksi, 'Asia/Jakarta');
			$transaction->created_by = Auth::user()->id;
			if ($dokter_jenis == 'rsal') {
				$transaction->dokter_id = $dokter_rsal;
				$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
				if (!empty($dokter->name))
					$transaction->dokter_nama = $dokter->name;
				else {
					$transaction->dokter_id = 0;
					$transaction->dokter_nama = (!empty($dokter_luar)) ? $dokter_luar : '-';
				}
			} else {
				$transaction->dokter_id = 0;
				$transaction->dokter_nama = (!empty($dokter_luar)) ? $dokter_luar : '-';
			}
			$transaction->save();

			$request->transaksi_id = $transaction->id;
			$request->tipe = 0;
			$resep = app('App\Http\Controllers\Farmasi\Resep\CreateController')->createWithRacikan($request);

			$transaction->resep_original = $resep->id;
			$transaction->resep_final = $resep->id;
			$transaction->no_resep = $resep->nomor_resep;
			$transaction->total_biaya_obat = $resep->jumlah_tagihan;
			$transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
			$transaction->save();

			DB::connection('farmasi')->commit();
			//dd($transaction);
			return redirect('farmasi/' . $farm->slug . '/transaksi/' . $transaction->slug)
				->with('message', 'Transaksi baru berhasil dibuat')
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('farmasi')->rollBack();

			return redirect()->back()
				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	public function copy(Request $request)
	{
		$id = $request->input('id');
		$farmasi = $request->input('farmasi');
		$description = $request->input('keterangan');
		$items = $request->input('barang');
		$qty = $request->input('jumlah');
		$antrian = $request->input('no_antrian');

		//dd($qty);
		$farm = Farmasi::find($farmasi);
		$transaction = TransaksiObat::find($id);

		DB::connection('farmasi')->beginTransaction();

		try {
			$transaksi = new TransaksiObat;
			$transaksi->deskripsi = $description;
			$transaksi->transaksi_asal_id = $transaction->id;
			$transaksi->pasien_id = $transaction->pasien_id;
			$transaksi->nama_pasien = $transaction->nama_pasien;
			$transaksi->metode_pembayaran_id = $transaction->metode_pembayaran_id;
			$transaksi->perusahaan_tipe_id = $transaction->perusahaan_tipe_id;
			$transaksi->lokasi_id = $transaction->lokasi_id;
			$transaksi->dokter_id = $transaction->dokter_id;
			$transaksi->jenis_resep = $transaction->jenis_resep;
			$transaksi->shift_id = $transaction->shift_id;
			$transaksi->dokter_nama = $transaction->dokter_nama;
			$transaksi->kasus_id = $transaction->kasus_id;
			$transaksi->sep_id = $transaction->sep_id;
			$transaksi->no_antrian = $antrian;
			$transaksi->farmasi_id = $transaction->farmasi_id;
			$transaksi->status = 0;
			$transaksi->created_by = Auth::user()->id;
			$transaksi->save();
			DB::connection('farmasi')->commit();
			DB::connection('farmasi')->beginTransaction();

			$request->transaksi_id = $transaksi->id;
			$request->tipe = 0;
			$resep = app('App\Http\Controllers\Farmasi\Resep\CreateController')->createWithRacikan($request);

			$transaksi->resep_original = $resep->id;
			$transaksi->resep_final = $resep->id;
			$transaksi->total_biaya_obat = $resep->jumlah_tagihan;
			$transaksi->slug = str_pad($transaksi->id, 10, '0', STR_PAD_LEFT);
			$transaksi->save();

			$is_done = true;
			foreach ($transaction->final_detail->resep_detail as $resep_detail) {
				if ($resep_detail->jumlah != 0) {
					$is_done = false;
				}
			}
			$transaction->status = $is_done ? 1 : 0;
			$transaction->save();


			DB::connection('farmasi')->commit();
			return redirect('farmasi/' . $farm->slug . '/transaksi/' . $transaction->slug)
				->with('message', "Copy Resep Berhasil Dibuat")
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (\Exception $e) {
			DB::connection('farmasi')->rollBack();
			if ($transaksi) {
				DB::connection('farmasi')->beginTransaction();
				$transaksi->delete();
				DB::connection('farmasi')->commit();
			}
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return redirect()->back()
				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}

	/*private function generateQty($roman)
	 {
	     $romans = array(
	      'M' => 1000,
	      'CM' => 900,
	      'D' => 500,
	      'CD' => 400,
	      'C' => 100,
	      'XC' => 90,
	      'L' => 50,
	      'XL' => 40,
	      'X' => 10,
	      'IX' => 9,
	      'V' => 5,
	      'IV' => 4,
	      'I' => 1,
	  );

	  $result = 0;

	  foreach ($romans as $key => $value) {
	      while (strpos($roman, $key) === 0) {
	          $result += $value;
	          $roman = substr($roman, strlen($key));
	      }
	  }
	  return $result;
	 }

	 public function createResep(Request $request) {




     }*/
	public function alihResep(Request $request)
	{
		$data = $request->all();

		DB::connection('farmasi')->beginTransaction();
		try {
			$farm = Farmasi::where('slug', $data['farmasi_now'])->first();
			$transaction = TransaksiObat::find($data['id']);
			$transaction->farmasi_id = $data['farmasi'];
			$transaction->save();


			$resep = Resep::find($transaction->resep_final);
			$resep->farmasi_id = $data['farmasi'];
			$resep->save();

			//alih non racikan
			$resep_detail = ResepDetail::with('obat_detail')->where('resep_id', $transaction->resep_final)->where('tipe', '!=', 1)->get();
			$item_template_array = $resep_detail->pluck('obat_detail.item_template_id')->toArray();

			$items_farmasi_baru = ItemsFarmasi::whereIn('item_template_id', $item_template_array)->where('farmasi_id', $data['farmasi'])->get();

			foreach ($resep_detail as $key => $detail) {
				$detail->obat_id = $items_farmasi_baru->firstWhere('item_template_id', $detail->obat_detail->item_template_id)->id;
				$detail->save();
			}

			//alih racikan
			$resep_detail = ResepDetail::with('racikan.obat_detail')->where('resep_id', $transaction->resep_final)->where('tipe', 1)->get();

			foreach ($resep_detail as $key => $detail) {
				$item_template_array = $detail->racikan->pluck('obat_detail.item_template_id')->toArray();

				$items_farmasi_baru = ItemsFarmasi::whereIn('item_template_id', $item_template_array)->where('farmasi_id', $data['farmasi'])->get();

				foreach ($detail->racikan as $racikan) {
					$racikan->obat_id = $items_farmasi_baru->firstWhere('item_template_id', $racikan->obat_detail->item_template_id)->id;
					$detail->save();
				}
			}


			DB::connection('farmasi')->commit();
			return redirect('farmasi/' . $farm->slug . '/transaksi')
				->with('message', "Resep Berhasil dialihkan ke " . $transaction->owner_detail->nama)
				->with('status', 1)
				->with('title', 'Sukses');
		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('farmasi')->rollBack();

			return redirect()->back()
				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
				->with('status', -1)
				->with('title', 'Gagal');
		}
	}
}
