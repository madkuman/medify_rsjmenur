<?php

namespace App\Http\Controllers\ThirdParty\SIRS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SyncController extends Controller
{
    // ? bridging sirs v3
    public function auth()
    {
        $sirs_id = config('app.sirs_id');
        $sirs_pass = config('app.sirs_pass');
        
    }
}
