<?php

namespace App\Http\Controllers\Esakip\Verifikasi;

use App\Models\Hospital\Grup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = 'verifikasi';
        $data['admin'] = app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserAdminInGroup(Grup::where('slug','e-sakip')->first()->id,Auth::user()->id);
        return view('esakip.verifikasi.index',$data);
    }
}
