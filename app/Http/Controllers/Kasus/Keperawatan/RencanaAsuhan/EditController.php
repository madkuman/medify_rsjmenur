<?php

namespace App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Keperawatan;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function update($nomor_kasus, Request $request)
    {   
        DB::connection('keperawatan')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try
        {
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $opsi_diagnosa = $request->opsi_diagnosa;
            $diagnosa_tambahan = $request->diagnosa_tambahan;
            $prefix_diagnosa = $request->prefix;
            $tujuan_jumlah_asuhan = $request->tujuan_jumlah_asuhan;
            $tujuan_periode_asuhan = $request->tujuan_periode_asuhan;
            $tujuan_jenis_periode_asuhan = $request->tujuan_jenis_periode_asuhan;
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

            $kep = Keperawatan::findOrFail($request->input('id'));
            $kep->checked_opsi_diagnosa = serialize($opsi_diagnosa);
            $kep->diagnosa_tambahan = $diagnosa_tambahan;
            $kep->tujuan_jumlah_asuhan = $tujuan_jumlah_asuhan;
            $kep->tujuan_periode_asuhan = $tujuan_periode_asuhan;
            $kep->tujuan_jenis_periode_asuhan = $tujuan_jenis_periode_asuhan;
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
            $kep->save();

            $status = 1;
            $message = 'Rencana Asuhan Keperawatan baru berhasil diedit!';
            $title = 'Berhasil!';

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'edit','keperawatan',$kep->id,$kasus->id);

            DB::connection('keperawatan')->commit();
            DB::connection('kasus')->commit();

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch(\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('keperawatan')->rollback();
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Rencana Asuhan Keperawatan gagal berhasil diedit!';
            $title = 'Error!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function verifikasiDokter($nomor_kasus, $rencana_asuhan_id)
    {
        $kep = Keperawatan::find($rencana_asuhan_id);
        $kep->verified_dokter_by = Auth::user()->id;
        $kep->verified_dokter_at = Carbon::now();
        $kep->save();

        $status = 1;
        $message = 'Rencana Asuhan Keperawatan berhasil diverifikasi!';
        $title = 'Berhasil!';

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function verifikasiNers($nomor_kasus, $rencana_asuhan_id)
    {
        $kep = Keperawatan::find($rencana_asuhan_id);
        $kep->verified_ners_by = Auth::user()->id;
        $kep->verified_ners_at = Carbon::now();
        $kep->save();

        $status = 1;
        $message = 'Rencana Asuhan Keperawatan berhasil diverifikasi!';
        $title = 'Berhasil!';

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}