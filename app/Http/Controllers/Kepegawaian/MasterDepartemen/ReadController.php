<?php

namespace App\Http\Controllers\Kepegawaian\MasterDepartemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterDepartemen;

class ReadController extends Controller
{
    public function getAllDepartemen()
    {
        $departemen = MasterDepartemen::all();
        return $departemen;
    }


    // public function checkDataJenisJabatan($jenis_jabatan_id)
    // {
	// 	$jabatan = MasterJa::where('jenis_jabatan_id', $jenis_jabatan_id)->count();
    //     if($jabatan > 0) return false; //if exist
    //     else return true; //if not exist
    // }
}
