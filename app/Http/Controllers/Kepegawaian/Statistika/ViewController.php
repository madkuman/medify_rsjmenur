<?php

namespace App\Http\Controllers\Kepegawaian\Statistika;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ViewController extends Controller{


    public function index(){

        $htmlheader_title = 'Kepegawaian | Statistika';
        $contentheader_title = 'Statistika';

        $total_pegawai = app('App\Http\Controllers\Kepegawaian\Statistika\ReadController')->totalPegawai();
        $total_status  = app('App\Http\Controllers\Kepegawaian\Statistika\ReadController')->totalStatusPegawai();
        $total_jenis   = app('App\Http\Controllers\Kepegawaian\Statistika\ReadController')->totalJenisPegawai();

        return view('kepegawaian.statistika.index', compact(
            'htmlheader_title',
            'contentheader_title',
            'total_pegawai',
            'total_status',
            'total_jenis'
        ));
    }
    
}