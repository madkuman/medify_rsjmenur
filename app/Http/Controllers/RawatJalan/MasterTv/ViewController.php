<?php

namespace App\Http\Controllers\RawatJalan\MasterTv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\AntrianLevel;
use App\Models\RawatJalan\MasterTv;

class ViewController extends Controller
{
    public function listScreen()
    {
        $data['screens'] = MasterTv::all();
        $data['level'] = AntrianLevel::all();
        $data['ruangan'] = app('App\Http\Controllers\RawatJalan\Ruangan\ReadController')->getAll();
        $data['routeFlag'] = 1;
        return view('rawatjalan.antrian.screen.screen-list', $data);
    }

    public function screenView($slug)
    {
        $master = MasterTv::where('slug', $slug)->first();
        $data['master_tv_id'] = $master->id;
        $ruangans = json_decode($master->ruangan_nama);
        $ruangan_nama = [];
        $data['ruangan_id'] = json_decode($master->ruangan);
        $max = 1;
        foreach ($ruangans as $value) {
            if ($max <= 12) array_push($ruangan_nama, $value); $max++;
        }
        
        $data['ruangan'] = $ruangan_nama;
        return view('rawatjalan.antrian.screen.index', $data);
    }
}
