<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LoketAntrian;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($data)
    {
        $loket = new LoketAntrian();
        $loket->nama = $data->nama;
        $loket->sound = $data->sound_path ?? null;
        $loket->created_by = Auth::user()->id;
        $loket->save();
    }
}
