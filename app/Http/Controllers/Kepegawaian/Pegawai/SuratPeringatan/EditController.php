<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\SuratPeringatan;

class EditController extends Controller
{
    public function edit($request, $id)
    {
        $jenis = SuratPeringatan::find($id);
        $jenis->master_surat_peringatan_id = $request->jenis_surat;
        $jenis->tanggal_surat = $request->tanggal_surat;
        $jenis->judul_surat = $request->judul_surat;
        $jenis->no_surat = $request->no_surat;
        $jenis->konten_surat = $request->konten_surat;
        $jenis->save();
        if (!empty($request->nama_file)) {
            $jenis->nama_file = $request->nama_file->getClientOriginalName();
            $filename = (string)$request->nama_file->getClientOriginalName();
            $destination_path = public_path('/uploads/kepegawaian/jenis-surat');
            $request->nama_file->move($destination_path, $filename);
            $jenis->save();
        }

        return $jenis;
    }
}
