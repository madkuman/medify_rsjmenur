<?php

namespace App\Http\Controllers\Harmat\PerbaikanAlat;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $request)
	{
        $tgl_laporan = $request->tahun_laporan."-".$request->bulan_laporan."-".$request->tanggal_laporan." ".$request->jam_laporan.":".$request->menit_laporan;

        $request->request->add([
                            'tgl_laporan' => $tgl_laporan
                            ]);

		DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\PerbaikanAlat\CreateController')->store($request->all());

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
        $data = app('App\Http\Controllers\Harmat\PerbaikanAlat\ReadController')->getEachData($id);
        if($data->status == 0){
            $tgl_laporan = $request->tahun_laporan."-".$request->bulan_laporan."-".$request->tanggal_laporan." ".$request->jam_laporan.":".$request->menit_laporan;
            $request->request->add([
                            'tgl_laporan' => $tgl_laporan
                            ]);
        }elseif($data->status == 1){
            $tgl_identifikasi = $request->tahun_identifikasi."-".$request->bulan_identifikasi."-".$request->tanggal_identifikasi." ".$request->jam_identifikasi.":".$request->menit_identifikasi;
            $request->request->add([
                            'tgl_identifikasi' => $tgl_identifikasi
                            ]);
        }elseif($data->status == 2){
            $tgl_mulai = $request->tahun_mulai."-".$request->bulan_mulai."-".$request->tanggal_mulai;
            $request->request->add([
                            'tgl_mulai' => $tgl_mulai
                            ]);
        }elseif($data->status == 3){
            $tgl_selesai = $request->tahun_selesai."-".$request->bulan_selesai."-".$request->tanggal_selesai;
            $request->request->add([
                            'tgl_selesai' => $tgl_selesai
                            ]);
        }

        $request->request->add([
                        'nama_alat' => $request->nama_alat,
                        'alasan' => $request->alasan
                        ]);

    	DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\PerbaikanAlat\UpdateController')->update($request->all(), $id);

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

    public function updateStatus(Request $request, $id)
    {
        $tgl = $request->tahun."-".$request->bulan."-".$request->tanggal;
        $data = app('App\Http\Controllers\Harmat\PerbaikanAlat\ReadController')->getEachData($id);
        if ($data->status == 0) {
            $tgl = $tgl." ".$request->jam.":".$request->menit;
            $request->request->add([
                            'status'    => '1',
                            'tgl_identifikasi' => $tgl
                            ]);
        }else if($data->status == 1){
            $request->request->add([
                            'status'    => '2',
                            'tgl_mulai' => $tgl
                            ]);
        }
        else if($data->status == 2){
            $request->request->add([
                            'status'    => '3',
                            'tgl_selesai' => $tgl
                            ]);
        }

        DB::connection('harmat')->beginTransaction();
        try
        {
            app('App\Http\Controllers\Harmat\PerbaikanAlat\UpdateController')->update($request->all(), $id);

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
            app('App\Http\Controllers\Harmat\PerbaikanAlat\DeleteController')->delete($id);

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
