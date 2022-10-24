<?php

namespace App\Http\Controllers\BPJS\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        try {
            $spesialis = app(\App\Http\Controllers\BPJS\Referensi\Spesialistik\PostController::class)->list();
            $spesialis = json_decode($spesialis);

            if ($spesialis->metaData->code == 200) {
                $spesialis = $spesialis->response->list;
            } else {
                $spesialis = [];
            }

            $propinsi = app(\App\Http\Controllers\BPJS\API\Referensi\ReadController::class)->getPropinsi(new Request());
            $propinsi = json_decode($propinsi);

            if ($propinsi->metaData->code == 200) {
                $propinsi = $propinsi->response->list;
            } else {
                $propinsi = [];
            }
            

            $data['sepsialis'] = $spesialis;
            $data['propinsi'] = $propinsi;
            return view('bpjs.referensi.index', $data);
        } catch (\Exception $e) {
            $this->bugsnag($e);
        }        
    }
}
