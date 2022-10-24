<?php

namespace App\Http\Controllers\RawatJalan\MasterTv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\MasterTv;

class ReadController extends Controller
{
    public function getMasterTvByRuangan($ruangan_id)
    {
    	$item = MasterTv::where('ruangan','like','%"'.$ruangan_id.'"%')->get();
        return $item;
    }
}
