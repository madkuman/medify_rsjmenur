<?php

namespace App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Keperawatan;
use App\Models\Keperawatan\JenisRencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhan;
use App\Models\Keperawatan\RencanaAsuhanDetail;

class CreateController extends Controller
{
    public function create(Request $request, $nomor_kasus){
        DB::connection('keperawatan')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $asuhan = RencanaAsuhan::all();
            $jenisasuhan = JenisRencanaAsuhan::all();
            $kasus_asuhan = Keperawatan::all();
            $asuhan_detail = RencanaAsuhanDetail::all();
            $data['kasus_asuhan'] = $kasus_asuhan;
            $data['kasus'] = $kasus;
            $data['active_nav'] = 'rencana-asuhan';
            $data['sidebar_active'] = 'keperawatan';
            $data['asuhan'] = $asuhan;
            $data['jenisasuhan'] = $jenisasuhan;
            $data['asuhan_detail'] = $asuhan_detail;
            $asuhan_diagnosa = $request->asuhan_diagnosa;
            $asuhan_jenis = $request->asuhan_jenis;
            $kasus_id = $request->kasus_id;
            $prefix_diagnosa = $request->prefix;
            $tujuan_jumlah_asuhan = $request->tujuan_jumlah_asuhan;
            $tujuan_periode_asuhan = $request->tujuan_periode_asuhan;
            $tujuan_jenis_periode_asuhan = $request->tujuan_jenis_periode_asuhan;
            $opsi_diagnosa = $request->opsi_diagnosa;
            $diagnosa_tambahan = $request->diagnosa_tambahan;
            $opsi_penunjang = $request->opsi_penunjang;
            $penunjang_tambahan = $request->penunjang_tambahan;
            $opsi_subyektif = $request->opsi_subyektif;
            $subyektif_tambahan = $request->subyektif_tambahan;
            $opsi_obyektif = $request->opsi_obyektif;
            $obyektif_tambahan = $request->obyektif_tambahan;
            $opsi_tujuan = $request->opsi_tujuan;
            $tujuan_tambahan = $request->tujuan_tambahan;
            $opsi_mandiri = $request->opsi_mandiri;
            $mandiri_tambahan = $request->mandiri_tambahan;
            $opsi_kolaborasi = $request->opsi_kolaborasi;
            $kolaborasi_tambahan = $request->kolaborasi_tambahan;
            $created_by = $request->user_name;

            $kep = new Keperawatan;
            $kep->asuhan_diagnosa = $asuhan_diagnosa;
            $kep->kasus_id = $kasus_id;
            $kep->asuhan_jenis = $asuhan_jenis;
            $kep->prefix_diagnosa = $prefix_diagnosa;
            $kep->tujuan_jumlah_asuhan = $tujuan_jumlah_asuhan;
            $kep->tujuan_periode_asuhan = $tujuan_periode_asuhan;
            $kep->tujuan_jenis_periode_asuhan = $tujuan_jenis_periode_asuhan;
            $kep->checked_opsi_diagnosa = serialize($opsi_diagnosa);
            $kep->diagnosa_tambahan = $diagnosa_tambahan;
            $kep->checked_opsi_penunjang = serialize($opsi_penunjang);
            $kep->penunjang_tambahan = $penunjang_tambahan;
            $kep->checked_opsi_subyektif = serialize($opsi_subyektif);
            $kep->subyektif_tambahan = $subyektif_tambahan;
            $kep->checked_opsi_obyektif = serialize($opsi_obyektif);
            $kep->obyektif_tambahan = $obyektif_tambahan;
            $kep->checked_opsi_tujuan = serialize($opsi_tujuan);
            $kep->tujuan_tambahan = $tujuan_tambahan;
            $kep->checked_opsi_mandiri = serialize($opsi_mandiri);
            $kep->mandiri_tambahan = $mandiri_tambahan;
            $kep->checked_opsi_kolaborasi = serialize($opsi_kolaborasi);
            $kep->kolaborasi_tambahan = $kolaborasi_tambahan;
            $kep->created_by = $created_by;
            $kep->save();

            DB::connection('keperawatan')->commit();
            DB::connection('kasus')->commit();

            $status = 1;
            $message = 'Rencana Asuhan Keperawatan baru berhasil dibuat!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','keperawatan',$kep->id,$kasus->id);

            DB::connection('kasus')->commit();

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch(\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('keperawatan')->rollback();
            DB::connection('kasus')->rollback();

            $status = 1;
            $message = 'Rencana Asuhan Keperawatan gagal berhasil dibuat!';
            $title = 'Error!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }
}
