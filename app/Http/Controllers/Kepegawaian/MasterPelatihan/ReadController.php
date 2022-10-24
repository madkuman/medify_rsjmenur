<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPelatihan;
use Alert;
use App\Models\Kepegawaian\Berkas;

class ReadController extends Controller
{
    public function getMasterPelatihan()
    {
        $pelatihan = MasterPelatihan::all();
		return $pelatihan;
    }

    public function getData(Request $request)
    {
        $pelatihan = MasterPelatihan::find($request->id);
        return json_encode($pelatihan);
    }

    public function getFile($emp, $id) {
		$thefile = Berkas::find($id);
		$extension = $thefile->extension;
		$filename = $id.'.'.$extension;
		$destination_path = public_path('/uploads/kepegawaian/pelatihan');
	
		if(file_exists($destination_path.'/'.$filename)) {
		    return response()->file($destination_path.'/'.$filename);
		}
		else {
            Alert::error('Sertifikat pelatihan tidak ditemukan', 'Gagal!');
            return redirect()->route('trainings', ['id' => $emp]);
		}
    }

    public function getFileMaster($id) {
		$thefile = Berkas::find($id);
		$extension = $thefile->extension;
		$filename = $id.'.'.$extension;
		$destination_path = public_path('/uploads/kepegawaian/pelatihan');
	
		if(file_exists($destination_path.'/'.$filename)) {
		    return response()->file($destination_path.'/'.$filename);
		}
		else {
            Alert::error('Sertifikat pelatihan tidak ditemukan', 'Gagal!');
            return redirect()->back();
		}
    }
}
