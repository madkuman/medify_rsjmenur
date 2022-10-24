<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
    public function index($id)
    {
		$pegawai = app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->getPegawai($id);
		$jenis = app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->jenisSurat()->all();
        $is_hrd_member 	= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
        $items		= app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->getAllPangkat($id);

        return view('kepegawaian.pegawai.surat-peringatan.index', compact(
            'pegawai',
            'jenis',
            'is_hrd_member',
            'items'
        ));
    }

    public function edit($id)
    {
        $edit = app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->getEditPegawai($id);
        return response()->json($edit);
    }

    public function download($id)
    {
        $download = app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->download($id);
        // dd(!empty($download->nama_file));
        if (!empty($download->nama_file)) {
            $file = public_path() . '/uploads/kepegawaian/jenis-surat/' . $download->nama_file;
            return response()->download($file, $download->nama_file);
        }
        else {
            $status = -1;
			$message = 'File Tidak Ada';
			$title = 'Gagal!';
			if(!empty($status['message'])) $message = $status['message'];

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status)
            ->withInput();
        }
    }

    public function print($id)
    {
        $print = app("App\Http\Controllers\Kepegawaian\Pegawai\SuratPeringatan\ReadController")->print($id);
        return $print->stream();
    }
}
