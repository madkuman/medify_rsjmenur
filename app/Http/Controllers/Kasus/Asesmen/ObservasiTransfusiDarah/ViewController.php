<?php

namespace App\Http\Controllers\Kasus\Asesmen\ObservasiTransfusiDarah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Hospital\Profesi;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use App\User;
use DOMPDF;

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with('pasien')->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'alat';

        $observasi_transfusi_darah = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Observasi Transfusi Darah')->get();
        $item_template = ItemsTemplate::all();
        $data['observasi_transfusi_darah'] = $observasi_transfusi_darah;
        $data['item_template'] = $item_template;

        $perawat = Profesi::where('slug', 'perawat')->first();
        $data['perawat'] = User::where('profesi', $perawat->id)->get();

        return view("kasus.asesmen.observasi-transfusi-darah.index", $data);
    }

    public function print($nomor_kasus, $id)
    {
        $kasus = Kasus::with('pasien')->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;

        $transfusi_darah = AlatBantu::with(['creator'])->where('kasus_id', $kasus->id)->where('type', 'Observasi Transfusi Darah')->where('id', $id)->first();
        $data['transfusi_darah'] = $transfusi_darah;

        $pdf = DOMPDF::loadView("kasus.asesmen.observasi-transfusi-darah.print", $data)->setPaper('a4', 'portrait');
        return $pdf->stream("observasi-transfusi-darah.pdf");
    }
}
