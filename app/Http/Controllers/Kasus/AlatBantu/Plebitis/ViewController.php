<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Plebitis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;


class ViewController extends Controller
{

    public function index($nomor_kasus)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'alatbantu';
		$data['master_plebitis'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','master-plebitis')->with('children.creator')->orderBy('id','desc')->get();

        return view('kasus.alatbantu.plebitis.index',$data);
    }
}
