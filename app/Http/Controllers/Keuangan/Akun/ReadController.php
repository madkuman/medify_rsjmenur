<?php

namespace App\Http\Controllers\Keuangan\Akun;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Akun;

class ReadController extends Controller
{
    public function get()
    {
        $akun = Akun::all();
        return $akun;
    }
}
