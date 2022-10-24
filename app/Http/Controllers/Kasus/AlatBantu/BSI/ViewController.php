<?php

namespace App\Http\Controllers\Kasus\AlatBantu\BSI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Session;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['sidebar_active'] = 'alatbantu';
		$data['master_bsi'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','master-bsi')->with('children.creator')->orderBy('id','desc')->get();

		$data['is_ipcn'] = Session('is_ipcn');
		$data['bsi_audit'] = AlatBantu::with(['creator'])->where('kasus_id',$kasus->id)->where('type','bsi-audit')->orderBy('id','desc')->get();

		return view('kasus.alatbantu.bsi.index',$data);
	}
}
