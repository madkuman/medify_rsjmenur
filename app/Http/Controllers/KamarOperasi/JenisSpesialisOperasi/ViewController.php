<?php

namespace App\Http\Controllers\KamarOperasi\JenisSpesialisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Bugsnag;

class ViewController extends Controller
{
    public function index()
    {
        try {
            $data['jenis_spesialis_operasi'] = app('App\Http\Controllers\KamarOperasi\JenisSpesialisOperasi\ReadController')->getAll();
            $data['sirs_spesialisasi_bedah'] = app('App\Http\Controllers\Admin\SirsSpesialisasiBedah\ReadController')->getAll(); 
            return view('kamaroperasi.jenis-spesialis-operasi.index',$data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
