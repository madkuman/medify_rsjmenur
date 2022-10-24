<?php

namespace App\Http\Controllers\KamarOperasi\JenisSpesialisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrepareController extends Controller
{
    public function prepareData($data)
    {
        $fields['nama'] = $data->nama;
        $fields['sirs_spesialisasi_bedah_id'] = $data->sirs_spesialisasi_bedah_id;
        return $fields;
    }
}
