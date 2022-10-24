<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ISK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Auth;
use Session;


class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'alatbantu';
        $data['master_isks'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','master-isk')->with('children.creator')->orderBy('id','desc')->get();
        $data['is_ipcn'] = Session('is_ipcn');
        $data['isk_audit'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','isk-audit')->orderBy('id','desc')->get();

        return view('kasus.alatbantu.isk.index',$data);
    }
}
