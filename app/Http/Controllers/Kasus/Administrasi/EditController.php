<?php

namespace App\Http\Controllers\Kasus\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\IGD\Ruangan;
use DB;
use Bugsnag;

class EditController extends Controller
{
    public function rujukIGD(Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $pasien_id = $request->pasien_id;
            $ruangan_id = $request->ruangan_id;
            $ruangan_name = $request->ruangan_name;
            $nomor_kasus = $request->nomor_kasus;
            $kasus_id = $request->kasus_id;
            $ruangan =Ruangan::find($ruangan_id);
            //dd($request);
            
            $rujuk = app('App\Http\Controllers\IGD\Transaksi\PostController')->rujukRuang($request);
            $lokasi = app('App\Http\Controllers\Kasus\Kasus\CreateController')->insertLokasi($kasus_id,$ruangan->lokasi_id);

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil di Rujuk';
            $data['url'] = 'kasus/'.$nomor_kasus;
            
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return json_encode($data);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }

    public function rujukRawatjalan(Request $request)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $pasien_id = $request->pasien_id;
            $poli_tujuan_id = $request->poli_tujuan_id;
            $kasus_id = $request->kasus_id;
            $poli_asal_id = $request->poli_asal_id;
            $buat_kasus_baru = $request->buat_kasus_baru;
            $keterangan = $request->keterangan;

            $kasus = Kasus::find($request->kasus_id);
            $nomor_kasus = $kasus->nomor_kasus;
            
            /*JIKA LANGSUNG RUJUK TANPA PERLU PERMINTAAN RUJUKAN*/
            //$rujuk = app('App\Http\Controllers\RawatJalan\Transaksi\PostController')->rujukPoli($request);
            
            //BUAT DULU PERMINTAAN RUJUKAN
            $rujuk = app('App\Http\Controllers\RawatJalan\PermintaanRujuk\CreateController')->create($request);

            //$lokasi = app('App\Http\Controllers\Kasus\Kasus\CreateController')->insertLokasi($kasus_id,'Menunggu Rujukan');

            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Pasien berhasil di Rujuk';
            $data['url'] = 'kasus/'.$nomor_kasus;

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return json_encode($data);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }
}
