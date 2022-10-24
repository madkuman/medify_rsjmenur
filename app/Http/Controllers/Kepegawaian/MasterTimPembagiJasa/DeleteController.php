<?php

namespace App\Http\Controllers\Kepegawaian\MasterTimPembagiJasa;

use App\Models\Kepegawaian\MasterMasaKerja;
use App\Models\Kepegawaian\MasterTimPembagiJasa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $tim_pembagi_jasa = MasterTimPembagiJasa::find($id);
        $tim_pembagi_jasa->delete();
    }
}
