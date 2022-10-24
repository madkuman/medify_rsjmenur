<?php

namespace App\Http\Controllers\Keuangan\Akun;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Akun;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        try {
	        DB::connection('keuangan')->beginTransaction();

	        $akun = Akun::find($request->id);
	        $akun->delete();

            $status = 1;
            $message = 'Berhasil menghapus akun';
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
