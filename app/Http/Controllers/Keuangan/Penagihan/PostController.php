<?php

namespace App\Http\Controllers\Keuangan\Penagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\Pasien\Pasien;
use App\Models\Keuangan\PaketPenagihan;
use App\Models\Keuangan\PenagihanBPJS;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\Perusahaan;

class PostController extends Controller
{

	public function pembayaran(Request $req, $slug)
	{
		try {
			// dd($req->all(), 'lho cok');
			DB::connection('keuangan')->beginTransaction();
			DB::connection('kasus')->beginTransaction();
			$paket = PaketPenagihan::where('slug', $slug)->first();
			$this->checkToAbort($paket);
			
			$akun_id = $paket->akun_id;
			$total = $req->total;
			$bayar = $req->total_bayar;

			$selisih = $bayar-$total;
			
			if($selisih > 0){
				$data['untung_rs'] = $selisih;
				$data['rugi_rs'] = 0;
				$untung = $selisih;
				$rugi = 0;
			} else if($selisih < 0){
				$data['untung_rs'] = 0;
				$data['rugi_rs'] = $selisih;
				$untung = 0;
				$rugi = $selisih;
			} else {	
				$data['untung_rs'] = 0;
				$data['rugi_rs'] = 0;
				$untung = 0;
				$rugi = 0;
			}
			
			// if($paket->pembayaran_perusahaan_tipe_id == 1)
			// {

			// 	$data['kerugian_total'] = $data['rugi_rs'];
			// 	$data['deposit_used'] = 0;
			// 	$data['cash_used'] = 0;
			// 	$data['total_bayar'] = $bayar;

			// 	if(is_null($paket->paket_pemasukan))
			// 		$paket_pemasukan = app('App\Http\Controllers\Keuangan\PaketPemasukan\CreateController')->create($req, $paket);
			// 	else{
			// 		$paket_pemasukan = $paket->paket_pemasukan;
			// 		$paket_pemasukan->total += $bayar;
			// 		$paket_pemasukan->save();
			// 	}

			// 	$paket->total_paid +=$bayar;
			// 	$paket->paket_pemasukan_id = $paket_pemasukan->id;
			// 	$paket->cashier_by = Auth::user()->id;
			// 	$paket->save();

			// 	if($req->jenis_pembayaran == "multi")
			// 	{

			// 		foreach($paket->detail_bpjs as $penagihan_bpjs)
			// 		{
			// 			if($penagihan_bpjs->total == $penagihan_bpjs->total_paid)
			// 				continue;
			// 			$remain = app('App\Http\Controllers\Keuangan\Piutang\PostController')->paySingleBpjs($penagihan_bpjs, $data, $paket_pemasukan);
			// 			if($remain == 0)
			// 				break;
			// 			else
			// 				$data['total_bayar'] = $remain;
			// 		}
			// 	} else
			// 	{
			// 		$penagihan_bpjs = PenagihanBPJS::find($req->penagihan_bpjs_id);

			// 		app('App\Http\Controllers\Keuangan\Piutang\PostController')->paySingleBpjs($penagihan_bpjs, $data, $paket_pemasukan);
			// 	}

			// 	app('App\Http\Controllers\Keuangan\Penagihan\EditController')->UpdateStatusPembayaran($paket, config('const.state_dibayar'));

			// } else
			// {
				$piutang_id = $req->piutang_id;
				$paket_pemasukan = (new \App\Http\Controllers\Keuangan\PaketPemasukan\CreateController())->create($req, $paket);
				foreach($paket->detail as $piutang)
				{
						$pay_piutang = (new \App\Http\Controllers\Keuangan\Piutang\PostController())->payPiutang($piutang->id, $piutang->total, $piutang->total, $akun_id, $rugi, $untung, $rugi, 0, 0,  $paket_pemasukan->id);
						if(is_string($pay_piutang)){
							return back()
							->with('message', $pay_piutang)
							->with('title', 'Gagal')
							->with('status', 'Error');
						}
					// } else
					// {
					// 	$piutang->pernah_ditolak = 1;
					// 	$piutang->paket_penagihan_id = null;
					// }
					// $piutang->save();
				}
				$paket->total = $total;
				$paket->total_paid = $bayar;
				$paket->status = config('const.state_dibayar');
				$paket->paket_pemasukan_id = $paket_pemasukan->id;
				$paket->save();
			// }

			DB::connection('keuangan')->commit();
			DB::connection('kasus')->commit();
			$status = "success";
			$message = 'Paket Penagihan berhasil dibayar';
			$title = 'Berhasil!';
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			DB::connection('kasus')->rollback();
			$status = "error";
			$message = 'Paket Penagihan gagal ditagihkan. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
		}
			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	}

