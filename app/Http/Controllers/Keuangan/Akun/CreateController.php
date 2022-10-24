<?php

namespace App\Http\Controllers\Keuangan\Akun;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Akun;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        try {
	        DB::connection('keuangan')->beginTransaction();

	        $akun = new Akun();
	        $akun->nama = $request->nama;
	        $akun->no_rekening = $request->no_rekening;
	        $akun->save();

            $status = 1;
            $message = 'Berhasil menambah akun';
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
