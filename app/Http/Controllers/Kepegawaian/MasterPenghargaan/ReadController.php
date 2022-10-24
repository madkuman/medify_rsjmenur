<?php

namespace App\Http\Controllers\Kepegawaian\MasterPenghargaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPenghargaan;
use App\Models\Kepegawaian\Berkas;
use Alert;

class ReadController extends Controller
{
    public function getData(Request $request)
    {
        $penghargaan = MasterPenghargaan::find($request->id);
        return json_encode($penghargaan);
    }

    public function getDataAjax($id)
    {
        $penghargaan = MasterPenghargaan::find($id);
        return json_encode($penghargaan);
    }

    public function getAll()
    {
        $penghargaan = MasterPenghargaan::all();
        return $penghargaan;
    }

    public function getFileMaster($id) {
		$thefile = Berkas::find($id);
		$extension = $thefile->extension;
		$filename = $id.'.'.$extension;
		$destination_path = public_path('/uploads/kepegawaian/penghargaan');
	
		if(file_exists($destination_path.'/'.$filename)) {
		    return response()->file($destination_path.'/'.$filename);
		}
		else {
            Alert::error('Sertifikat pelatihan tidak ditemukan', 'Gagal!');
            return redirect()->back();
		}
    }

    public function getFile($emp, $id) {
		$thefile = Berkas::find($id);
		$extension = $thefile->extension;
		$filename = $id.'.'.$extension;
		$destination_path = public_path('/uploads/kepegawaian/penghargaan');
	
		if(file_exists($destination_path.'/'.$filename)) {
		    return response()->file($destination_path.'/'.$filename);
		}
		else {
            Alert::error('Sertifikat pelatihan tidak ditemukan', 'Gagal!');
            return redirect()->route('trainings', ['id' => $emp]);
		}
    }
}
