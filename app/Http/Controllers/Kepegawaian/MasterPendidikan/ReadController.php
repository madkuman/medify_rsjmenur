<?php

namespace App\Http\Controllers\Kepegawaian\MasterPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterGelarPendidikan;
use App\Models\Kepegawaian\MasterStrataPendidikan;
use App\Models\Kepegawaian\MasterJenisPendidikan;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;
use App\Models\Kepegawaian\Berkas;

class ReadController extends Controller
{
    public function getAllGelar()
    {
        $gelar = MasterGelarPendidikan::all();
        return $gelar;
    }

    public function getAllStrata()
    {
        $strata = MasterStrataPendidikan::all();
        return $strata;
    }

    public function getAllJenisPendidikan()
    {
        $jenis = MasterJenisPendidikan::all();
        return $jenis;
    }

    public function getAllInstitusi()
    {
        $institusi = MasterIntitusiPendidikan::all();
        return $institusi;
    }

    // Jika Hapus Jenis Cek Strata
    public function checkDataStrata($id)
    {
		$strata = MasterStrataPendidikan::where('pendidikan_strata_id', $id)->count();
        if($strata > 0) return false; //if exist
        else return true; //if not exist
    }

    // Cek Jika Hapus Strata Cek Gelar
    public function checkDataGelar($id)
    {
		$gelar = MasterGelarPendidikan::where('pendidikan_gelar_id', $id)->count();
        if($gelar > 0) return false; //if exist
        else return true; //if not exist
    }

    public function getFile($emp, $id) {
		$thefile = Berkas::find($id);
		$extension = $thefile->extension;
		$filename = $id.'.'.$extension;
		$destination_path = public_path('/uploads/kepegawaian/pendidikan');
	
		if(file_exists($destination_path.'/'.$filename)) {
		    return response()->file($destination_path.'/'.$filename);
		}
		else {
            Alert::error('Sertifikat pendidikan tidak ditemukan', 'Gagal!');
            return redirect()->route('trainings', ['id' => $emp]);
		}
    }
}
