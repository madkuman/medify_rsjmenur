<?php

namespace App\Http\Controllers\Urikkes\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Layanan;

class ReadController extends Controller
{
    public function getAllLayanan()
    {
    	return Layanan::orderBy('nama', 'ASC')->paginate(10);
    }
}
