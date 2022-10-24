<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPangkat;
use App\Models\Kepegawaian\Pangkat;
use App\Models\Kepegawaian\Pegawai;

class ReadController extends Controller
{   
    public function getPangkatAjax($id)
    {
        $pangkat = MasterPangkat::find($id);
        return json_encode($pangkat);
    }

    public function getAllMasterPangkat()
    {
        $master_pangkat = MasterPangkat::all();
        return $master_pangkat;
    }

    public function getAllPangkat($id)
    {
        $pegawai = Pegawai::find($id);
        $pangkat = Pangkat::where('pegawai_id', $pegawai->id)->orderBy('tmt', 'DESC')->paginate(5);
        return $pangkat;
    }

    public function getPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        return $pegawai;
    }

}
