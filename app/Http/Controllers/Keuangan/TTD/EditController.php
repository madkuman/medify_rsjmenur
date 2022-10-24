<?php

namespace App\Http\Controllers\Keuangan\TTD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TTD;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        try {
	        DB::connection('keuangan')->beginTransaction();

	        $ttd = TTD::find($request->id);
	        $ttd->nama = $request->nama;
	        $ttd->pangkat = $request->pangkat;
	        $ttd->jabatan = $request->jabatan;
	        $ttd->nip = $request->nip;
            $ttd->sipa = $request->sipa;
	        $ttd->save();

            $status = 1;
            $message = 'Berhasil mengedit TTD';
            $title = 'Berhasil!';

	        DB::connection('keuangan')->commit();

        } catch (Exception $e) {
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}
