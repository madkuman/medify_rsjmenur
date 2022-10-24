<?php

namespace App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function save(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        $farm = session('farmasi');
        try {
            app('App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep\EditController')->edit($request);

            DB::connection('farmasi')->commit();

            $status = 1;
            $message = "Berhasil menyimpan Waktu Estimasi";
            $title = 'Berhasil!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/waktu-estimasi')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);   
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan Waktu Estimasi";
            $title = 'Gagal!';

            return redirect('farmasi/'.$farm->slug.'/screen-tv/waktu-estimasi')
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);   
        }
    }
}
