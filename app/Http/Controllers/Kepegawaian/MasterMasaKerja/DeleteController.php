<?php

namespace App\Http\Controllers\Kepegawaian\MasterMasaKerja;

use App\Models\Kepegawaian\MasterMasaKerja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $masa_kerja = MasterMasaKerja::find($id);
        $masa_kerja->delete();
    }
}
