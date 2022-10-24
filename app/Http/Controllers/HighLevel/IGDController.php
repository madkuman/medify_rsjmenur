<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class IGDController extends Controller
{
    public function index()
    {
        return view('highlevel.igd');
    }
}
