<?php

namespace App\Http\Controllers\Admin\HakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterHakAkses;
use App\Models\Hospital\HakAksesUsers;
use App\User;

class ViewController extends Controller
{
    public function index()
    {   
        $users = User::all();

        $data['user_all'] = $users;
        $data['master_hak_akses'] = MasterHakAkses::all();

        return view('admin.hak-akses.index', $data);
    }

}
