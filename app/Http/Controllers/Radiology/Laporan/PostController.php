<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Radiology\Transaction;
use App\Models\Radiology\LaporanMaster;
use App\Models\Keuangan\TarifMaster;
use App\Exports\Radiologi\RekapBulanan;

use App\Jobs\QueueArtisan;

use DB;
use Bugsnag;
use Auth;
use Carbon\Carbon;
use DOMPDF;

class PostController extends Controller
{
    static protected $departemenId = 8;
    static protected $lokasi_id = 1;
    static protected $slug = 'lab-radiologi';

    public function update(Request $req, $slug)
    {
        try {
            DB::connection('radiology')->beginTransaction();
            $nama = $req->nama;
            
            $konten = [];
            foreach($req->parent as $parent)
            {
                if($parent == "FOTO_KONTRAS")
                    $konten[$parent] = $this->updateDetail($req, $parent);
                else
                    $konten[$parent]['id'] = $req['detail_'.$parent];
            }
            $master = LaporanMaster::where('slug', $slug)->first();
            $master->nama = $nama;
            $master->konten = json_encode($konten);
            $master->save();
            $status = "success";
            $message = 'Berhasil Mengubah Laporan';
            $title = 'Berhasil!';

            DB::connection('radiology')->commit();
            return redirect('radiologi/laporan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('radiology')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = "error";
            $message = 'Gagal Mengubah Laporan';
            $title = 'Gagal!';
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        }
    }

    private function updateDetail($req, $parent)
    {
        $temp = [];
        foreach($req['header_'.$parent] as $i => $header)
        {
            $detail = [];
            $ids = [];
            foreach ($req['detail_'.$parent][$i] as $key => $val) {
                array_push($detail, [
                    'nama' => TarifMaster::find($val)->deskripsi,
                    'id' => $val
                ]);
                array_push($ids, $val);
            }
            array_push($temp, [
                'header' => $header,
                'detail' => $detail,
                'id' => $ids
            ]);
        }
        //KALO NAMBAH HEADER BARU
        if(isset($req['header_'.$parent.'_new'])){
            foreach($req['header_'.$parent.'_new'] as $i => $header)
            {
                $detail = [];
                $ids = [];
                foreach ($req['detail_'.$parent.'_new'][$i] as $key => $val) {
                    array_push($detail, [
                        'nama' => TarifMaster::find($val)->deskripsi,
                        'id' => $val
                    ]);
                    array_push($ids, $val);
                }
                array_push($temp, [
                    'header' => $header,
                    'detail' => $detail,
                    'id' => $ids
                ]);
            }
        }

        return $temp;
    }

    public function rekapPemeriksaanPasienBulanan(Request $request)
    {
        $data['date'] = $request->date;
        $data['type'] = $request->layanan;

        dispatch(new QueueArtisan('radiologi:laporan-rekap-pemeriksaan-pasien-bulanan',$data));
        return abort(201);
    }

    public function rekapPemeriksaanPasienHarian(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('radiologi:laporan-rekap-pemeriksaan-pasien-harian',$data));
        return abort(201);
    }

    public function historiPemeriksaanPasienHarian(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('radiologi:laporan-histori-pemeriksaan-pasien-harian',$data));
        return abort(201);
    }
}