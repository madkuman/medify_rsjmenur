<?php

namespace App\Http\Controllers\Kasus\Psikologi\Galeri;

use App\Http\Controllers\Controller;
use App\Models\Kasus\PsikologiGaleri;
use Illuminate\Http\Request;;

class ReadController extends Controller
{
    public function getAllByKasus($kasus_id)
    {
        $galeri = PsikologiGaleri::where('kasus_id',$kasus_id)->get();
        return $galeri;
    }
}
