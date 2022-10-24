<?php

namespace App\Http\Controllers\RawatJalan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Ruangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $nama = strtolower($request->nama_ruangan);
        if(strpos($nama, "ruangan") == false){
            $nama = "ruangan ".$request->nama_ruangan; 
        }
        $cek = Ruangan::where('nama', 'like', '%'.$nama.'%')->first();
        if (!empty($cek) && $request->id_ruangan == "") {
            $return['status'] = -1;
            $return['title'] = 'Gagal!';
            $return['message'] = 'Nama tersebut sudah terdaftar';
        }
        else {
            if ($request->id_ruangan == "") {
                $ruangan = new Ruangan();
                $ruangan->created_by = Auth::user()->id;
                $return['message'] = 'Berhasil menambahkan ruangan';
            } else {
                $ruangan = Ruangan::find($request->id_ruangan);
                $return['message'] = 'Berhasil memperbarui ruangan';
            }
            $ruangan->nama = ucwords($nama);
            $ruangan->poliklinik_id = $request->poli;
            $ruangan->dokter_id = $request->dokter;
            $ruangan->save();

            $return['status'] = 1;
            $return['title'] = 'Berhasil!';
        }

        return $return;
    }
}
