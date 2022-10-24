<?php

namespace App\Http\Controllers\Keuangan\TTD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TTD;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        try {
	        DB::connection('keuangan')->beginTransaction();

	        $ttd = new TTD();
	        $ttd->nama = $request->nama;
	        $ttd->pangkat = $request->pangkat;
	        $ttd->jabatan = $request->jabatan;
	        $ttd->nip = $request->nip;
            $ttd->sipa = $request->sipa;
	        $ttd->save();

            $status = 1;
            $message = 'Berhasil menambah TTD';
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
