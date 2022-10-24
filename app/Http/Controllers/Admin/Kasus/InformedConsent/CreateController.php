<?php

namespace App\Http\Controllers\Admin\Kasus\InformedConsent;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InformedConsent;

class CreateController extends Controller
{
    public function create($data)
    {
    	$informed = new InformedConsent;
    	$informed->judul = $data['judul'];
    	$informed->jenis_informasi = $data['jenis_informasi'];
    	$informed->isi_informasi = $data['isi_informasi'];
    	$informed->created_by = Auth::id();
    	$informed->save();

    	return $informed;
    }
}
