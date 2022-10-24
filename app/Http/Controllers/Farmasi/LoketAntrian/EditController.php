<?php

namespace App\Http\Controllers\Farmasi\LoketAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LoketAntrian;

class EditController extends Controller
{
    public function edit($data)
    {
        $loket = LoketAntrian::find($data->id);
        $loket->nama = $data->nama;
        if(!empty($data->sound_path)){
            $loket->sound = $data->sound_path;
        }
        $loket->save();
    }
}
