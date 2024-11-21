<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, Carbon\Carbon;
use App\Models\Kasus\BPJSSEP;
use GuzzleHttp\Client;

class PostController extends Controller
{
	public function delete(Request $request, $no_sep)
	{
		$data = [
			'request' => [
				't_sep' => [
					'noSep' => $no_sep,
					'user' => Auth::user()->name
				],
			],
		];

		if (config('app.bpjs_enable', false)) {
			$res['result'] =  app('App\Http\Controllers\BPJS\API\Sep\DeleteController')->delete($data);
			$res['bpjs_enable'] = true;
			$resp = json_decode($res['result']);
			if ($resp->metaData->code == 200) {
				app('App\Http\Controllers\BPJS\SEP\DeleteController')->delete($no_sep);
			}
		} else {
			$res['bpjs_enable'] = false;
			$res['result'] = 'Nomor SEP tidak dihapus - ' . ($no_sep + 1) . ' (Tidak terkoneksi BPJS)';
		}
		$res['data'] = $data;
		return $res;
	}

	public function create(Request $request)
	{
		$tgl_sep      = $this->tanggal(($request->tanggal_sep ?? ''));
		$tgl_rujukan  = $this->tanggal(($request->bpjs_tgl_rujukan ?? ''));
		$tgl_kejadian = $this->tanggal(($request->bpjs_tgl_kejadian ?? ''));

		$param = [
			'no_bpjs'             => $request->bpjs_nomor_kartu,
			'tgl_sep'             => $tgl_sep,
			'diag_awal'           => $request->bpjs_diag_awal,
			'jenis_pelayanan'     => $request->bpjs_jenis_pelayanan,
			'kelas_rawat'         => $request->bpjs_kelas_rawat,
			'pasien_id'           => $request->bpjs_pasien_id,
			'no_mr'               => $request->bpjs_no_mr,
			'asal_rujukan'        => $request->bpjs_asal_rujukan,
			'tgl_rujukan'         => $tgl_rujukan,
			'no_rujukan'          => $request->bpjs_no_rujukan,
			'ppk_rujukan'         => $request->bpjs_ppk_rujukan,
			'nama_ppk_rujukan'    => $request->nama_ppk_rujukan ?? $request->bpjs_nama_ppk_rujukan,
			'catatan'             => $request->bpjs_catatan,
			'poli_tujuan'         => $request->bpjs_poli_tujuan,
			'poli_eksekutif'      => $request->bpjs_poli_eksekutif,
			'cob'                 => $request->bpjs_cob,
			'katarak'             => $request->bpjs_katarak,
			'jaminan_lakalantas'  => $request->bpjs_jaminan_lakalantas,
			'penjamin'            => $request->bpjs_penjamin,
			'tgl_kejadian'        => $tgl_kejadian,
			'keterangan_penjamin' => $request->bpjs_keterangan_penjamin,
			'suplesi'             => $request->bpjs_suplesi,
			'no_sep_suplesi'      => $request->bpjs_no_sep_suplesi,
			'prov_laka'           => $request->bpjs_prov_laka,
			'kab_laka'            => $request->bpjs_kab_laka,
			'kc_laka'             => $request->bpjs_kc_laka,
			'no_skdp'             => $request->bpjs_skdp == "null" ? "-" : $request->bpjs_skdp,
			'kode_dpjp'           => $request->dpjp,
			'no_telp'             => auth()->user()->phone ?? '081262227177',
			'user'                => auth()->user()->name ?? 'SuperAdmin',
			'dinsos'              => $request->bpjs_informasi_dinsos != "null" ? $request->bpjs_informasi_dinsos : null,
			'no_sktm'             => $request->bpjs_informasi_no_sktm != "null" ? $request->bpjs_informasi_no_sktm : null,
			'prolanis_prb'        => $request->bpjs_informasi_prolanis_prb != "null" ? $request->bpjs_informasi_prolanis_prb : null,
			'tujuan_kunjungan'    => $request->bpjs_tujuan_kunjungan ?? null,
			'flag_procedure'      => $request->bpjs_flag_procedure ?? null,
			'poli_tujuan_nama'	  => $request->bpjs_poli_tujuan_nama ?? null,
		];
		// dd($param);
		if (config('medify.third-party.vclaim.on_v2')) {
			$request->merge([
				'tanggal_sep'       => $tgl_sep,
				'bpjs_tgl_rujukan'  => $tgl_rujukan,
				'bpjs_tgl_kejadian' => $tgl_kejadian,
			]);

			$data = app(\App\Http\Controllers\BPJS\SEP\CreateController::class)->setVclaimSep2($request);
			if (config('app.bpjs_enable', false)) {
				$res['result'] =  app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\CreateController::class)->createSep2($request);
				$resp = json_decode($res['result']);
				if ($resp->metaData->code == 200) {
					$param['poli_tujuan_nama'] = $resp->response->sep->poli;
					$param['kode_dpjp'] = $resp->response->sep->dpjp->kdDPJP ?? null;
					app(\App\Http\Controllers\BPJS\SEP\CreateController::class)->create($param, $resp->response->sep->noSep);
				}
			} else {
				$res['result'] = 'Nomor SEP tidak dibuat (Tidak terkoneksi BPJS)';
			}
			$res['data'] = $data;
			return $res;
		} else {

			$data = app(\App\Http\Controllers\BPJS\SEP\ReadController::class)->formatRequestCreateSEP($param);
			if (config('app.bpjs_enable', false)) {
				$res['result'] =  app('App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\CreateController')->create($data);
				$resp = json_decode($res['result']);

				if ($resp->metaData->code == 200) {
					app('App\Http\Controllers\BPJS\SEP\CreateController')->create($param, $resp->response->sep->noSep);
				}
			} else {
				$res['result'] = 'Nomor SEP tidak dibuat (Tidak terkoneksi BPJS)';
			}
			$res['data'] = $data;
			return $res;
		}
	}


	public function edit(Request $request, $no_sep)
	{
		// dd(json_encode($request->all()));
		$sep = BPJSSEP::where('no_sep', $no_sep)->orderBy('id', 'DESC')->first();
		$sep_same_rujuk = BPJSSEP::where("no_rujukan", $request->bpjs_no_rujukan)->orderBy('id', 'desc')->first();

		if (isset($sep_same_rujuk)) {
			$dpjp = $sep_same_rujuk->dpjp;
			$skdp = $sep_same_rujuk->skdp;
		} else {
			$dpjp = $request->dpjp;
			$skdp = $request->skdp ?? '-';
		}

		$tgl_sep = $this->tanggal(($request->tanggal_sep ?? ''));
		$tgl_kejadian = $this->tanggal(($request->bpjs_tgl_kejadian ?? ''));

		$param = [
			'no_sep'              => $no_sep,
			'no_kartu'            => $request->bpjs_nomor_kartu,
			'tgl_sep'             => $tgl_sep,
			'diag_awal'           => $request->bpjs_diag_awal,
			'jenis_pelayanan'     => $request->bpjs_jenis_pelayanan,
			'kelas_rawat'         => $request->bpjs_kelas_rawat,
			'pasien_id'           => $sep->pasien_id,
			'no_mr'               => $request->bpjs_no_mr,
			'asal_rujukan'        => $request->bpjs_asal_rujukan,
			'tgl_rujukan'         => $request->bpjs_tgl_rujukan,
			'no_rujukan'          => $request->bpjs_no_rujukan,
			'ppk_rujukan'         => $request->bpjs_ppk_rujukan,
			'nama_ppk_rujukan'    => $request->nama_ppk_rujukan ?? $sep->nama_ppk_rujukan,
			'catatan'             => $request->bpjs_catatan ?? $sep->catatan,
			'poli_tujuan'         => $request->bpjs_poli_tujuan ?? $sep->poli_tujuan,
			'poli_eksekutif'      => $request->bpjs_poli_eksekutif ?? $sep->poli_eksekutif,
			'cob'                 => $request->bpjs_cob ?? $sep->cob,
			'katarak'             => $request->bpjs_katarak ?? $sep->katarak,
			'jaminan_lakalantas'  => $request->bpjs_jaminan_lakalantas ?? $sep->jaminan_lakalantas,
			'penjamin'            => $request->bpjs_penjamin ?? $sep->penjamin_laka,
			'tgl_kejadian'        => $tgl_kejadian,
			'keterangan_penjamin' => $request->bpjs_keterangan_penjamin ?? $sep->keterangan_penjamin,
			'suplesi'             => $request->bpjs_suplesi ?? $sep->suplesi,
			'no_sep_suplesi'      => $request->bpjs_no_sep_suplesi ?? $sep->no_suplesi,
			'prov_laka'           => $request->bpjs_prov_laka ?? $sep->prov_laka,
			'kab_laka'            => $request->bpjs_kab_laka ?? $sep->kab_laka,
			'kc_laka'             => $request->bpjs_kc_laka ?? $sep->kc_laka,
			'no_skdp'             => $skdp,
			'kode_dpjp'           => $dpjp,
			'no_telp'             => auth()->user()->phone ?? '081262227177',
			'user'                => auth()->user()->name ?? 'SuperAdmin',
		];

		if (config('medify.third-party.vclaim.on_v2')) {
			// dd($request->all());
			$data = app(\App\Http\Controllers\BPJS\SEP\ReadController::class)->formatRequestEditSEPV2($request->merge($param));
			if (config('app.bpjs_enable', false)) {
				$res['result'] =  app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\EditController::class)->editSep2($data);
				$resp = json_decode($res['result']);
				if ($resp->metaData->code == 200) {
					app('App\Http\Controllers\BPJS\SEP\EditController')->edit($param);
				}
			} else {
				$res['result'] = 'Nomor SEP tidak dibuat - ' . ($no_sep + 1) . ' (Tidak terkoneksi BPJS)';
			}
			$res['data'] = $data;
			return $res;
		} else {
			$data = app('App\Http\Controllers\BPJS\SEP\ReadController')->formatRequestEditSEP($param);

			if (config('app.bpjs_enable', false)) {
				$res['result'] =  app('App\Http\Controllers\ThirdParty\BPJS\VClaim\SEP\EditController')->edit($data);
				$resp = json_decode($res['result']);
				if ($resp->metaData->code == 200) {
					app('App\Http\Controllers\BPJS\SEP\EditController')->edit($param);
				}
			} else {
				$res['result'] = 'Nomor SEP tidak dibuat - ' . ($no_sep + 1) . ' (Tidak terkoneksi BPJS)';
			}
			$res['data'] = $data;
			return $res;
		}
	}


	public function pulang(Request $request)
	{
		if (config('medify.third-party.vclaim.on_v2')) {
			$tgl = explode("-", $request->tgl);
			$sep = BPJSSEP::where('no_sep', $request->no_sep)->first();

			if (strlen($tgl[0]) >= 3) {
				$tgl = implode("-", $tgl);
			} else {
				$tgl = implode("-", array_reverse($tgl));
			}

			$data = [
				"request" => [
					"t_sep" => [
						"noSep" => $request->no_sep,
						"tglPulang" => $tgl,
						"user"		=> (Auth::user()->id ?? 0)
					]
				]
			];

			$res = app(\App\Http\Controllers\BPJS\API\Sep\PostController::class)->sepPulang($request->no_sep, $tgl);
			$res = json_decode($res);

			if ($res->metaData->code == 200) {
				$sep->tgl_pulang = $tgl;
				$sep->save();
				$status = 1;
				$message = "Data pasien BPJS KRS berhasil disimpan";
				$title = 'Berhasil!';
			} else {
				$status = -1;
				$message = $res->metaData->message;
				$title = 'Gagal!';
			}
		} else {
			$cons_id = config('app.bpjs_cons_id');
			$secret = config('app.bpjs_secret');
			$ppk = config('app.bpjs_ppk');
			$tgl = explode("-", $request->tgl);
			$sep = BPJSSEP::where('no_sep', $request->no_sep)->first();
			if (strlen($tgl[0]) >= 3) {
				$tgl = implode("-", $tgl);
			} else {
				$tgl = implode("-", array_reverse($tgl));
			}
			$data = [
				'medify_cons_id'		=> $cons_id,
				'bpjs_stage'			=> config('app.bpjs_stage'),
				'medify_secret' 		=> $secret,
				'no_sep' 				=> $request->no_sep,
				'tgl_pulang' 			=> $tgl,
				'user'					=> Auth::user()->id
			];
			$res = app('App\Http\Controllers\BPJS\API\Sep\EditController')->pulang($data);
			if ($res->metaData->code == 200) {
				$sep->tgl_pulang = $tgl;
				$sep->save();
				$status = 1;
				$message = "Data pasien BPJS KRS berhasil disimpan";
				$title = 'Berhasil!';
			} else {
				$status = -1;
				$message = $res->metaData->message;
				$title = 'Gagal!';
			}
		}


		return back()
			->with('message', $message)
			->with('title', $title)
			->with('status', $status);
	}

	private function tanggal($tanggal)
	{
		if ($tanggal != "") {
			$tgl = explode("-", $tanggal);
			if (strlen($tgl[0]) <= 2)
				$tanggal = implode("-", array_reverse($tgl));
		} else {
			$tanggal = Carbon::today()->toDateString();
		}

		return $tanggal;
	}

	public function putUpdateTanggalPulang(Request $request)
	{
		try {
			// "noSep": "{nosep}",
			// "statusPulang":"{1:Atas Persetujuan Dokter, 3:Atas Permintaan Sendiri, 4:Meninggal, 5:Lain-lain}",
			// "noSuratMeninggal":"{diisi jika statusPulang 4, selain itu kosong}",
			// "tglMeninggal":"{diisi jika statusPulang 4, selain itu kosong. format yyyy-MM-dd}",
			// "tglPulang":"{format yyyy-MM-dd}",
			// "noLPManual":"{diisi jika SEPnya adalah KLL}",
			// "user":"{user}"
			$data = [
				'request' => [
					't_sep' => [
						"noSep"			   => $request->no_sep, // "0301R0110121V000829",
						"statusPulang"     => $request->status_pulang, //"4",
						"noSuratMeninggal" => $request->no_surat_meninggal, //"325/K/KMT/X/2021",
						"tglMeninggal"     => $request->tanggal_meninggal, //"2021-02-10",
						"tglPulang"        => $request->tanggal_pulang, //"2021-02-14",
						"noLPManual"       => $request->no_kll, //"",
						"user"             => auth()->user()->name ?? 'SuperAdmin', //"coba"
					],
				],
			];

			$header_array = $this->getInitThirdPartyBPJS()->getHeader();

			$timestamp = $header_array['X-timestamp'];
			$client = new Client(['headers' => $header_array]);
			$url = $this->getInitThirdPartyBPJS()->getUrl() . '/SEP/2.0/updtglplg';

			$res = $client->request('PUT', $url, [
				'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
				\GuzzleHttp\RequestOptions::JSON => $data
			]);
			$rujukan = $res->getBody()->getContents();

			if (config('app.bpjs_decrypt', false)) {
				$rujukan_decoded = json_decode($rujukan);
				$rujukan_decoded->response = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\RequestController::class)->stringDecrypt($timestamp, $rujukan_decoded->response));
				return (json_encode($rujukan_decoded));
			} else {
				return $rujukan;
			}
		} catch (\Throwable $th) {
			return $this->bugsnag($th);
		}
	}
}
