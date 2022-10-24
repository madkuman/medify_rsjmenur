<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ScreenAntrian;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($data)
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $data->nama_scr);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase

        $screen = new ScreenAntrian();
        $screen->nama = $data->nama_scr;
        $screen->jenis_antrian = json_encode($data->jenis_antrian);
        $screen->jenis_resep = json_encode($data->jenis_resep);
        $screen->slug = $slug;
        $screen->created_by = Auth::user()->id;
        $screen->save();
    }
}
