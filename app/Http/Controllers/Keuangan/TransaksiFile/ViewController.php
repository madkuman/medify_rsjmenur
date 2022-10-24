<?php

namespace App\Http\Controllers\Keuangan\TransaksiFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TransaksiFileLokasi;
use App\Models\Keuangan\TransaksiFileUtang;
use App\Models\Keuangan\Utang;

class ViewController extends Controller
{
    public function index(Request $request)
    {
    	$data['sidebar_active'] = "utang";
    	$data['lokasi'] = TransaksiFileLokasi::all();
        $data['lokasi_req'] = (!empty($request->lokasi)) ? $request->lokasi : 'UKPBJ';
    	return view('keuangan.transaksi-file.index',$data);
    }

    public function kirimBaru(Request $request)
    {
    	$data['sidebar_active'] = "utang";
    	$data['lokasi'] = TransaksiFileLokasi::all();
    	$data['lokasi_asal'] = (!empty($request->lokasi_asal)) ? $request->lokasi_asal : 'UKPBJ';
    	if (!empty($request->file_id)) $data['file_id'] = $request->file_id;
        if (!empty($request->lokasi_asal)) $data['lokasi_asal_req'] = $request->lokasi_asal;
    	return view('keuangan.transaksi-file.send',$data);
    }

    public function single($utang_id)
    {
    	$data['sidebar_active'] = "utang";
    	$data['file'] = Utang::find($utang_id);
    	$data['transaksi'] = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->where('utang_id', $utang_id)->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get();
    	return view('keuangan.transaksi-file.single',$data);
    }
}
