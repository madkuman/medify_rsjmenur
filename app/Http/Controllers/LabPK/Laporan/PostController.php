<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\LaporanMaster;
use App\Models\LabPK\LaporanRekap;
use App\Models\Keuangan\TarifMaster;
use App\Jobs\QueueArtisan;
use DB;
use Bugsnag;
use Auth;
use Carbon\Carbon;

class PostController extends Controller
{
    static protected $departemenId = 8;
    static protected $lokasi_id = 1;
    static protected $slug = 'lab-labpk';

    public function update(Request $req, $slug)
    {
        try {
            DB::connection('lab_pk')->beginTransaction();
            $nama = $req->nama;
            
            $konten = [];
            // dd($req);
            foreach($req->parent as $parent)
            {
                if(!isset($req['header_'.$parent]))
                    $konten[$parent]['id'] = $req['detail_'.$parent];
                else
                    $konten[$parent] = $this->updateDetail($req, $parent);
            }

            $master = LaporanMaster::where('slug', $slug)->first();
            $master->nama = $nama;
            $master->konten = json_encode($konten);
            $master->save();
            $status = "success";
            $message = 'Berhasil Mengubah Laporan';
            $title = 'Berhasil!';

            DB::connection('lab_pk')->commit();
            return redirect('labpk/laporan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('lab_pk')->rollback();
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
            if(isset($req['detail_'.$parent][$i]))
            {
                foreach ($req['detail_'.$parent][$i] as $key => $val) {
                    array_push($detail, [
                        'nama' => TarifMaster::find($val)->deskripsi,
                        'id' => $val
                    ]);
                    array_push($ids, $val);
                }
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
                if(isset($req['detail_'.$parent.'_new'][$i]))
                {
                    foreach ($req['detail_'.$parent.'_new'][$i] as $key => $val) {
                        array_push($detail, [
                            'nama' => TarifMaster::find($val)->deskripsi,
                            'id' => $val
                        ]);
                        array_push($ids, $val);
                    }
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

    public function seedRekap()
    {
       if(Auth::user()->id != config('const.super_admin'))
            abort(404);
        try {
            DB::connection('lab_pk')->beginTransaction();
            ini_set('max_execution_time', 1000);
            $transaksi = Transaksi::whereNotNull('result_created_at')->where('status', 1)->with(['pembayaran', 'detail_real', 'asal'])->get();
            foreach($transaksi as $t)
            {
                foreach($t->detail_real as $d)
                {
                    DB::connection('lab_pk')->table('laporan_rekap')->insert(
                        ['transaksi_id' => $t->id,
                        'tarif_id'     => $d->tarif_id,
                        'pasien_pembayaran_perusahaan'     => $t->pembayaran->perusahaan_id,
                        'lokasi_departemen'    => $t->asal->lokasi_departemen_id,
                        'result_created_at'    => $t->result_created_at]
                    );
                }
            }
            DB::connection('lab_pk')->commit();
            dd("DONE!");
        } catch (Exception $e) {
            DB::connection('lab_pk')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function rekapJumlahPasienBulanan(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-rekap-jumlah-pasien-bulanan',$data));
        return abort(201);
    }

    public function kunjunganBerdasarkanGenderDanUsia(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-kunjungan-berdasarkan-gender-dan-usia',$data));
        return abort(201);
    }

    public function laporanPemeriksaanLaboratorium(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-pemeriksaan-laboratorium',$data));
        return abort(201);
    }

    public function laporanJumlahPenderita(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-jumlah-penderita',$data));
        return abort(201);
    }

    public function laporanDataStatusRanap(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-data-status-ranap',$data));
        return abort(201);
    }

    public function laporanDataStatusRajal(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-data-status-rajal',$data));
        return abort(201);
    }

    public function laporanPenerimaan(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-penerimaan',$data));
        return abort(201);
    }

    public function laporanKunjunganTahunanPerLokasi(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-kunjungan-tahunan-per-lokasi',$data));
        return abort(201);
    }

    public function laporanKunjunganTahunanPerTarif(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-kunjungan-tahunan-per-tarif',$data));
        return abort(201);
    }

    public function laporanKunjunganTahunanPerDebitur(Request $request)
    {
        $data['date'] = $request->date;
        dispatch(new QueueArtisan('labpk:laporan-kunjungan-tahunan-per-debitur',$data));
        return abort(201);
    }

}