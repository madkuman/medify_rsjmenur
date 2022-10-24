<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisJabatan;
use App\Models\Kepegawaian\MasterJabatan;
use App\Models\Kepegawaian\MasterDepartemen;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;
use DB;

class ReadController extends Controller
{
    public function getAllJabatan()
    {
        $jabatan = MasterJabatan::with('jenis_jabatan', 'departemen')->get();
        return $jabatan;
    }

    public function getAllJenisJabatan()
    {
        $jenis_jabatan = MasterJenisJabatan::all();
        return $jenis_jabatan;
    }

    public function filterJabatan($jabatan_ids)
    {
        $jabatan_id = Jabatan::whereIn('jabatan_id', $jabatan_ids)->pluck('id');
        return $jabatan_id;
    }

    public function checkDataJenisJabatan($jenis_jabatan_id)
    {
		$jabatan = MasterJabatan::where('jenis_jabatan_id', $jenis_jabatan_id)->count();
        if($jabatan > 0) return false; //if exist
        else return true; //if not exist
    }


    public function getAllMasterJabatan()
    {
        $master_jabatan = MasterJabatan::get();
        return $master_jabatan;
    }

    public function getAllMasterDepartemen()
    {
        $master_departemen = MasterDepartemen::get();
        return $master_departemen;
    }

    public function getProfilJabatan($id)
    {
        $pegawai = Pegawai::find($id);
       
        $jabatan = Jabatan::where('pegawai_id', $pegawai->id)
                        ->orderBy('created_at', 'DESC')
                        ->with('jabatan', 'departemen')
                        ->paginate(5);
        return $jabatan;
    }

    public function getPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        return $pegawai;
    }
}
