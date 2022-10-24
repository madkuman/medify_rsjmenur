<?php

namespace App\Http\Controllers\Functions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AudioCombine extends Controller
{
    public function makeAudio($path_file, $name_file_new, $audio_array)
    {
        if(!file_exists(public_path($path_file.$name_file_new))) {
            file_put_contents(public_path($path_file.$name_file_new), $audio_array);
        }
    }
}
