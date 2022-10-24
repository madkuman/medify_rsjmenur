<?php

namespace App\Http\Controllers\Kasus\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\QueueArtisan;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Identitas;
use Carbon\Carbon;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatJalan\Transaksi as IRJTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatInap\TempatTidur;
use App\Models\Kasus\BPJSSEP;
use App\Models\Kasus\RujukLuar;
use App\Models\Hospital\MasterStatusPulang;
use Auth;
use DB;
use Bugsnag;

class PostController extends Controller
{
	public function tutupKasus($nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			//dd($kasus->tagihan);
			foreach($kasus->daftar_tagihan as $tagihan)
			{	
				if(empty($tagihan->checkout_at) && $tagihan->total_bill > 0){ 
					$status = -1;
					$message = 'Kasus gagal ditutup! Ada tagihan belum di checkout!';
					$title = 'Gagal!';

					return back()
					->with('active_nav','pengaturan')
					->with('message', $message)
					->with('title',$title)
					->with('status', '-1');
				}
			}
			$kasus->end_by = Auth::user()->id;
			$kasus->end_at = Carbon::now();
			$kasus->save();

			$status = 1;
			$message = 'Kasus berhasil ditutup!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'close','kasus',0);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return back()
			->with('active_nav','pengaturan')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			
		}

	}

    public function batalKRS($id)
    {

        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try{
            $kasus = Kasus::where('nomor_kasus',$id)->first();
            $kasus->krs_at = null;
            $kasus->krs_by = null;
            $kasus->krs_alasan = null;
            $kasus->krs_status = null;
            $kasus->krs_keterangan = null;
            $kasus->krs_bpjs = null;
            $kasus->save();

            $status = 1;
            $message = 'Pasien KRS berhasil dibatalkan!';
            $title = 'Berhasil!';


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
                ->with('active_nav','pengaturan')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();

        }

    }

    public function batalTutupKasus($id)
    {

        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try{
            $kasus = Kasus::where('nomor_kasus',$id)->first();
            $kasus->end_at = null;
            $kasus->end_by = null;
            $kasus->save();

            $status = 1;
            $message = 'Tutup kasus berhasil dibatalkan!';
            $title = 'Berhasil!';


            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
                ->with('active_nav','pengaturan')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();

        }

    }

	/* pindah ikut di app('App\Http\Controllers\Kasus\Kasus\EditController')->removeFromPrev($old_id);
	public function removePasienFromAnyTransaction($kasus_id)
	{
          //remove IGD

		$igd = IGDTransaksi::where('kasus_id',$kasus_id)->get();
		if (!empty($igd)) {
			foreach($igd as $item)
			{
				$item_igd = IGDTransaksi::find($item->id);
				$item_igd->waktu_keluar = Carbon::now();
				$item_igd->save();
			}
		}

          //delete transaksi
          //remove Rawatinap
          //hapus tempat tidur
		$rawatinap = RawatInapTransaksi::where('kasus_id',$kasus_id)->orderBy('id','desc')->first();
		if (!empty($rawatinap)) {
			$bed = TempatTidur::find($rawatinap->tempat_tidur_id);
			if(!empty($bed))
			{
				if (!empty($bed->booking_id)) {
					//dd($rawatinap->id);
					//dd($bed->booking_id);
					#orang kedua pindah
					if ($bed->booking_id == $rawatinap->id) {
						$bed->booking_id = NULL;
						$bed->save();
					} 
					elseif($bed->transaksi_id == $rawatinap->id) {
						#orang pertama pindah
						$bed->transaksi_id = $bed->booking_id;
						//add tagihan + pindah lokasi dan kelas
						$next_rawatinap = RawatInapTransaksi::find($bed->booking_id);
						$tagihan = app('App\Http\Controllers\RawatInap\Transaksi\PostController')->tambahTagihan($next_rawatinap->kasus_id);
						$lokasi = $bed->ruangan->bangsal->nama.' - '. $bed->ruangan->nama.' - '.$bed->nama;
						$kelas = $bed->ruangan->kelas;

						$gantikelas = app('App\Http\Controllers\RawatInap\Transaksi\PostController')->changeKasusKelas($next_rawatinap->kasus_id,$kelas);
						$gantilokasi = app('App\Http\Controllers\RawatInap\Transaksi\PostController')->changeKasusLokasi($next_rawatinap->kasus_id,$lokasi);

						$bed->booking_id = NULL;
						$bed->save();	
					}					
				}
				else {
					$bed->transaksi_id = NULL;
					$bed->save();
				}
			}
		}
		$rawatinap->waktu_keluar = Carbon::now();
		$rawatinap->save();

		return 1;
	}*/

	public function dataKRS($nomor_kasus, Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('rawatinap')->beginTransaction();
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('igd')->beginTransaction();
		DB::connection('gizi')->beginTransaction();
		DB::connection('kamaroperasi')->beginTransaction();
		DB::connection('lab_pk')->beginTransaction();
		DB::connection('lab_pa')->beginTransaction();
		DB::connection('radiology')->beginTransaction();
		DB::connection('farmasi')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		DB::connection('rekammedis')->beginTransaction();
		try{
			if(!$this->checkIfPermintaanRanapExist($nomor_kasus) && empty($request->from_scheduler))
			{
				$status = -1;
				$message = 'Pasien gagal di KRS-kan! Terdapat permintaan rawat inap yang belum terselesaikan';
				$title = 'Gagal!';
				return back()
				->with('active_nav','pengaturan')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}


			$dateArr = !empty($request->krs_at) ? explode("-", $request->krs_at) : [];
			if(count($dateArr)==3)
					$krs_at = Carbon::now()->setDate($dateArr[2], $dateArr[1], $dateArr[0])
								->toDateTimeString();
			else $krs_at = Carbon::now()->toDateTimeString();
			$kasus = Kasus::with('pembayaran.perusahaan.tipe')->where('nomor_kasus',$nomor_kasus)->first();
			$kasus->krs_alasan = $request->alasan_krs;
			$kasus->krs_status = $request->status_krs;
			$kasus->krs_keterangan = $request->krs_keterangan;
			$kasus->krs_at = $krs_at;
			$kasus->krs_by = !empty($request->krs_by) ? $request->krs_by : Auth::user()->id;

			if($kasus->pembayaran && $kasus->pembayaran->perusahaan->tipe->slug == 'bpjs'){
				if($kasus->sep_id != 0 && empty($kasus->sep_id)){
					$res_krs_bpjs = app('App\Http\Controllers\BPJS\API\Sep\PostController')->sepPulang($kasus->active_sep->no_sep, $krs_at);
					if($res_krs_bpjs->metaData->code == 200)
						$kasus->krs_bpjs = 1;
				}
			}

			$kasus->save();
			
			app('App\Console\Commands\Kasus\Update\LOS')->updateKasus($kasus);
			app('App\Console\Commands\Kasus\Update\LamaPerawatan')->updateLamaPerawatan($kasus);

			if(!empty($request->gizi))
			{	
				app('App\Http\Controllers\Gizi\Pemesanan\DeleteController')->deleteFromKrs($kasus->id,$kasus->krs_at);//gizi
			}
			if(!empty($request->rawatinap))
			{
				app('App\Http\Controllers\RawatInap\Transaksi\EditController')->editKasus($kasus->id);//rawat inap	
			}
			if(!empty($request->operasi))
			{
				app('App\Http\Controllers\KamarOperasi\Transaksi\DeleteController')->kasus($kasus->id,$kasus->krs_at);//operasi	
			}
			if(!empty($request->labpa))
			{
				app('App\Http\Controllers\LabPA\Transaction\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//lab pa
			}
			if(!empty($request->labpk))
			{
				app('App\Http\Controllers\LabPK\Transaksi\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//lab pk
			}
			if(!empty($request->radiologi))
			{
				app('App\Http\Controllers\Radiology\Transaction\DeleteController')->cancelKrs($kasus->id,$request->alasan_krs);//radiologi	
			}
			if(!empty($request->farmasi))
			{
				app('App\Http\Controllers\Farmasi\Transaksi\DeleteController')->cancelKrs($kasus->id);//farmasi
			}

			//unsubscribe tindakan
			$tindakan = app('App\Http\Controllers\Kasus\Tindakan\EditController')->massUnsubscribe($kasus->id);
			$kembalikan_file_rm = $this->kembalikanFile($kasus);

			$status = 1;
			$message = 'Pasien berhasil di KRS-kan!';
			$title = 'Berhasil!';

			$old_id = $kasus->transaksi_masuk_detail_id;

			$remove = app('App\Http\Controllers\Kasus\Kasus\EditController')
			->removeKasusPrevTransaksi($kasus->id);

			//update pasien meninggal

			$krs_status = MasterStatusPulang::find($request->status_krs);
			if ($krs_status->slug == 'meninggal') {
				$death_at = Carbon::createFromFormat('d-m-Y H:i', $request->death_date.' '.$request->death_time, 'Asia/Jakarta');
				$pasien = app('App\Http\Controllers\Pasien\Pasien\EditController')->updatePasienMeninggal($kasus->pasien_id,$death_at);
			}

			//update tirah baring end
			$identitas = Identitas::where('kasus_id',$kasus->id)->first();
			$identitas->tanggal_tirah_baring_end = $krs_at;
			$identitas->save();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'create','krs',$kasus->id);

			// ? running queue update krs to sirs 
			if (config('medify.third-party.sirs_v3.on') && !empty($kasus->covid_status)) {
				$artisan_data['--kasus_id'] = $kasus->id;
				dispatch(new QueueArtisan('third-party-sirs-v3:laporan-covid-19-update', $artisan_data));
			}

			DB::connection('kasus')->commit();
			DB::connection('rawatinap')->commit();
			DB::connection('rawatjalan')->commit();
			DB::connection('igd')->commit();
			DB::connection('gizi')->commit();
			DB::connection('kamaroperasi')->commit();
			DB::connection('lab_pk')->commit();
			DB::connection('lab_pa')->commit();
			DB::connection('radiology')->commit();
			DB::connection('farmasi')->commit();
			DB::connection('mysql')->commit();
			DB::connection('rekammedis')->commit();

			if (empty($request->from_scheduler)) {
				return back()
				->with('active_nav','pengaturan')
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			} else {
				return $status;
			}
			
			

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('rawatinap')->rollback();
			DB::connection('rawatjalan')->rollback();
			DB::connection('igd')->rollback();
			DB::connection('gizi')->rollback();
			DB::connection('kamaroperasi')->rollback();
			DB::connection('lab_pk')->rollback();
			DB::connection('lab_pa')->rollback();
			DB::connection('radiology')->rollback();
			DB::connection('farmasi')->rollback();
			DB::connection('mysql')->rollback();
			DB::connection('rekammedis')->rollback();
			
		}

	}

	public function checkIfPermintaanRanapExist($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$kasus_id = $kasus->id;

		$rawatinap = RawatInapTransaksi::where('kasus_id',$kasus_id)->where('status',0)->where('is_pindah',0)->get();
		if(count($rawatinap) > 0) 
			return 0;
		else 
			return 1;
	}

	private function kembalikanFile($kasus)
	{
		$data['pasien_id'] = $kasus->pasien_id;
		$data['status'] = 1;
		$data['holder_keterangan'] = '';
        $data['holder_type'] = 2; //grup
        $data['holder_user_id'] = null;
        $rm_group = app('App\Http\Controllers\Group\Group\ReadController')->getRMGroupSlug('rekam-medis');
        $data['holder_group_id'] = $rm_group->id;

        $data['lokasi'] = $kasus->lokasi->lokasi->nama;
        $data['tujuan_id'] = 1;
        $data['jenis'] = 2;

        $data['sender_confirmed_at'] = Carbon::now();
        $data['sender_confirmed_by'] = Auth::user()->id;
        $data['sender_keterangan'] = '';

        $rm_transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
	}
}
