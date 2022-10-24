<?php

namespace App\Http\Controllers\BPJS\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DOMPDF;

class ViewController extends Controller
{
    public function index($jenis)
    {
        $data['jenis'] = $jenis;
        $data['user'] = Auth::user();
        return view('bpjs.rencana-kontrol.index', $data);
    }

    public function create($jenis)
    {
        $data['user'] = Auth::user();
        $data['jenis'] = $jenis;
        return view('bpjs.rencana-kontrol.create.index', $data);
    }

    public function edit($jenis, $no_sk)
    {
        $rencana_kontrol = RencanaKontrol::where('no_sk', $no_sk)->first();

        // Try find through bpjs server
        if ($rencana_kontrol == null) {
            $response = app('App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController')->rencanaKontrolByNoSk($no_sk);
            $response_data = json_decode($response);

            if ($response_data->metaData->code == 200) {
                $rencana_kontrol = app(\App\Http\Controllers\BPJS\RencanaKontrol\EditController::class)->saveFromApi($response_data->response);
            }
        }

        checkToAbort($rencana_kontrol);

        $rencana_kontrol->tgl_rk = Carbon::parse($rencana_kontrol->tgl_rk);

        $user = Auth::user()->name;
        $jenis = $jenis;

        return view('bpjs.rencana-kontrol.edit.index', compact('rencana_kontrol', 'user', 'jenis'));
    }

    public function search(Request $request, $jenis)
    {
        $nomor_surat_kontrol = $request->nomor_surat_kontrol ?? '';

        $user = Auth::user();
        $jenis = $jenis;

        return view('bpjs.rencana-kontrol.search.index', compact('nomor_surat_kontrol', 'user', 'jenis'));
    }

    public function printSKSI(Request $request)
    {
        try {

            $no_sk = $request->no_sk;

            $rencana_kontrol = app(\App\Http\Controllers\BPJS\RencanaKontrol\ReadController::class)->getNoSk($no_sk, ['pasien', 'dokter', 'sep.diagnosis']);
            $rencana_kontrol_bpjs = app(\App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController::class)->rencanaKontrolByNoSk($no_sk);
            $rencana_kontrol_bpjs = json_decode($rencana_kontrol_bpjs ?? []);
            // dd($request->all(), $rencana_kontrol);
            $jenis_sk_si = 'SKDP';
            $judul = 'SURAT RENCANA KONTROL';
            $jenis_rencana = 'Rencana Kontrol';
            if ($rencana_kontrol->jenis_kontrol == 1) {
                $jenis_sk_si = 'SPRI';
                $judul = 'SURAT RENCANA INAP';
                $jenis_rencana = 'Rencana Inap';
            }

            $customPaper = array(0, 0, 602, 266);

            $data = [
                'rencana_kontrol'      => $rencana_kontrol,
                'jenis_sk_si'          => $jenis_sk_si,
                'judul'                => $judul,
                'jenis_rencana'        => $jenis_rencana,
                'rencana_kontrol_bpjs' => $rencana_kontrol_bpjs
            ];
            $view = 'kasus.bpjs.print-skdp';
            if ($jenis_sk_si == 'SPRI') {
                $view = 'kasus.bpjs.print-spri';
            }
            // dd($data);
            // return view('kasus.bpjs.print-skdp', $data);
            // return view('kasus.bpjs.print-spri', $data);
            $pdf = \DOMPDF::loadView($view, $data)->setPaper($customPaper);
            return $pdf->stream('Print - ' . $judul . '-' . date('d-m-Y') . '.pdf');
        } catch (\Throwable $th) {
            return $this->bugsnag($th);
        }
    }
}
