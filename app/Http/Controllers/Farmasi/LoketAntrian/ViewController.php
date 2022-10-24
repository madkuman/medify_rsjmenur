<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index(Request $request, $farmasi)
    {
        try {
            $farm = session('farmasi');

            $data['farmasi'] = $farm;
            $data['loket_antrian'] = app('App\Http\Controllers\Farmasi\LoketAntrian\ReadController')->getAll();
            $data['sidebar_active'] = "";

            return view('farmasi.screen.pengaturan.loket-antrian.index',$data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
