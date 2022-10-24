<?php

namespace App\Http\Controllers\ThirdParty\MobileBPJS\Antrean;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\PoliklinikBpjs;
use App\Models\RawatJalan\Transaksi;
use DateTime;
use Validator;
use DB;
use Carbon\Carbon;


class PostController extends Controller
{
	protected $headers = [
		'username',
		'token'
	];

	public function __construct(Request $request)
	{
		$this->headers['token'] = $request->header('x-token');
		$this->headers['username'] = $request->header('x-username');
	}

	public function getStatusAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
							
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->errorAuth();
			}

			/** validator */
			$rules            =  [
				'kodepoli'       => 'required',
				'kodedokter'	 => 'required',
				'tanggalperiksa' => 'required|date_format:Y-m-d',
				'jampraktek'	 => 'required'
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
				'date_format'    => ':attribute format harus Y-m-d',
			];
			$validator = Validator::make($request->all(), $rules, $alert);

			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			$data = [
				'kodepoli' => $request->kodepoli,
				'kodedokter' => $request->kodedokter,
				'tanggalperiksa' => $request->tanggalperiksa,
				'jampraktek' => $request->jampraktek
			];

			$poliklinik = Poliklinik::where('bpjs_id', $data['kodepoli'])->first();
			if(empty($poliklinik)) {
				$message = 'kodepoli tidak sesuai';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$dokter = app('App\Http\Controllers\RawatJalan\Dokter\ReadController')->getDokterByKodeDokter($data['kodedokter']);
			if(empty($dokter)) {
				$message = 'kode dokter tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

            $tanggal = Carbon::parse($request->tanggalperiksa);
            $hari_poli_aktif = $poliklinik->jadwal->pluck('hari_order')->toArray();
            $tanggal_format = $tanggal->format('Ymd');
            if (tanggalMerah($tanggal_format)['status'] == true || in_array($tanggal->dayOfWeek, [0, 6]) || !in_array($tanggal->dayOfWeek, $hari_poli_aktif) || $tanggal < Carbon::today()) {
                $message = 'tanggal periksa tidak berlaku';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }

            $jam_praktek = explode("-", $data['jampraktek']);
            $jam['buka'] = $jam_praktek[0].":00";
            $jam['tutup'] = $jam_praktek[1].":00";

			$antrian = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')
						->getDataAntrian($jam['buka'], $jam['tutup'], $data['tanggalperiksa'], $poliklinik->id, $dokter->id);


			$response = [
				'namapoli' 	=> $poliklinik->name,
				'namadokter' => $dokter->name ?? '-',
				'totalantrean' => $antrian['antrian_all'],
				'sisaantrean' => $antrian['sisa_all_online'],
				'antreanpanggil' => $antrian['last_antrian'] ,
				'sisakuotajkn' => $antrian['sisa_jkn_online'],
				'kuotajkn' => $antrian['kuota_jkn_online'],
				'sisakuotanonjkn' => $antrian['sisa_all_online'] - $antrian['sisa_jkn_online'],
				'kuotanonjkn' => $antrian['kuota_all_online'] - $antrian['kuota_jkn_online'],
				'keterangan' => "",
			];

			$log = [
				'url'           => 'antrean/get-status-antrean',
				'jenis_request' => 'post',
				'param'         => json_encode($data),
				'response'      => json_encode($response),
				'created_by'    => $user_token->created_by,
			];
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);

		} catch (\Exception $e) {
			DB::connection('thirdp')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function getNoAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('igd')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
			/** cek token */
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->errorAuth();
			}
			/** end cek token */

			/** validator */
			$rules            =  [
				// 'nomorkartu'     => 'required|exists:patients.pasien_pembayaran,no_asuransi',
				'nik'            => 'required|min:5',
				// 'notelp'         => 'required|numeric',
				'tanggalperiksa' => 'required|date_format:Y-m-d',
				'kodepoli'       => 'required',
				'nomorreferensi' => 'required',
				'jenisreferensi' => 'required|in:1,2',
				'jenisrequest'   => 'required|in:1,2',
				'polieksekutif'  => 'required|in:0,1',
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
				'numeric'        => ':attribute format berupa nomor',
				'min'            => ':attribute minimal :min karakter',
				'date_format'    => ':attribute format harus Y-m-d',
				'in'			 => ':attribute tidak sesuai',
				'exists'		 => ':attribute tidak sesuai'
			];

			$validator = Validator::make($request->all(), $rules, $alert);

			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			/** validator tambahan */
			#jika eksekutif maka show eksekutif #poli
			$poli = Poliklinik::where('bpjs_id', $request->kodepoli)->first();
			if ($request->polieksekutif == 1) {
				$poli = Poliklinik::find(1);
			}
			// dd($poli->jadwal, $tanggal->day);
			if (empty($poli)) {
				$message = 'kodepoli tidak sesuai';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			#nomorreferensi
			$data_rujukan = ['no_rujukan' => $request->nomorreferensi];
			$request->merge($data_rujukan);
			$get_rujukan_bpjs = app('App\Http\Controllers\BPJS\API\Rujukan\ReadController')->getRujukanNomor($request);
			$get_rujukan_bpjs = json_decode($get_rujukan_bpjs);

			if (empty($get_rujukan_bpjs)) {
				$message = 'nomorreferensi tidak ditemukan di BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			// nomor hp
			// if ($get_rujukan_bpjs->peserta->mr->noTelepon != $request->notelp) {
			// 	$message = 'nomor telpon tidak sama dengan BPJS';
			// 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
			// 		->error(null, 201, $message);
			// }
			// nomor kartu
			if ($get_rujukan_bpjs->peserta->noKartu != $request->nomorkartu) {
				$message = 'nomorkartu tidak sesuai di BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// tanggal kunjungan
			$tgl_FKTP    = Carbon::parse($get_rujukan_bpjs->tglKunjungan);
			$tgl_periksa = Carbon::parse($request->tanggalperiksa);
			$interval    = date_diff($tgl_FKTP, $tgl_periksa)->days;

			#interval 90 hari FKTP
			if ($interval > 90) {
				$message = 'tanggalperiksa melebihi 90 hari dari tanggal FKTP';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// kode poli
			if ($get_rujukan_bpjs->poliRujukan->kode != $request->kodepoli) {
				$message = 'kodepoli tidak sesuai BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// nik
			if ($get_rujukan_bpjs->peserta->nik != $request->nik) {
				$message = 'nik tidak sesuai BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			#is holiday ? libur ora
			$tanggal = Carbon::parse($request->tanggalperiksa);
			$hari_poli_aktif = $poli->jadwal->pluck('hari_order')->toArray();
			$tanggal_format = $tanggal->format('Ymd');
			if (tanggalMerah($tanggal_format)['status'] == true || in_array($tanggal->dayOfWeek, [0, 6]) || !in_array($tanggal->dayOfWeek, $hari_poli_aktif)) {
				$message = $poli->name . ' sedang tutup';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			$data['nomorkartu']     = $request->nomorkartu; //nomor asuransi
			$data['nik']            = $request->nik; //nik pasien
			$data['notelp']         = $request->notelp;
			$data['tanggalperiksa'] = $request->tanggalperiksa;
			$data['kodepoli']       = $request->kodepoli;
			$data['nomorreferensi'] = $request->nomorreferensi; //NOMOR REFERENSI (NOMOR RUJUKAN / NOMOR KONTROL)
			$data['jenisreferensi'] = $request->jenisreferensi; //JENIS RFERENSI (NOMOR RUJUKAN [1] / NOMOR KONTROL [2])
			$data['jenisrequest']   = $request->jenisrequest; // JENIS REQUEST (PENDAFTARAN [1] / POLI [2])
			$data['polieksekutif']  = $request->polieksekutif; // POLI EKSEKUTIF (1=Poli Eksekutif, 0=Poli Reguler)

			/**
			 *  daftar pasien ke rajal + kasus 
			 * jenis pasien pake yang bpjs get nomor antrian
			 * cek pasien ada di db ? 
			 * gak ada, create pasien + pasien pembyaran 
			 */
			$pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')
				->getSingleByNik($request->nik);
			if (empty($pasien)) {
				$message = 'NIK tidak sesuai';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			$bayar_id = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($pasien->id)
				->where('no_asuransi', $request->nomorkartu)->first();
			$no_sep = null;
			// $no_sep = app('App\Http\Controllers\BPJS\AutoSEP\CreateController')
			// 	->generate('rawatjalan', $pasien->id, $bayar_id->id, $poli->id);
			// $no_sep = json_decode($no_sep);

			// if ($no_sep->status != 200) {
			// 	$message = $no_sep->message;
			// 	return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
			// 		->error(null, 201, $message);
			// }

			#cek transaksi rajal
			$is_exist = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->checkTransaksi($pasien->id, $request->tanggalperiksa, 3, $poli->id);
			if (!empty($is_exist)) {
				$message = 'Pasien Sudah pernah melakukan transaksi pada tanggal ' . $request->tanggalperiksa . ' di Poliklinik ' . $poli->name;
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$no_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->getLastAntrianNomorByDateKelas($poli->id, $request->tanggalperiksa, 3);
			$data_request['nomor_sep']         = $no_sep;
			$data_request['pasien_id']         = $pasien->id;
			$data_request['bayar_id']          = $bayar_id->id;
			$data_request['ruangan_id']        = 1;
			$data_request['kelas']             = 3;
			$data_request['kasus_id']          = 0;
			$data_request['asal_rujukan']      = null;
			$data_request['paket_urikkes']     = null;
			$data_request['confirmed']         = null;
			$data_request['rj_nomor_antrian']  = ($no_antrian + 1);
			$data_request['rj_kode_pasien']    = 5;
			$data_request['layanan']           = $request->kodepoli == 'IGD' ? 2 : 1;
			$data_request['retribusi']         = null;
			$data_request['poliklinik_id']	   = $poli->id;
			$data_request['rujuk_id']		   = null;
			$data_request['waktu_daftar']      = $request->tanggalperiksa;
			$data_request['keterangan_daftar'] = null;
			$data_request['created_by']        = $user_token->created_by;
			$request->merge($data_request);

			$pendaftaran = app('App\Http\Controllers\Pasien\Pasien\PostController')
				->APIPendaftaranPasien($request);
			$pendaftaran = json_decode($pendaftaran);

			if ($pendaftaran->type != 'success') {
				$message = $pendaftaran->text;
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$transaksi_id = $pendaftaran->transaksi_id;
			$transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->getSingleTransaksi($transaksi_id);

			if (empty($transaksi)) {
				$message = 'Transaksi Tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			/** hasil pendaftaran */
			$response['nomorantrean']     = $transaksi->nomor_antrian;
			$response['kodebooking']      = $transaksi->kasus->nomor_register ?? '-';
			$response['jenisantrean']     = 2;
			$response['estimasidilayani'] = strtotime(Carbon::parse($transaksi->ordered_at ?? now())->format('d-m-Y H:i')) . '000';
			$response['namapoli']         = $poli->name ?? '-';
			$response['namadokter']       = $transaksi->kasus->admin->user->dokter->bpjs_kode_dpjp ?? "-";

			$log = [
				'url'           => 'antrean/get-no-antrean',
				'jenis_request' => 'post',
				'param'         => json_encode($data),
				'response'      => json_encode($response),
				'created_by'    => $user_token->created_by,
			];
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();
			DB::connection('rawatjalan')->commit();
			DB::connection('igd')->commit();
			DB::connection('kasus')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);
		} catch (\Exception $e) {

			DB::connection('thirdp')->rollback();
			DB::connection('rawatjalan')->rollback();
			DB::connection('igd')->rollback();
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function getRekapNoAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
			/** cek token */
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->errorAuth();
			}
			/** end cek token */

			/** validator */
			$rules            =  [
				'tanggalperiksa' => 'required|date_format:Y-m-d',
				'kodepoli'       => 'required',
				'polieksekutif'	 => 'required|in:0,1'
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
				'numeric'        => ':attribute format berupa nomor',
				'min'            => ':attribute minimal :min karakter',
				'date_format'    => ':attribute format harus Y-m-d (ex : 2020-12-31)',
				'in'			 => ':attribute tidak sesuai',
			];

			$validator = Validator::make($request->all(), $rules, $alert);
			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			/**validpoli */
			$poli = Poliklinik::where('bpjs_id', $request->kodepoli)->first();
			/** jika eksekutif maka show eksekutif */
			if ($request->polieksekutif == 1) {
				$poli = Poliklinik::find(1);
			}

			if (empty($poli)) {
				$message = "Kode Poli tidak ditemukan";
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/**end valid poli */

			/** end validator */

			$data['tanggalperiksa'] = $request->tanggalperiksa;
			$data['kodepoli']       = $request->kodepoli;
			$data['polieksekutif']  = $request->polieksekutif; // POLI EKSEKUTIF (1=Poli Eksekutif, 0=Poli Reguler)



			$transaksi = Transaksi::where('created_at', 'like', '%' . $data['tanggalperiksa'] . '%')
				->where('poliklinik_id', $poli->id)
				->get();

			$jumlah_terlayani = 0;
			/** cek transaksi yg udh diisi cppt nya oleh dokter sm blm */
			if (!empty($transaksi)) {
				foreach ($transaksi as $key => $value) {
					/** jikta tidak punya cppt lanjut */
					if (empty($value->kasus->cppt)) {
						continue;
					}
					/** end tidak punya cppt */
					if (!empty($value->kasus->cppt_dokter)) {
						$jumlah_terlayani++;
					}
				}
			}
			/** end jumlah transaksi yang udah diisi */

			$response['namapoli']        = $poli->name ?? "";
			$response['totalantrean']    = $transaksi->count();
			$response['jumlahterlayani'] = $jumlah_terlayani;
			$response['lastupdated']     = $transaksi->sortByDesc('updated_at')->first()->updated_at->timestamp ?? "";

			$log['jenis_request'] = 'post';
			$log['url']			  = 'antrean/get-no-antrean-rekap';
			$log['param']         = json_encode($request->input());
			$log['response']      = json_encode($response);
			$log['created_by']    = $user_token->created_by;
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);
		} catch (\Exception $e) {
			DB::connection('thirdp')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function getSisaAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->errorAuth();
			}

			$data = [
				'kodebooking' => $request->kodebooking // kodebooking ini adalah id transaksi
			];

			/** validator */
			$rules            =  [
				'kodebooking' => 'required',
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
			];
			$validator = Validator::make($request->all(), $rules, $alert);

			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			// transaksi / antrian dengan id yang di request dari param
			$transaksi = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')->getTransaksiWithPoliDokter($data['kodebooking']);
			if(empty($transaksi)) {
				$message = 'Transaksi dengan kodebooking '.$data['kodebooking'].' tidak ditemukan hari ini';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$poli_id = $transaksi->poliklinik_id;
			// semua antrian hari ini status = 0
			$antrians = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')->getAntrian($poli_id);

			// antrian yang sudah masuk ke ruang pemeriksaan
			$antrian_terpanggil = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')->getAntrianTerpanggil($poli_id);

			$total_waktu = 0;
			$jam_sebelumnya = 0;
			$menit_sebelumnya = 0;
			$detik_sebelumnya = 0;
			foreach ($antrians as $key => $antrian) {
				$his = explode(' ', $antrian->ordered_at)[1]; // ambil jam saja
				$his_explode = explode(':', $his); // pisahkan jam, menit, dan detik
				$jam = $his_explode[0];
				$menit = $his_explode[1];
				$detik = $his_explode[2];

				// kalau antrian key pertama ga usah di hitung
				// karena belum ada waktu antar antrian
				if ($key != 0) {
					$total_jam = abs($jam_sebelumnya - $jam) * 3600;
					$total_menit = abs($menit_sebelumnya - $menit) * 60;
					$total_detik = abs($detik_sebelumnya - $detik);
					$total_waktu += $total_jam + $total_menit + $total_detik;
				}

				$jam_sebelumnya = $jam;
				$menit_sebelumnya = $menit;
				$detik_sebelumnya = $detik;
			}
			
			// total semua estimasi waktu antrian yang masih status 0 dijadikan detik
			$waktu_tunggu = $total_waktu;

			$response = [
				'nomorantrean' 	=> $transaksi->nomor_antrian, // nomor antrian user yang di request
				'namapoli' => $transaksi->poliklinik->name, // nama poli user yang di request
				'namadokter' => $transaksi->dokter->name, // nama dokter user yang di request
				'sisaantrean' => $antrians->count() ?? '-', // sisa antrian di poli yang user tuju
				'antreanpanggil' => $antrian_terpanggil->nomor_antrian ?? '-', // antrian terakhir yang udah masuk ke pemeriksaan
				'waktutunggu' => $waktu_tunggu, // total waktu (dalam detik) dari sisa antrian
				'keterangan' => ""
			];

			$log = [
				'url'           => 'antrean/sisa-antrean',
				'jenis_request' => 'post',
				'param'         => json_encode($data),
				'response'      => json_encode($response),
				'created_by'    => $user_token->created_by,
			];
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);

		} catch (\Exception $e) {
			DB::connection('thirdp')->rollback();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function batalAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')->errorAuth();
			}

			$data = [
				'kodebooking' => $request->kodebooking, // kodebooking ini adalah id transaksi
				'keterangan' => $request->keterangan
			];

			/** validator */
			$rules            =  [
				'kodebooking' => 'required',
				'keterangan' => 'required',
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
			];
			$validator = Validator::make($request->all(), $rules, $alert);

			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			// cek antrian hari ini
			$cekAntrian = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')->cekAntrian($data['kodebooking']);
			if(empty($cekAntrian)) {
				$message = 'Transaksi dengan kodebooking '.$data['kodebooking'].' tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$request->merge(['id' => $request->kodebooking]);
			$cancel = app('App\Http\Controllers\RawatJalan\Transaksi\PostController')->cancel($request);
			if ($cancel['status'] == -1) {
				$message = $cancel['message'];
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$response = [];
			$log = [
				'url'           => 'antrean/batal-antrean',
				'jenis_request' => 'post',
				'param'         => json_encode($data),
				'response'      => json_encode($response),
				'created_by'    => $user_token->created_by,
			];
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);

		} catch (\Exception $e) {
			DB::connection('thirdp')->rollback();

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}

	public function getAntrean(Request $request)
	{
		DB::connection('thirdp')->beginTransaction();
		DB::connection('rawatjalan')->beginTransaction();
		DB::connection('igd')->beginTransaction();
		DB::connection('kasus')->beginTransaction();
		try {
			app('debugbar')->disable();
			$user_token = app('App\Http\Controllers\ThirdParty\MobileBPJS\ReadController')->cekUserToken($this->headers);
			/** cek token */
			if (empty($user_token)) {
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->errorAuth();
			}
			/** end cek token */

			/** validator */
			$rules            =  [
				'nomorkartu'     => 'required',
				'nik'            => 'required|min:5',
				'tanggalperiksa' => 'required|date_format:Y-m-d',
				'kodepoli'       => 'required',
				'nomorreferensi' => 'required',
			];
			$alert            =  [
				'required'       => ':attribute harus diisi',
				'numeric'        => ':attribute format berupa nomor',
				'min'            => ':attribute minimal :min karakter',
				'date_format'    => ':attribute format harus Y-m-d',
				'in'			 => ':attribute tidak sesuai',
				'exists'		 => ':attribute tidak sesuai'
			];

			$validator = Validator::make($request->all(), $rules, $alert);

			if (!$validator->passes()) {
				$message = $validator->errors()->all();
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			/** end validator */

			/** validator tambahan */
			#jika eksekutif maka show eksekutif #poli
			$poli = Poliklinik::where('bpjs_id', $request->kodepoli)->first();
			if (empty($poli)) {
				$message = 'kodepoli tidak sesuai';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

            #dokter
			$dokter = app('App\Http\Controllers\RawatJalan\Dokter\ReadController')->getDokterByKodeDokter($request->kodedokter, $request->kodepoli);
			if(empty($dokter)) {
				$message = 'kode dokter tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

            #dokter jadwal
            $jam_praktek = explode("-",  $request->jampraktek);
            $jam['buka'] = $jam_praktek[0].":00";
            $jam['tutup'] = $jam_praktek[1].":00";
			$dokter_jadwal = app('App\Http\Controllers\RawatJalan\DokterJadwal\ReadController')->getByTanggalJam($dokter->id, $jam['buka'], $jam['tutup'], $request->tanggalperiksa);

            // dd($dokter_jadwal);
            if(empty($dokter_jadwal)) {
				$message = 'jadwal tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			#nomorreferensi
			$data_rujukan = ['no_rujukan' => $request->nomorreferensi];
			$request->merge($data_rujukan);
			$get_rujukan_bpjs = app('App\Http\Controllers\BPJS\API\Rujukan\ReadController')->getRujukanNomor($request);
			$get_rujukan_bpjs = json_decode($get_rujukan_bpjs);
			if (empty($get_rujukan_bpjs)) {
				$message = 'nomorreferensi tidak ditemukan di BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			// nomor kartu
			if ($get_rujukan_bpjs->peserta->noKartu != $request->nomorkartu) {
				$message = 'nomorkartu tidak sesuai di BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// tanggal kunjungan
			$tgl_FKTP    = Carbon::parse($get_rujukan_bpjs->tglKunjungan);
			$tgl_periksa = Carbon::parse($request->tanggalperiksa);
			$interval    = date_diff($tgl_FKTP, $tgl_periksa)->days;

			#interval 90 hari FKTP
			if ($interval > 90) {
				$message = 'tanggalperiksa melebihi 90 hari dari tanggal FKTP';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// kode poli
			if ($get_rujukan_bpjs->poliRujukan->kode != $request->kodepoli) {
				$message = 'kodepoli tidak sesuai BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			// nik
			if ($get_rujukan_bpjs->peserta->nik != $request->nik) {
				$message = 'nik tidak sesuai BPJS';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			#is holiday ? libur ora
			$tanggal = Carbon::parse($request->tanggalperiksa);
			$hari_poli_aktif = $poli->jadwal->pluck('hari_order')->toArray();
			$tanggal_format = $tanggal->format('Ymd');
			if (tanggalMerah($tanggal_format)['status'] == true || in_array($tanggal->dayOfWeek, [0, 6]) || !in_array($tanggal->dayOfWeek, $hari_poli_aktif)) {
				$message = $poli->name . ' sedang tutup';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			//cek melibihi jam tutup poli
            $tanggal = Carbon::parse($request->tanggalperiksa.' '.$jam['tutup']);
			if($tanggal < Carbon::now())
            {
                $message = $poli->name . ' sudah tutup';
                return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
                    ->error(null, 201, $message);
            }


			/**
			 * Cek pasien sudah ada atau belum berdasarkan nik
			 * kalau tidak ada response 202
			 */
			$pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingleByNik($request->nik);
			if (empty($pasien)) {
				$response = [];
				$message = 'Pasien dengan nik '.$request->nik.' belum terdaftar dirumah sakit. Silahkan daftarkan terlebih dahulu';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error($response, 202, $message);
			}
			/** end validator */

			$data['nomorkartu']     = $request->nomorkartu; //nomor asuransi
			$data['nik']            = $request->nik; //nik pasien
			$data['notelp']         = $request->notelp;
			$data['tanggalperiksa'] = $request->tanggalperiksa;
			$data['kodepoli']       = $request->kodepoli;
			$data['nomorreferensi'] = $request->nomorreferensi; //NOMOR REFERENSI (NOMOR RUJUKAN / NOMOR KONTROL)
			$data['kodedokter']		= $request->kodedokter;
			$data['jampraktek']		= $request->jampraktek;
			$data['jeniskunjungan']	= $request->jeniskunjungan;

			$bayar_id = app('App\Http\Controllers\Pasien\Pasien\ReadController')->metode($pasien->id)
				->where('no_asuransi', $request->nomorkartu)->first();
			$no_sep = null;

			#cek transaksi rajal
			$is_exist = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->checkTransaksi($pasien->id, $request->tanggalperiksa, 3, $poli->id);
			if (!empty($is_exist)) {
				$message = 'Pasien Sudah pernah melakukan transaksi pada tanggal ' . $request->tanggalperiksa . ' di Poliklinik ' . $poli->name;
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$no_antrian = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->getLastAntrianNomorByDateKelas($poli->id, $request->tanggalperiksa, 3);
			$data_request['nomor_sep']         = $no_sep;
			$data_request['pasien_id']         = $pasien->id;
			$data_request['bayar_id']          = $bayar_id->id;
			$data_request['ruangan_id']        = 1;
			$data_request['kelas']             = 3;
			$data_request['kasus_id']          = 0;
			$data_request['asal_rujukan']      = null;
			$data_request['paket_urikkes']     = null;
			$data_request['confirmed']         = 3;
			$data_request['rj_nomor_antrian']  = ($no_antrian + 1);
			$data_request['rj_kode_pasien']    = 5;
			$data_request['layanan']           = $request->kodepoli == 'IGD' ? 2 : 1;
			$data_request['retribusi']         = null;
			$data_request['poliklinik_id']	   = $poli->id;
			$data_request['rujuk_id']		   = null;
			$data_request['tanggal_pemesanan']      = $request->tanggalperiksa;
			$data_request['keterangan_daftar'] = null;
			$data_request['created_by']        = $user_token->created_by;
            $data_request['is_online']         = 1;
            $data_request['is_bpjs']           = 1;
            $data_request['dokter_jadwal_id']  = $dokter_jadwal->id;
            $data_request['dokter_id']         = $dokter->id;
			$request->merge($data_request);

			$pendaftaran = app('App\Http\Controllers\Pasien\Pasien\PostController')
				->APIPendaftaranPasien($request);
			$pendaftaran = json_decode($pendaftaran);

			if ($pendaftaran->type != 'success') {
				$message = $pendaftaran->text;
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}

			$transaksi_id = $pendaftaran->transaksi_id;
			$transaksi = app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')
				->getSingleTransaksi($transaksi_id);

			if (empty($transaksi)) {
				$message = 'Transaksi Tidak ditemukan';
				return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
					->error(null, 201, $message);
			}
			
			$transactions = app('App\Http\Controllers\ThirdParty\MobileBPJS\Antrean\ReadController')
						->getTransactionByJadwal($data, $poli->id, $dokter->id);
			$sisa_kuota_jkn = 0;
			$kuota_jkn = 0;
			$kuota_non_jkn = 0;
			$sisa_kuota_non_jkn = 0;
            $sisa_antrian = 0;
			foreach ($transactions as $trans) {
				if ($trans->status == 0) { // masih antri
					$sisa_antrian++;
				}
				$slug_pembayaran = $trans->pasien_pembayaran->perusahaan->tipe->slug ?? '';
				if ($slug_pembayaran == 'bpjs') { // kuota jkn/bpjs keseluruhan
					$kuota_jkn++;
					if (in_array($trans->status,[0,3])) { // sisa kuota jkn/bpjs yang masih antri
						$sisa_kuota_jkn++;
					}
				}
				if ($slug_pembayaran != 'bpjs') { // kuota non jkn/bpjs
					$kuota_non_jkn++;
					if (in_array($trans->status,[0,3])) { // sisa kuota non jkn/bpjs yang masih antri
						$sisa_kuota_non_jkn++;
					}
				}
			}
            // dd($transaksi->nomor_antrian);

			$angka_antrian = $transaksi->nomor_antrian;
			if ($angka_antrian) {
				$angka_antrian = (int) substr($angka_antrian,-3);
			}

			/** hasil pendaftaran */
			$response['nomorantrean']     = $transaksi->nomor_antrian;
			$response['angkaantrean']     = $angka_antrian;
			$response['kodebooking']      = $transaksi->id ?? '-';
			$response['pasienbaru']       = $pasien->is_baru == NULL ? 0 : $pasien->is_baru;
			$response['norm']      		  = $pasien->no_rm;
			$response['namapoli']         = $poli->name ?? '-';
			// $response['namadokter']       = $transaksi->kasus->admin->user->dokter->bpjs_kode_dpjp ?? "-";
			$response['namadokter']		  = $dokter->name;
			$response['estimasidilayani'] = strtotime(Carbon::parse($transaksi->ordered_at ?? now())->format('d-m-Y H:i')) . '000';
			$response['sisakuotajkn']	  = $sisa_kuota_jkn;
			$response['kuotajkn']	      = $kuota_jkn;
			$response['sisakuotanonjkn']  = $kuota_non_jkn;
			$response['kuotanonjkn']	  = $sisa_kuota_non_jkn;
			$response['keterangan']		  = "Peserta harap 60 menit lebih awal guna pencatatan administrasi";

			$log = [
				'url'           => 'antrean/get-antrean',
				'jenis_request' => 'post',
				'param'         => json_encode($data),
				'response'      => json_encode($response),
				'created_by'    => $user_token->created_by,
			];
			app('App\Http\Controllers\ThirdParty\MobileBPJS\CreateController')->createLog($log);
			DB::connection('thirdp')->commit();
			DB::connection('rawatjalan')->commit();
			DB::connection('igd')->commit();
			DB::connection('kasus')->commit();

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->success($response);
		} catch (\Exception $e) {

			DB::connection('thirdp')->rollback();
			DB::connection('rawatjalan')->rollback();
			DB::connection('igd')->rollback();
			DB::connection('kasus')->rollback();
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
				->error();
		}
	}
}