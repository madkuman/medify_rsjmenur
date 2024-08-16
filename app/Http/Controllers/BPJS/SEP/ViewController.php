<?php

namespace App\Http\Controllers\BPJS\SEP;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\Pasien;
use App\Models\Kasus\RujukLuar;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
    public function search(Request $request)
    {
        $data['no_sep'] = isset($request->no_sep) ? $request->no_sep : "";
        $data['window'] = isset($request->window);
        return view('bpjs.sep.search.index', $data);
    }
    public function single()
    {
        return view('bpjs.sep.single.index');
    }

    public function print($no_sep, $param_download = [])
    {
        $bpjs = BPJSSEP::with('pasien', 'dokter.user.specialty_detail', 'poli')->where('no_sep', $no_sep)->first();
        $bpjs_real = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($no_sep));
        // $bpjs_real = json_decode('{"metaData":{"code":"200","message":"Sukses"},"response":{"noSep":"0404R0021221V000015","tglSep":"2021-12-21","jnsPelayanan":"Rawat Jalan","kelasRawat":"Kelas 3","diagnosa":"Mental and behavioural disorders due to use of cannabinoids, harmful use","noRujukan":"0487R0001121B000006","poli":"BEDAH","poliEksekutif":"0","catatan":"-","penjamin":null,"peserta":{"noKartu":"0002035874204","nama":"ANI AZKIA","tglLahir":"2005-06-27","noMr":"16","kelamin":"P","jnsPeserta":"PBI (APBD)","hakKelas":"Kelas 3","asuransi":null},"klsRawat":{"klsRawatHak":"3","klsRawatNaik":null,"pembiayaan":null,"penanggungJawab":null},"informasi":null,"kdStatusKecelakaan":"0","nmstatusKecelakaan":"Bukan Kecelakaan","dpjp":{"kdDPJP":"1967","nmDPJP":"dr.ROBERT ANTON PARULIAN, Sp.B"},"kontrol":{"noSurat":null,"kdDokter":null,"nmDokter":null},"lokasiKejadian":{"tglKejadian":null,"kdProp":null,"kdKab":null,"kdKec":null,"ketKejadian":null,"lokasi":null},"cob":"0","katarak":"0"}}');
        // dd($bpjs_real);
        $rujukan = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Rujukan\ReadController::class)->searchAll($bpjs->no_rujukan ?? null));
        if ($bpjs_real->metaData->code != 200) abort(404);
        else $bpjs_real = $bpjs_real->response;
        $sep_internal = app(\App\Http\Controllers\BPJS\API\Sep\ReadController::class)->getInternal($no_sep);

        $customPaper = array(0, 0, 602, 266);
        $data = [
            'bpjs'      => $bpjs,
            'bpjs_real' => $bpjs_real,
            'dokter'    => $bpjs->dokter ?? null,
            'rujukan'   => $rujukan ?? null,
            'sep_internal' => json_decode($sep_internal)->response->list[0] ?? [],
        ];
        // dd($data);
        // return view('kasus.bpjs.print', $data);
        $pdf = DOMPDF::loadView('kasus.bpjs.print', $data)->setPaper($customPaper);

        if (($param_download['is_download'] ?? null) != null) {
            $filename = $param_download['filename'] ?? 'Print_SEP.pdf';
            if (file_exists($param_download['path'] . $filename))
                unlink($param_download['path'] . $filename);
            $pdf->save($param_download['path'] . $filename);
            return $filename;
        }

        return $pdf->stream('print.pdf');
    }

    public function printSepBuktiLayanan($no_sep, $param_download = [])
    {
        $bpjs = BPJSSEP::with('pasien', 'dokter.user.specialty_detail', 'poli')->where('no_sep', $no_sep)->first();
        $bpjs_real = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($no_sep));

        $rujukan = json_decode(app(\App\Http\Controllers\ThirdParty\BPJS\VClaim\Rujukan\ReadController::class)->searchAll($bpjs->no_rujukan ?? null));
        if ($bpjs_real->metaData->code != 200) abort(404);
        else $bpjs_real = $bpjs_real->response ?? null;
        $sep_internal = app(\App\Http\Controllers\BPJS\API\Sep\ReadController::class)->getInternal($no_sep);

        $customPaper = array(0, 0, 602, 602);
        $data = [
            'bpjs'      => $bpjs,
            'bpjs_real' => $bpjs_real ?? null,
            'dokter'    => $bpjs->dokter ?? null,
            'rujukan'   => $rujukan ?? null,
            'sep_internal' => json_decode($sep_internal)->response->list[0] ?? [],
            'kasus'     => $bpjs->kasus,
        ];

        // return view('kasus.bpjs.print-sep-bukti-layanan', $data);
        $pdf = DOMPDF::loadView('kasus.bpjs.print-sep-bukti-layanan', $data)->setPaper($customPaper);

        if (($param_download['is_download'] ?? null) != null) {
            $filename = $param_download['filename'] ?? 'Print_SEP.pdf';
            if (file_exists($param_download['path'] . $filename))
                unlink($param_download['path'] . $filename);
            $pdf->save($param_download['path'] . $filename);
            return $filename;
        }

        return $pdf->stream('print.pdf');
    }

    public function printPotrait($no_sep)
    {
        $bpjs = BPJSSEP::where('no_sep', $no_sep)->first();
        $bpjs_real = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($no_sep));
        if ($bpjs_real->metaData->code != 200) abort(404);
        else $bpjs_real = $bpjs_real->response;

        $customPaper = array(0, 0, 266, 602);

        $data = [
            'bpjs' => $bpjs,
            'bpjs_real' => $bpjs_real,
        ];
        $pdf = DOMPDF::loadView('kasus.bpjs.print-potrait', $data)->setPaper($customPaper);
        return $pdf->stream('print.pdf');
    }

    public function printRangkap3($no_sep)
    {
        $bpjs = BPJSSEP::where('no_sep', $no_sep)->first();
        $bpjs_real = json_decode(app('App\Http\Controllers\BPJS\API\Sep\ReadController')->get($no_sep));
        if ($bpjs_real->metaData->code != 200) abort(404);
        else $bpjs_real = $bpjs_real->response;

        $customPaper = array(0, 0, 602, 266);

        $data = [
            'bpjs' => $bpjs,
            'bpjs_real' => $bpjs_real,
        ];
        $pdf = DOMPDF::loadView('kasus.bpjs.print-rangkap3', $data)->setPaper($customPaper);
        return $pdf->stream('print.pdf');
    }

    public function print2($no_sep)
    {
        $bpjs = BPJSSEP::where('no_sep', $no_sep)->first();
        if (empty($bpjs->no_sep)) abort(404);
        $pasien = Pasien::where('id', $bpjs->pasien_id)->first();
        $tanggal = Carbon::parse($bpjs->created_at)->format('d-m-Y');
        $tl = implode("-", array_reverse(explode('-', $pasien->date_of_birth)));
        $customPaper = array(0, 0, 470, 470);
        if (isset($bpjs->poli_tujuan) && $bpjs->poli_tujuan != "IGD") {
            $poli = app("App\Http\Controllers\RawatJalan\Poliklinik\ReadController")->getBPJS($bpjs->poli_tujuan);
        } else {
            $poli['name'] = "IGD";
            $poli = (object) $poli;
        }


        $pdf = DOMPDF::loadView('kasus.bpjs.print', [
            'bpjs' => $bpjs,
            'pasien' => $pasien,
            'tanggal' => $tanggal,
            'tl' => $tl,
            'poli' => $poli
        ])->setPaper($customPaper);
        return $pdf->stream('print.pdf');
    }

    public function edit(Request $request, $no_sep)
    {
        $data['poli'] = json_decode(app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoliBpjs())->data;
        $igd['bpjs_id'] = 'IGD';
        $igd['name'] = 'IGD';
        array_push($data['poli'], (object)$igd);
        $data['sep'] = json_decode(app('App\Http\Controllers\BPJS\SEP\ReadController')->getByNoSEP($no_sep));
        if (empty($data['sep']->no_sep)) abort(404);
        $data['window'] = isset($request->window);
        // dd($data);
        if (config('medify.third-party.vclaim.on_v2')) {
            return view('bpjs.sep.edit-v2.index', $data);
        } else {
            return view('bpjs.sep.edit.index', $data);
        }
    }

    public function create(Request $request)
    {
        $eager = [
            'pembayaran' => function ($query) use ($request) {
                $query->where('id', $request->pembayaran_id)
                    ->with('kelas')
                    ->first();
            }
        ];
        $pasien = app(\App\Http\Controllers\Pasien\Pasien\ReadController::class)->getSingle($request->pasien_id, $eager);

        $data['poli']   = json_decode(app('App\Http\Controllers\RawatJalan\Transaksi\ReadController')->getPoliBpjs())->data;
        $igd['bpjs_id'] = 'IGD';
        $igd['name']    = 'IGD';
        array_push($data['poli'], (object)$igd);
        $data['window']        = isset($request->window);
        $data['dpjp']          = app(\App\Http\Controllers\RawatJalan\DokterJadwal\ReadController::class)->getDokterBPJSRaw();
        $data['pasien_id']     = isset($request->pasien_id) ? $request->pasien_id        : -1;
        $data['pembayaran_id'] = isset($request->pembayaran_id) ? $request->pembayaran_id : -1;
        $data['pasien_name']   = isset($request->pasien_name) ? $request->pasien_name    : "";
        $data['rujukan']       = $request->rujukan;
        $data['is_inap']       = isset($request->is_inap) && $request->is_inap;
        $data['pasien']        = $pasien;
        // dd($data);
        if (config('medify.third-party.vclaim.on_v2')) {
            $data['pembiayaan'] = config('const.pembiayaan');
            return view('bpjs.sep.create-v2.index', $data);
        }
        return view('bpjs.sep.create.index', $data);
    }

    public function approve(Request $request)
    {
        return view('bpjs.approve-pengajuan.approve');
    }

    public function pengajuan(Request $request)
    {
        return view('bpjs.approve-pengajuan.pengajuan');
    }
}
