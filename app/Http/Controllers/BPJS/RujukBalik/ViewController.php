<?php

namespace App\Http\Controllers\BPJS\RujukBalik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        return view('bpjs.rujuk-balik.index');
    }
    public function search()
    {
        return view('bpjs.rujuk-balik.search');
    }
    public function create()
    {
        return view('bpjs.rujuk-balik.create');
    }
    public function edit($id)
    {
        if(is_numeric($id)){
            $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\ReadController::class)->single($id,'detail');
        }else{
            $response = app(\App\Http\Controllers\BPJS\RujukBalik\ReadController::class)->singleFromApi($id);
            $response_data = json_decode($response);
            if($response_data->metaData->code == 200){
                $rujuk_balik = app(\App\Http\Controllers\BPJS\RujukBalik\EditController::class)->saveFromApi($response);
            }else{
                return back()
                    ->with('status',-1)
                    ->with('title','Gagal')
                    ->with('message',$response_data->metaData->message);
            }
        }
        
        return view('bpjs.rujuk-balik.edit',compact('rujuk_balik'));
    }
}
