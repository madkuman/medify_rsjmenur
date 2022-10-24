<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ResumePulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Kasus\AlatBantu;
use DOMPDF;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $resume_pulang = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        ->where('type', 'Resume Pulang')->orderBy('id','desc')->get();
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokterDanPerawat();

        $data['resume_pulang'] = $resume_pulang;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.resume-pulang.index', $data);
    }

    public function print($nomor_kasus, Request $request)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $resume_pulang = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('id',$request->id)->where('type', 'Resume Pulang')->orderBy('id','desc')->first();
        $resume_pulang->val = json_decode($resume_pulang->val);
        $data['resume_pulang'] = $resume_pulang;
        $data['sidebar_active'] = 'alat';
        $data['keluarga'] = $request->keluarga;
        $data['now'] = Carbon::now()->toDateString();
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getSingle($request->ttd2);


        $pdf = DOMPDF::loadView('kasus.alatbantu.resume-pulang.print',$data);
        return $pdf->stream('print.pdf');
    }
}