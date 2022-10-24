<?php

namespace App\Http\Controllers\Kasus\Psikologi\Galeri;

use App\Http\Controllers\Controller;
use App\Models\Kasus\PsikologiGaleri;
use Illuminate\Http\Request;
use Auth;

class CreateController extends Controller
{
    public function create($req,$kasus_id)
    {
        $file_galeri = '';
        $file_galeri_thumb = '';
        if ($req->hasFile('file_galeri')) {
            $file = $req->file('file_galeri');
            $ext = $req->file('file_galeri')->extension();
            $image_ext = ["jpg", "png", "jpeg", "bmp", "svg", "webp"];
            $video_ext = ["mp4", "webm", "3gp"];
            $ext_document = ['pdf','csv','xml','xls','xlsx'];
            if(in_array($ext, $image_ext))    $file_type = "image";
            else if(in_array($ext, $video_ext))   $file_type = "video";
            else if(in_array($ext, $ext_document))   $file_type = "document";
            $image = app('App\Http\Controllers\Functions\ImageUploader')->upload($file,'psikologi');
            $file_galeri = $image['file_original'];
            $file_galeri_thumb = $image['file_thumbnail'] ?? '';
        }

        $galeri = new PsikologiGaleri;
        $galeri->kasus_id = $kasus_id;
        $galeri->file = $file_galeri;
        $galeri->file_thumb = $file_galeri_thumb;
        $galeri->file_type = $file_type ?? '';
        $galeri->judul = $req->judul;
        $galeri->created_by = Auth::user()->id;
        $galeri->save();
    }
}
