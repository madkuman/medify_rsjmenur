<?php

namespace App\Http\Controllers\Harmat\ListrikMati;

use DB;
use Bugsnag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	public function create(Request $request)
	{
		$mati_at = $request->tahun_mati."-".$request->bulan_mati."-".$request->tgl_mati." ".$request->jam_mati.":".$request->menit_mati.":".$request->detik_mati;
        $nyala_at = $request->tahun_mati."-".$request->bulan_mati."-".$request->tgl_mati." ".$request->jam_nyala.":".$request->menit_nyala.":".$request->detik_nyala;

        $request->request->add([
                            'mati_at'  => $mati_at,
                            'nyala_at' => $nyala_at
                            ]);
        
        DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\ListrikMati\CreateController')->store($request->all());

            $status = 1;
            $message = 'Input Berhasil';
            $title = 'Berhasil!';

            DB::connection('harmat')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('harmat')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        
        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
	}
    public function update(Request $request, $id)
    {
       $mati_at = $request->tahun_mati."-".$request->bulan_mati."-".$request->tanggal_mati." ".$request->jam_mati.":".$request->menit_mati.":".$request->detik_mati;
        $nyala_at = $request->tahun_mati."-".$request->bulan_mati."-".$request->tanggal_mati." ".$request->jam_nyala.":".$request->menit_nyala.":".$request->detik_nyala;

        $request->request->add([
                            'mati_at'  => $mati_at,
                            'nyala_at' => $nyala_at
                            ]);

    	DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\ListrikMati\UpdateController')->update($request->all(), $id);

            $status = 1;
            $message = 'Update Berhasil';
            $title = 'Berhasil!';

            DB::connection('harmat')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('harmat')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }
        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }

    public function delete($id)
    {
    	DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\ListrikMati\DeleteController')->delete($id);

            $status = 1;
            $message = 'Delete Berhasil';
            $title = 'Berhasil!';

            DB::connection('harmat')->commit();

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('harmat')->rollback();

            $status = -1;
            $message = 'Error Exception';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}
