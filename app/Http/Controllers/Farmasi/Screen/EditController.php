<?php

namespace App\Http\Controllers\Farmasi\Screen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ScreenAntrian;

class EditController extends Controller
{
    public function edit($data)
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $data->nama_scr);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);// transliterate
        $slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
        $slug = trim($slug, '-'); // trim
        $slug = preg_replace('~-+~', '-', $slug); // remove duplicate -
        $slug = strtolower($slug); // lowercase

        $screen = ScreenAntrian::find($data->id);
        $screen->nama = $data->nama_scr;
        $screen->jenis_antrian = json_encode($data->jenis_antrian);
        $screen->jenis_resep = json_encode($data->jenis_resep);
        $screen->slug = $slug;
        $screen->save();
    }
}
