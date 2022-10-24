<?php

namespace App\Http\Controllers\Keuangan\TTD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TTD;

class ReadController extends Controller
{
    public function get()
    {
        $ttd = TTD::all();
        return $ttd;
    }
}
