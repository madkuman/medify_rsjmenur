<?php

namespace App\Http\Controllers\Kepegawaian\MasterGelarPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterGelarPendidikan;

class ReadController extends Controller
{
    public function getDataAjax($id)
    {
        $gelar = MasterGelarPendidikan::find($id);
        return json_encode($gelar);
    }

    public function getAll()
    {
        $gelar = MasterGelarPendidikan::all();
        return$gelar;
    }
}
