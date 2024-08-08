<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;

class CreateController extends Controller
{
    public function create($dataArr, $no_sep)
    {
        $sep = BPJSSEP::where('no_sep', $no_sep)->first();
        $data = (object) $dataArr;
        if (empty($sep->id)) {
            $sep = new BPJSSEP;
        }

        $sep->no_sep              = $no_sep;
        $sep->no_bpjs             = $data->no_bpjs ?? null;
        $sep->tgl_sep             = $data->tgl_sep ?? null;
        $sep->diagnosa_awal       = $data->diag_awal ?? null;
        $sep->jenis_pelayanan     = $data->jenis_pelayanan ?? null;
        $sep->kelas_rawat         = $data->kelas_rawat ?? null;
        $sep->pasien_id           = $data->pasien_id ?? null;
        $sep->no_rm               = $data->no_mr ?? null;
        $sep->asal_rujukan        = $data->asal_rujukan ?? null;
        $sep->tgl_rujukan         = $data->tgl_rujukan ?? null;
        $sep->no_rujukan          = $data->no_rujukan ?? null;
        $sep->ppk_rujukan         = $data->ppk_rujukan ?? null;
        $sep->nama_ppk_rujukan    = $data->nama_ppk_rujukan ?? null;
        $sep->catatan             = $data->catatan ?? null;
        $sep->poli_tujuan         = $data->poli_tujuan ?? null;
        $sep->poli_tujuan_nama    = $data->poli_tujuan_nama ?? null;
        $sep->poli_eksekutif      = $data->poli_eksekutif ?? null;
        $sep->cob                 = $data->cob ?? null;
        $sep->katarak             = $data->katarak ?? null;
        $sep->jaminan_lakalantas  = $data->jaminan_lakalantas ?? null;
        $sep->penjamin_laka       = $data->penjamin ?? null;
        $sep->tgl_kejadian        = $data->tgl_kejadian ?? null;
        $sep->keterangan_penjamin = $data->keterangan_penjamin ?? null;
        $sep->suplesi             = $data->suplesi ?? null;
        $sep->no_suplesi          = $data->no_sep_suplesi ?? null;
        $sep->prov_laka           = $data->prov_laka ?? null;
        $sep->kab_laka            = $data->kab_laka ?? null;
        $sep->kc_laka             = $data->kc_laka ?? null;
        $sep->skdp                = $data->no_skdp ?? null;
        $sep->dpjp                = $data->kode_dpjp ?? null;
        $sep->no_telp             = $data->no_telp ?? null;
        $sep->created_by          = $data->user ?? null;
        $sep->total_plafon        = $data->total_plafon ?? null;
        $sep->dinsos              = $data->dinsos ?? null;
        $sep->no_sktm             = $data->no_sktm ?? null;
        $sep->prolanis_prb        = $data->prolanis_prb ?? null;
        $sep->tujuan_kunjungan    = $data->tujuan_kunjungan ?? null;
        $sep->flag_procedure      = $data->flag_procedure ?? null;
        $sep->save();
        // dd($sep);
        return $sep;
    }

