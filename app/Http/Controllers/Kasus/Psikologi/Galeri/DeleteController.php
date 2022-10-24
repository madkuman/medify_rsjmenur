<?php

namespace App\Http\Controllers\Kasus\Psikologi\Galeri;

use App\Http\Controllers\Controller;
use App\Models\Kasus\PsikologiGaleri;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete($req)
    {
        $galeri = PsikologiGaleri::find($req->id);
        $galeri->delete();
    }
}
