<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
    public function getByNoSEP($no_sep)
    {
    	$sep = BPJSSEP::where('no_sep', $no_sep)
    		->with(['pasien.pembayaran.perusahaan', 'user_dpjp', 'poli', 'diagnosis'])
    		->orderBy('id', 'DESC')
    		->first();
    	return json_encode($sep);
    }

    public function getSepRujukanSama($no_rujukan)
    {
    	$sep = BPJSSEP::with('user_dpjp')->where('no_rujukan', $no_rujukan)->orderBy('id', 'DESC')->first();
    	return json_encode($sep);

    }

    public function getByNomorPasien($id_pasien)
    {
        $sep = BPJSSEP::with(['pasien','poli','dokter'])->where('pasien_id', $id_pasien)->orderBy('created_at','desc')->get();
        return json_encode($sep);
    }

	public function singleByNoSEP($no_sep, $eager = [])
	{
		return BPJSSEP::with($eager)
			->where('no_sep', $no_sep)->first();
	}

    public function formatRequestCreateSEP($dataArr)
	{
        $data = (object) $dataArr;
        
        if($data->jenis_pelayanan == 2)
			$poli = $data->poli_tujuan;
		else
			$poli = "0";
		
		$return = [
			'request' => [
				't_sep' => [
	    			'noKartu' => $data->no_bpjs,
	    			'tglSep' => $data->tgl_sep,
	    			'ppkPelayanan' => config('app.bpjs_ppk'),
	    			'jnsPelayanan' => (string) $data->jenis_pelayanan,
	    			'klsRawat' => (string) $data->kelas_rawat,
	    			'noMR' => (string) $data->no_mr,
	    			'rujukan' => [
						'asalRujukan' => (string) $data->asal_rujukan,
						'tglRujukan' => $data->tgl_rujukan,
						'noRujukan' => (string) $data->no_rujukan,
						'ppkRujukan' => (string) $data->ppk_rujukan,
					],
	    			'catatan' => $data->catatan,
	    			'diagAwal' => $data->diag_awal,
	    			'poli' => [
    					'tujuan' => $poli,
    					'eksekutif' => $data->poli_eksekutif,
					],
	    			'cob' => [
    					'cob' => $data->cob,
					],
	    			'katarak' => [
						'katarak' => $data->katarak,
					],
	    			'jaminan' => [
						'lakaLantas' => $data->jaminan_lakalantas,
						'penjamin' => [
							'penjamin' => $data->penjamin,
							'tglKejadian' => $data->tgl_kejadian,
							'keterangan' => $data->keterangan_penjamin,
							'suplesi' => [
								'suplesi' => $data->suplesi,
								'noSepSuplesi' => $data->no_sep_suplesi,
								'lokasiLaka' =>[
									'kdPropinsi' => $data->prov_laka,
									'kdKabupaten' => $data->kab_laka,
									'kdKecamatan' => $data->kc_laka,
								], 
							],
						],
					],
	    			'skdp' => [
    					'noSurat' => (string) $data->no_skdp,
    					'kodeDPJP' => (string) $data->kode_dpjp,
					],
	    			'noTelp' => auth()->user()->phone ?? "081111111101",
	    			'user' => auth()->user()->name ?? "SuperAdmin",
				]
			]
		];
		// dd($return);
		return $return;
	}

	public function formatRequestEditSEP($dataArr)
	{
		$data = (object) $dataArr;

		$return = [
			'request' => [
				't_sep' => [
					'noSep' => $data->no_sep,
					'klsRawat' => (string) $data->kelas_rawat,
					'noMR' => (string) $data->no_mr,
					'rujukan' => [
						'asalRujukan' => (string) $data->asal_rujukan,
						'tglRujukan' => $data->tgl_rujukan,
						'noRujukan' => (string) $data->no_rujukan,
						'ppkRujukan' => (string) $data->ppk_rujukan,
					],
					'catatan' => $data->catatan,
					'diagAwal' => $data->diag_awal,
					'poli' => [
						'tujuan' => $data->poli_tujuan,
						'eksekutif' => $data->poli_eksekutif,
					],
					'cob' => [
						'cob' => $data->cob,
					],
					'katarak' => [
						'katarak' => $data->katarak,
					],
					'skdp' => [
						'noSurat' => $data->no_skdp,
						'kodeDPJP' => $data->kode_dpjp,
					],
					'jaminan' => [
						'lakaLantas' => $data->jaminan_lakalantas,
						'penjamin' => [
							'penjamin' => $data->penjamin,
							'tglKejadian' => $data->tgl_kejadian,
							'keterangan' => $data->keterangan_penjamin,
							'suplesi' => [
								'suplesi' => $data->suplesi,
								'noSepSuplesi' => $data->no_sep_suplesi,
								'lokasiLaka' => [
									'kdPropinsi' => $data->prov_laka,
									'kdKabupaten' => $data->kab_laka,
									'kdKecamatan' => $data->kc_laka,
								],
							],
						],
					],
					'noTelp' => auth()->user()->phone,
					'user' => auth()->user()->name
				]
			]
		];

		return $return;
	}

	public function formatRequestEditSEPV2($dataArr)
	{

		$data = (object) $dataArr;	
		// dd($data);
		if ($data->jenis_pelayanan == 2)
		$poli = $data->poli_tujuan;
		else
		$poli = "0";

		$dpjpLayan       = (string) ($data->jenis_pelayanan == '1' ? "" : $data->dpjp); #tambahan (tidak diisi jika jnsPelayanan = "1" (RANAP)
		$klsRawatHak     = (string) $data->bpjs_pasien_kelas_bpjs;
		$klsRawatNaik    = (string) $data->bpjs_kelas_rawat; #tambahan
		$pembiayaan      = (string) $data->bpjs_pembiayaan; #tambahan diisi jika naik kelas
		$penanggungJawab = (string) $data->bpjs_penanggung_jawab; #tambahan diisi jika naik kelas
		$tgl_kejadian	 = "";

		if ($data->jaminan_lakalantas != 0) {
			$tgl_kejadian = $data->tgl_kejadian;
		}

		$list_naik_kelas = config('const.kelas_rawat_naik');
		$kls_rawat_naik = $list_naik_kelas[$klsRawatNaik];
		$is_naik_kelas = 0;
		if ($klsRawatHak > $kls_rawat_naik || in_array($kls_rawat_naik, ['VIP', 'VVIP'])) {
			$is_naik_kelas = 1;
		}

		if (!$is_naik_kelas) {
			$klsRawatNaik = "";
			$pembiayaan = "";
			$penanggungJawab = "";
		}

		$return = [
			'request' => [
				"t_sep" => [
					"noSep" => $data->no_sep, //"0301R0110521V000037",
					"klsRawat" => [
						"klsRawatHak"     => $klsRawatHak, //"2",
						"klsRawatNaik"    => $klsRawatNaik, //"1",
						"pembiayaan"      => $pembiayaan, //"1",
						"penanggungJawab" => $penanggungJawab, // "Pribadi"
					],
					"noMR" => $data->no_mr, //"00469120",
					"catatan" => $data->catatan, //"",
					"diagAwal" => $data->diag_awal, //"E10",
					"poli" => [
						'tujuan' => $poli,
						'eksekutif' => $data->poli_eksekutif,
					],
					"cob" => [
						// "cob"=> "0"
						'cob' => $data->cob,
					],
					"katarak" => [
						// "katarak"=> "0"
						'katarak' => $data->katarak,
					],
					"jaminan" => [
						'lakaLantas' => $data->jaminan_lakalantas, // "lakaLantas"=> "0",

						"penjamin" => [
							'tglKejadian' => $tgl_kejadian, //"tglKejadian"=> "",
							"keterangan" => $data->keterangan_penjamin == 0 ? "" : $data->keterangan_penjamin, //"",
							"suplesi" => [
								'suplesi' => $data->suplesi == 0 ? "0" : $data->suplesi, //"suplesi"=> "",
								'noSepSuplesi' => $data->no_sep_suplesi == 0 ? "" : $data->no_sep_suplesi, //"noSepSuplesi"=> "",
								"lokasiLaka" => [
									'kdPropinsi' => $data->prov_laka == 0 ? "" : $data->prov_laka,
									'kdKabupaten' => $data->kab_laka == 0 ? "" : $data->kab_laka,
									'kdKecamatan' => $data->kc_laka == 0 ? "" : $data->kc_laka,
								]
							]
						]
					],
					// "dpjpLayan" => "46", #dari dokumentasinya tidak ada informasi
					"dpjpLayan" => $dpjpLayan, #dari dokumentasinya tidak ada informasi
					'noTelp' => auth()->user()->phone ?? "081111111101",
					'user' => auth()->user()->name ?? "SuperAdmin",
				]
			]
		];
		// dd($return);
		return $return;
	}
}
