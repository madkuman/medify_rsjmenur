<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LoketAntrian;

class ReadController extends Controller
{
    public function getAll()
    {
        return LoketAntrian::all();
    }
}
