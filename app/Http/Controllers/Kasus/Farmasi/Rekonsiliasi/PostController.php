<?php

namespace App\Http\Controllers\Kasus\Farmasi\Rekonsiliasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RekonsiliasiObat;
use App\Models\Kasus\RekonsiliasiObatDetail;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DB;
use Auth;

class PostController extends Controller
{
	public function post($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			if(empty($request->id)){
				$rekon = new RekonsiliasiObat;
				$rekon->kasus_id = $kasus->id;
				$rekon->created_by = Auth::user()->id;
				$message = 'Rekonsiliasi Obat Berhasil Dibuat';
			}
			else
			{
				$rekon = RekonsiliasiObat::find($request->id);
				$rekon->updated_by = Auth::user()->id;
				$message = 'Rekonsiliasi Obat Berhasil Di Update';
			};
			$rekon->judul = $request->judul;
			$rekon->jenis = $request->jenis;
			$rekon->save();

			$ids_to_delete = RekonsiliasiObatDetail::where('rekonsiliasi_obat_id',$rekon->id)->pluck('id')->toArray();
			$update = RekonsiliasiObatDetail::where('rekonsiliasi_obat_id',$rekon->id)->update(['deleted_by' => Auth::user()->id]);
			$delete = RekonsiliasiObatDetail::destroy($ids_to_delete);

			foreach($request->obat_nama as $index => $obat_nama)
			{
				$tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal[$index]);

				$detail = new RekonsiliasiObatDetail;
				$detail->rekonsiliasi_obat_id = $rekon->id;
				$detail->tanggal = $tanggal;
				$detail->obat_nama = $request->obat_nama[$index];
				$detail->obat_id = $request->obat_id[$index];
				$detail->dosis = $request->dosis[$index];
				$detail->jumlah = $request->jumlah[$index];
				$detail->rute = $request->rute[$index];
				$detail->aturan_pakai = $request->aturan_pakai[$index];
				$detail->diteruskan_dosis = $request->diteruskan_dosis[$index];
				$detail->diteruskan_aturan_pakai = $request->diteruskan_aturan_pakai[$index];
				$detail->dihentikan = $request->dihentikan[$index];
				$detail->asal_obat = $request->asal_obat[$index];
				$detail->created_by = Auth::user()->id;
				$detail->save();
			}


			$status = 1;
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();

			$status = -1;
			$message = 'Transaksi gagal ! Terjadi Kesalahan Server';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}
	}

	public function delete($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$rekon = RekonsiliasiObat::find($request->id);
			$rekon->deleted_by = Auth::user()->id;
			$rekon->save();


			$ids_to_delete = RekonsiliasiObatDetail::where('rekonsiliasi_obat_id',$request->id)->pluck('id')->toArray();
			$update = RekonsiliasiObatDetail::where('rekonsiliasi_obat_id',$rekon->id)->update(['deleted_by' => Auth::user()->id]);
			$delete = RekonsiliasiObatDetail::destroy($ids_to_delete);


			$rekon->delete();

			$status = 1;
			$title = 'Berhasil!';
			$message = 'Rekonsiliasi berhasil dihapus';

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			DB::connection('kasus')->rollback();

			$status = -1;
			$message = 'Transaksi gagal ! Terjadi Kesalahan Server';
			$title = 'Gagal!';

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
		}

	}
}
