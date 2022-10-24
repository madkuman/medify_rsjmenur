<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Surveilans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Carbon\Carbon;
use Session;


define('relasi', []);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $pasien_id = $kasus->pasien_id;
        $kasus_ids = Kasus::where('pasien_id',$pasien_id)->where('id','!=',$kasus->id)->pluck('id')->toArray();
        $max_day = Carbon::now()->endOfDay()->subDays(91);
        $preHistori = AlatBantu::with(['creator'])->whereIn('kasus_id',$kasus_ids)
                ->whereIn('type', ['Surveilans Infeksi Luka Pre Ops'])->where('created_at','>',$max_day)->orderBy('id','desc')->get();

        $pre = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
        		->whereIn('type', ['Surveilans Infeksi Luka Pre Ops'])->orderBy('id','desc')->get();
        $durante = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->whereIn('type', ['Surveilans Infeksi Luka Durante Ops'])->orderBy('id','desc')->get();
        $post = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->whereIn('type', ['Surveilans Infeksi Luka Post Ops'])->orderBy('id','desc')->get();
        $audit = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)
                ->whereIn('type', ['ido-audit'])->orderBy('id','desc')->get();
        $data['pre'] = $pre;
        $data['preHistori'] = $preHistori;
        $data['post'] = $post;
        $data['durante'] = $durante;
        $data['ido_audit'] = $audit;
        $data['sidebar_active'] = 'alat';
        $data['is_ipcn'] = Session('is_ipcn');

        return view('kasus.alatbantu.surveilans.index', $data);
    }
}