    public function setVclaimSep2(Request $request)
    {
        if ($request->bpjs_jenis_pelayanan == 2)
            $poli = $request->bpjs_poli_tujuan;
        else
            $poli = "";

        $noKartu         = (string) $request->bpjs_nomor_kartu;
        $tglSep          = (string) $request->tanggal_sep;
        $jnsPelayanan    = (string) $request->bpjs_jenis_pelayanan;
        $klsRawatHak     = (string) $request->bpjs_pasien_kelas_bpjs;
        $klsRawatNaik    = (string) $request->bpjs_kelas_rawat; #tambahan
        $pembiayaan      = (string) $request->bpjs_pembiayaan; #tambahan diisi jika naik kelas
        $penanggungJawab = (string) $request->bpjs_penanggung_jawab; #tambahan diisi jika naik kelas
        $noMR            = (string) $request->bpjs_no_mr;
        $asalRujukan     = (string) $request->bpjs_asal_rujukan;
        $tglRujukan      = (string) $request->bpjs_tgl_rujukan;
        $noRujukan       = (string) ($request->bpjs_no_rujukan == '-') ? "" : $request->bpjs_no_rujukan;
        $catatan         = (string) $request->bpjs_catatan;
        $diagAwal        = (string) $request->bpjs_diag_awal;
        $tujuan          = (string) $poli;
        $eksekutif       = (string) ($request->bpjs_poli_eksekutif ?? null);
        $cob             = (string) ($request->bpjs_cob ?? null);
        $katarak         = (string) ($request->bpjs_katarak ?? null);
        $noSurat         = (string) (in_array($request->bpjs_skdp, ['-', "null"])) ? "" : $request->bpjs_skdp;
        $kodeDPJP        = (string) $request->dpjp;
        $lakaLantas      = (string) ($request->bpjs_jaminan_lakalantas ?? null);
        $tglKejadian     = (string) ($request->bpjs_tgl_kejadian ?? null);
        $keterangan      = (string) ($request->bpjs_keterangan_penjamin == 0 ? "" : $request->bpjs_keterangan_penjamin);
        $suplesi         = (string) ($request->bpjs_suplesi ?? null);
        $noSepSuplesi    = (string) ($request->bpjs_no_sep_suplesi == 0 ? "" : $request->bpjs_no_sep_suplesi);
        $kdPropinsi      = (string) ($request->bpjs_prov_laka == 0 ? "" : $request->bpjs_prov_laka);
        $kdKabupaten     = (string) ($request->bpjs_kab_laka == 0 ? "" : $request->bpjs_kab_laka);
        $kdKecamatan     = (string) ($request->bpjs_kc_laka == 0 ? "" : $request->bpjs_kc_laka);
        $tujuanKunj      = (string) ($request->bpjs_tujuan_kunjungan ?? 0); #tambahan
        $flagProcedure   = (string) ($request->bpjs_flag_procedure ?? null); #tambahan diisi "" jika tujuanKunj = "0",
        $kdPenunjang     = (string) ($request->bpjs_kode_penunjang ?? null); #tambahan  diisi "" jika tujuanKunj = "0",
        $assesmentPel    = (string) ($request->bpjs_asesment_pelayanan ?? null); #diisi jika tujuanKunj = "2" atau "0" (politujuan beda dengan poli rujukan dan hari beda)
        $dpjpLayan       = (string) ($request->bpjs_jenis_pelayanan == '1' ? "" : $kodeDPJP); #tambahan (tidak diisi jika jnsPelayanan = "1" (RANAP)
        $ppkRujukan      = (string) $request->bpjs_ppk_rujukan;
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
        if (empty($lakaLantas)) {
            $tglKejadian = '';
        }
        $param   =
            [
                "request" => [
                    "t_sep" => [
                        "noKartu"      => $noKartu,
                        "tglSep"       => $tglSep, //"2021-07-30",
                        "ppkPelayanan" => config('app.bpjs_ppk'), //"0301R011",
                        "jnsPelayanan" => $jnsPelayanan,
                        "klsRawat" => [
                            "klsRawatHak"     => $klsRawatHak, //"2",
                            "klsRawatNaik"    => $klsRawatNaik, //"1",
                            "pembiayaan"      => $pembiayaan, //"1",
                            "penanggungJawab" => $penanggungJawab, // "Pribadi"
                        ],
                        "noMR" => $noMR, //"MR9835",
                        "rujukan" => [
                            "asalRujukan" => $asalRujukan, //"2",
                            "tglRujukan"  => $tglRujukan, //"2021-07-23",
                            "noRujukan"   => $noRujukan, //"RJKMR9835001",
                            "ppkRujukan"  => $ppkRujukan, //"0301R011"
                        ],
                        "catatan" => $catatan, //"testinsert RI",
                        "diagAwal" => $diagAwal, //"E10",
                        "poli" => [
                            "tujuan" => $tujuan, //"",
                            "eksekutif" => $eksekutif, //"0"
                        ],
                        "cob" => [
                            "cob" => $cob, //"0"
                        ],
                        "katarak" => [
                            "katarak" => $katarak, //"0"
                        ],
                        "jaminan" => [
                            "lakaLantas" => $lakaLantas, // "0",
                            "noLP" => $lakaLantas, //"{No. LP}",
                            "penjamin" => [
                                "tglKejadian" => $tglKejadian, // "",
                                "keterangan"  => $keterangan, // "",
                                "suplesi" => [
                                    "suplesi"      => $suplesi, // "0",
                                    "noSepSuplesi" => $noSepSuplesi, // "",
                                    "lokasiLaka" => [
                                        "kdPropinsi"  => $kdPropinsi, // "",
                                        "kdKabupaten" => $kdKabupaten, // "",
                                        "kdKecamatan" => $kdKecamatan, // ""
                                    ]
                                ]
                            ]
                        ],
                        "tujuanKunj"    => $tujuanKunj, // "0",
                        "flagProcedure" => $flagProcedure, // "",
                        "kdPenunjang"   => $kdPenunjang, // "",
                        "assesmentPel"  => $assesmentPel, // "",
                        "skdp" => [
                            "noSurat"  => $noSurat, //"0301R0110721K000021", jika 
                            "kodeDPJP" => $kodeDPJP, //"31574"
                        ],
                        "dpjpLayan" => $dpjpLayan, // "",
                        "noTelp"    => auth()->user()->phone ?? "081111111101", //"081111111101",
                        "user"      => auth()->user()->name ?? "SuperAdmin"
                    ]
                ]
            ];
        // dd($request->all(), $param);
        return $param;
    }

