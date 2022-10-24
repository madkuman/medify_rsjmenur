<?php

namespace App\Http\Controllers\Kasus\Kolaborator;

use App\Models\Kasus\CPPT;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\Kasus;
use App\User;
use Carbon\Carbon;
use DOMPDF;

define('relasi', ['pembayaran.perusahaan', 'pasien', 'end_by_creator', 
    'TransaksiRawatInap']);


class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kolaborator'] = Kolaborator::with(['creator.profesi_detail', 'user.profesi_detail'])->where('kasus_id',$kasus->id)->where('invitation','!=','-1')->get();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'kolaborator';
        $log = app('App\Http\Controllers\Kasus\Log\CreateController')
        ->create($kasus->id,'view','kolaborator',null);
        return view('kasus.kolaborator.index',$data);
    }

    public function konsul($nomor_kasus,$user_id)
    {   
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['kolaborator'] = Kolaborator::where('user_id',$user_id)->where('kasus_id',$kasus->id)->with('creator')->first();
        $data['tanggal_lahir'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($kasus->pasien->date_of_birth,'%d %B %Y');
        $data['tanggal_sekarang'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat(Carbon::now(),'%d %B %Y');
        $data['user'] = User::find($user_id);
        $data['cppt'] = CPPT::where('kasus_id',$kasus->id)->where('created_by',$user_id)->whereNull('jenis')->first();
        $pdf = DOMPDF::loadView('kasus.kolaborator.print.print-konsul', $data);
        return $pdf->stream('Lembar_Konsultasi.pdf');
    }

    public function dpjp($nomor_kasus,$user_id)
    {   
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['user'] = User::find($user_id);
        if(!empty($kasus->mrs_at))
            $data['tanggal_masuk'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($kasus->mrs_at,'%d %B %Y');
        else
            $data['tanggal_masuk'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($kasus->created_at,'%d %B %Y');
        $data['tanggal_sekarang'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat(Carbon::now(),'%d %B %Y');
        $data['jam_sekarang'] = Carbon::now()->format('H:i');
        
        $pdf = DOMPDF::loadView('kasus.kolaborator.print.print-dpjp', $data);
        return $pdf->stream('Alih_DPJP.pdf');
    }
}
