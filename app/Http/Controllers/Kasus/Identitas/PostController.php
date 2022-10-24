<?php

namespace App\Http\Controllers\Kasus\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Identitas;
use App\Models\Pasien\PasienPembayaran;
use DB;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
	public function updatePembayaran(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
        	$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
			$pembayaran_utama_id = $request->pembayaran_utama_id;
			$pembayaran_tambahan = $request->pembayaran_tambahan;

			$edit = app('App\Http\Controllers\Kasus\Identitas\EditController')
			->updateMetodeBayar($nomor_kasus,$pembayaran_utama_id,$pembayaran_tambahan);

			foreach ($kasus->resep as $resep) {
				if($resep->transaksi_farmasi == null || ($resep->transaksi_farmasi->status == 0 && empty($resep->transaksi_farmasi->dikerjakan_at))){
					$resep->transaksi_farmasi->metode_pembayaran_id = $pembayaran_utama_id;
				}
			}
			
			$pasien_pembayaran = PasienPembayaran::find($pembayaran_utama_id);

			$slug = $pasien_pembayaran->perusahaan->tipe->slug ?? '';
			if($slug != 'bpjs') {
				$kasus->sep_id = null;
				$kasus->save();
			}
			else
			{
				$this->editSEPKasus($request,$nomor_kasus);
			}



			DB::connection('kasus')->commit();

			$status = 0;
			$message = 'Cara pembayaran berhasil di edit';
			$title = 'Gagal!';

            	$log = app('App\Http\Controllers\Kasus\Log\CreateController')
            	->create($kasus->id,'edit','identitas-pembayaran',null);

			return redirect('/kasus/'.$kasus->nomor_kasus.'/datamedis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);


		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();

			$status = 0;
			$message = 'Cara pembayaran gagal di edit';
			$title = 'Gagal!';
			return redirect('/kasus/'.$kasus->nomor_kasus.'/datamedis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
	}

	public function editSEPKasus(Request $request,$nomor_kasus)
	{
        $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		if(isset($request->sep)) {
			$sep = json_decode($request->sep);
			$nomor_sep = $sep->no_sep;
		}
		else {
			$nomor_sep = $request->custom_sep;
			$total_plafon = $request->total_plafon;
			$sep['no_bpjs'] = $kasus->pembayaran->no_asuransi;
			$sep['tgl_sep'] = Carbon::now()->format('Y-m-d');
			$sep['jenis_pelayanan'] = 2;
			$sep['no_rm'] = $kasus->pasien->no_rm;
			$sep['pasien_id'] = $kasus->pasien->id;
			$sep['created_by'] = Auth::user()->id;
			$sep['total_plafon'] = $total_plafon;
		}
		$current_no_sep = $kasus->active_sep->no_sep ?? '';
		if($nomor_sep != $current_no_sep)
		{
			$sep =  app('App\Http\Controllers\BPJS\SEP\CreateController')->create($sep,$nomor_sep);

			if(isset($kasus)){
				$kasus->bpjs()->attach($sep->id);
				$kasus->sep_id = $sep->id;
				$kasus->save();
			}

			$kasus_tagihan_id = $kasus->tagihan->id ?? null;
			if(!empty($kasus_tagihan_id)){
				$request['id'] = $kasus_tagihan_id;
				$sep =  app('App\Http\Controllers\Kasus\Tagihan\PostController')->syncSEP($request,$nomor_kasus);
			}
		}
		return $kasus;
	}

	public function updateKhusus(Request $req, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$identitas = Identitas::find($req->identitas_id);
			$this->checkToAbort($identitas);
			$kasus = Kasus::find($identitas->kasus_id);
			$identitas->cabut_gigi_salah = $req->cabut_gigi_salah ?? 0;
			$identitas->trauma_bur_gigi = $req->trauma_bur_gigi ?? 0;
			$identitas->save();
			
			DB::connection('kasus')->commit();

			$status = "success";
			$message = 'Informasi Khusus berhasil di edit';
			$title = 'Gagal!';

        	$log = app('App\Http\Controllers\Kasus\Log\CreateController')
            	->create($kasus->id,'edit','identitas-khusus',null);


		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();

			$status = "error";
			$message = 'Informasi Khusus gagal di edit';
			$title = 'Gagal!';
		}
		return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

	}
}