    public function setVclaimSep2VersiAPI(Request $request)
    {
        $param   =
            [
                "request" => [
                    "t_sep" => [
                        "noKartu"      => $request['request']['t_sep']['noKartu'], //""
                        "tglSep"       => $request['request']['t_sep']['tglSep'], //"2021-07-30",
                        "ppkPelayanan" => config('app.bpjs_ppk'), //"0301R011",
                        "jnsPelayanan" => $request['request']['t_sep']['jnsPelayanan'],
                        "klsRawat" => [
                            "klsRawatHak"     => $request['request']['t_sep']['klsRawat']['klsRawatHak'], //"2",
                            "klsRawatNaik"    => $request['request']['t_sep']['klsRawat']['klsRawatNaik'], //"1",
                            "pembiayaan"      => $request['request']['t_sep']['klsRawat']['pembiayaan'], //"1",
                            "penanggungJawab" => $request['request']['t_sep']['klsRawat']['penanggungJawab'], // "Pribadi"
                        ],
                        "noMR" => $request['request']['t_sep']['noMR'], //"MR9835",
                        "rujukan" => [
                            "asalRujukan" => $request['request']['t_sep']['rujukan']['asalRujukan'], //"2",
                            "tglRujukan"  => $request['request']['t_sep']['rujukan']['tglRujukan'], //"2021-07-23",
                            "noRujukan"   => $request['request']['t_sep']['rujukan']['noRujukan'], //"RJKMR9835001",
                            "ppkRujukan"  => $request['request']['t_sep']['rujukan']['ppkRujukan'], //"0301R011"
                        ],
                        "catatan"  => $request['request']['t_sep']['catatan'], //"testinsert RI",
                        "diagAwal" => $request['request']['t_sep']['diagAwal'], //"E10",
                        "poli" => [
                            "tujuan" => $request['request']['t_sep']['poli']['tujuan'], //"",
                            "eksekutif" => $request['request']['t_sep']['poli']['eksekutif'], //"0"
                        ],
                        "cob" => [
                            "cob" => $request['request']['t_sep']['cob']['cob'], //"0"
                        ],
                        "katarak" => [
                            "katarak" => $request['request']['t_sep']['katarak']['katarak'], //"0"
                        ],
                        "jaminan" => [
                            "lakaLantas" => $request['request']['t_sep']['jaminan']['lakaLantas'], // "0",
                            "penjamin" => [
                                "tglKejadian" => $request['request']['t_sep']['jaminan']['penjamin']['tglKejadian'], // "",
                                "keterangan"  => $request['request']['t_sep']['jaminan']['penjamin']['keterangan'], // "",
                                "suplesi" => [
                                    "suplesi"      => $request['request']['t_sep']['jaminan']['penjamin']['suplesi']['suplesi'], // "0",
                                    "noSepSuplesi" => $request['request']['t_sep']['jaminan']['penjamin']['suplesi']['noSepSuplesi'], // "",
                                    "lokasiLaka" => [
                                        "kdPropinsi"  => $request['request']['t_sep']['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdPropinsi'], // "",
                                        "kdKabupaten" => $request['request']['t_sep']['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKabupaten'], // "",
                                        "kdKecamatan" => $request['request']['t_sep']['jaminan']['penjamin']['suplesi']['lokasiLaka']['kdKecamatan'], // ""
                                    ]
                                ]
                            ]
                        ],
                        "tujuanKunj"    => $request['request']['t_sep']['tujuanKunj'], // "0",
                        "flagProcedure" => $request['request']['t_sep']['flagProcedure'] ?? 0, // "",
                        "kdPenunjang"   => $request['request']['t_sep']['kdPenunjang'], // "",
                        "assesmentPel"  => $request['request']['t_sep']['assesmentPel'], // "",
                        "skdp" => [
                            "noSurat"  => $request['request']['t_sep']['skdp']['noSurat'], //"0301R0110721K000021", jika 
                            "kodeDPJP" => $request['request']['t_sep']['skdp']['kodeDPJP'], //"31574"
                        ],
                        "dpjpLayan" => $request['request']['t_sep']['dpjpLayan'], // "",
                        "noTelp"    => !empty($request['t_sep']['noTelp']) ? $request['request']['t_sep']['noTelp'] : (auth()->user()->phone ?? "081111111101"), //"081111111101",
                        "user"      => !empty($request['t_sep']['user']) ? $request['request']['t_sep']['user'] : (auth()->user()->name ?? "SuperAdmin")
                    ]
                ]
            ];
        // dd($param);
        return $param;
    }
}