	public function addPiutang(Request $req)
	{
		try {
			DB::connection('keuangan')->beginTransaction();

			$now=Carbon::now();
			$paket = PaketPenagihan::find($req->penagihan_id);
			$total = app('App\Http\Controllers\Keuangan\Piutang\EditController')->preparePenagihan($paket, $req);
			foreach($req->piutang_id as $p)
			{
				$piutang = Piutang::find($p);
				$piutang->paket_penagihan_id = $req->penagihan_id;
				$piutang->tagihkan_at=$now;
				$piutang->save();
				$total += $piutang->total;
			}
			app('App\Http\Controllers\Keuangan\Penagihan\EditController')->addTotal($req->penagihan_id, $total);
			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Piutang berhasil ditambahkan';
			$title = 'Berhasil!';
			if($req->origin == "bpjs")
				return redirect('bpjs/piutang-asuransi')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			else
				return redirect('keuangan/piutang')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Piutang gagal ditambahkan';
			$title = 'Gagal!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		}
	}

	public function updateDetailBpjs(Request $req, $slug, $kategori_bpjs_id)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			$penagihan_bpjs_id = $req['penagihan_bpjs_id'];
			$penagihan_bpjs = PenagihanBPJS::find($penagihan_bpjs_id);
			app('App\Http\Controllers\Keuangan\Piutang\EditController')->updateDetailBpjs($penagihan_bpjs, $req);

			$penagihan_bpjs->total = $req->harga_total;
			$penagihan_bpjs->save();

			app('App\Http\Controllers\Keuangan\Penagihan\EditController')->calculatePenagihan($penagihan_bpjs->paket_penagihan_id);

			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Penagihan BPJS berhasil diupdate';
			$title = 'Berhasil!';
			return redirect('keuangan/penagihan/'.$slug)
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Penagihan BPJS gagal diupdate. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		}
	}

	public function kirimPenagihan(Request $req, $slug)
	{
		try {
			// dd($req->all(), 'lho cik');
			DB::connection('keuangan')->beginTransaction();
			$paket = PaketPenagihan::with('detail')->where('slug', $slug)->first();
			$paket = (new \App\Http\Controllers\Keuangan\Penagihan\EditController())->updateStatusBpjs($slug, config('const.state_ditagih'), ['detail','detail_bpjs', 'detail_bpjs.piutang_pivot_detail']);
			// pre($paket->toArray());
			$paket->detail()->whereNotIn('id', $req->piutang_id)->update([
				'paket_penagihan_id' => null
			]);
			$paket->total = $paket->load('detail')->detail->sum('total');
			$paket->save();
			// dd($paket);
			// dd($paket->load('detail'));
			
			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Penagihan berhasil dikirim';
			$title = 'Berhasil!';
			return redirect('keuangan/penagihan-siap')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Penagihan gagal dikirim. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		}
	}

	public function updateNomorSurat(Request $req, $slug)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			
			app('App\Http\Controllers\Keuangan\Penagihan\EditController')->updateNomor($slug, $req);

			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Penagihan BPJS berhasil dikirim';
			$title = 'Berhasil!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Penagihan BPJS gagal dikirim. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
			return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
		}
	}

	public function updateFPK(Request $req, $slug, $penagihan_bpjs_id)
	{
		try {
			DB::connection('keuangan')->beginTransaction();
			
			app('App\Http\Controllers\Keuangan\Penagihan\EditController')->updateFPK($penagihan_bpjs_id, $req->fpk);

			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Nomor FPK berhasil diupdate';
			$title = 'Berhasil!';
		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Nomor FPK gagal diupdate. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
		}
		return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	}

	public function tagihkanDetailBpjs(Request $req, $slug, $penagihan_bpjs_id)
	{
		try {
			DB::connection('keuangan')->beginTransaction();

			if(!isset($req->pivot_id))
				$req->pivot_id = [];

			if($req->method == "confirm")
				$paket_id = app('App\Http\Controllers\Keuangan\Penagihan\EditController')->confirmPenagihanBPJS($penagihan_bpjs_id, $req->pivot_id);
			else
				$paket_id = app('App\Http\Controllers\Keuangan\Penagihan\EditController')->updatePenagihanSiapBPJS($penagihan_bpjs_id, $req->pivot_id);

			app('App\Http\Controllers\Keuangan\Penagihan\EditController')->calculatePenagihan($paket_id);

			DB::connection('keuangan')->commit();
			$status = "success";
			$message = 'Penagihan BPJS berhasil diupdate';
			$title = 'Berhasil!';

		} catch (Exception $e) {
			DB::connection('keuangan')->rollback();
			$status = "error";
			$message = 'Penagihan BPJS gagal diupdate. Kesalahan Server. Hubungi Admin';
			$title = 'Gagal!';
		}
		return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);
	}
}