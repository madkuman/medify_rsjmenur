<?php

namespace App\Http\Controllers\Remunerasi\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Pajak;
use App\Models\Kepegawaian\Pegawai;


class ViewController extends Controller
{
    // PAGE
	public function index() {

        $data['pegawai'] = self::totalPegawai();
        $data['pajak'] = self::pajakAktif();
        $data['sidebar_active'] = 'dashboard';
    
        return view('remunerasi.dashboard.index', $data);
    }

    function totalPegawai(){
        $count = Pegawai::count();
        return $count;
    }

    function pajakAktif(){
        $pajak = Pajak::orderBy('created_at', 'DESC')->first();
        return $pajak->jumlah;
    }

}