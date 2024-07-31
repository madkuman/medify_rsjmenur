<?php

namespace App\Http\Controllers\Kasus\AlatBantu\FormTransferAntarRuangan;

use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function submit(Request $request)
    {
        $form = $this->formValuesToJson($request);

        $conn = DB::connection('kasus');
        $conn->beginTransaction();

        try {
            $new_alat_bantu = new AlatBantu();
            $new_alat_bantu->kasus_id = $request->post('kasus_id');
            $new_alat_bantu->type = 'form-transfer-antar-ruangan';
            $new_alat_bantu->val = $form;
            $new_alat_bantu->created_by = Auth::user()->id;
            $new_alat_bantu->save();

            $conn->commit();

            $status = 1;
            $message = 'Form transfer antar ruangan berhasil dibuat';
            $title = 'Berhasil!';

        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 0;
            $message = 'Form transfer antar ruangan gagal dibuat';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    public function update(Request $request)
    {
        $alatbantu_id = $request->post('alatbantu_id');
        $form = $this->formValuesToJson($request, $alatbantu_id);

        $conn = DB::connection('kasus');
        $conn->beginTransaction();

        try {
            $new_alat_bantu = AlatBantu::findOrFail($alatbantu_id);
            $new_alat_bantu->val = $form;
            $new_alat_bantu->updated_by = Auth::user()->id;
            $new_alat_bantu->save();

            $conn->commit();

            $status = 1;
            $message = 'Form transfer antar ruangan berhasil diperbarui';
            $title = 'Berhasil!';

        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 0;
            $message = 'Form transfer antar ruangan gagal diperbarui';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    public function delete(Request $request)
    {
        try {
            AlatBantu::findOrFail($request->post('alatbantu_id'))->delete();
            $status = 1;
            $message = 'Form transfer antar ruangan berhasil dihapus';
            $title = 'Berhasil!';

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = 0;
            $message = 'Form transfer antar ruangan gagal dihapus';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    private function formValuesToJson($request, $alatbantu_id = null)
    {
        $obj = new \stdClass;
        if(!empty($alatbantu_id)) $obj->id = $alatbantu_id;
        $obj->dpjp = $request->post('dpjp');
        $obj->tgl_mrs = $request->post('tgl_mrs');
        $obj->dokter_spesialis_lain = $request->post('dokter_spesialis_lain');
        $obj->tgl_pindah = $request->post('tgl_pindah');
        $obj->diagnosis_mrs = $request->post('diagnosis_mrs');
        $obj->alergi = $request->post('alergi');
        $obj->alasan_admisi = $request->post('alasan_admisi');
        $obj->anamnesis = $request->post('anamnesis');
        $obj->keluhan_utama = $request->post('keluhan_utama');
        $obj->riwayat_penyakit = $request->post('riwayat_penyakit');
        $obj->pemeriksaan_fisik = $request->post('pemeriksaan_fisik');
        $obj->keadaan_umum = $request->post('keadaan_umum');
        $obj->pemeriksaan_penunjang = $request->post('pemeriksaan_penunjang');
        $obj->tindakan_medis = $request->post('tindakan_medis');
        $obj->pemberian_terapi = $request->post('pemberian_terapi');
        $obj->lain_lain = $request->post('lain_lain');
        $obj->dari_ruang = $request->post('dari_ruang');
        $obj->ke_ruang = $request->post('ke_ruang');
        $obj->transfer_sebelum = $request->post('transfer_sebelum');
        $obj->transfer_sesudah = $request->post('transfer_sesudah');
        $obj->keadaan_umum_sebelum = $request->post('keadaan_umum_sebelum');
        $obj->keadaan_umum_sesudah = $request->post('keadaan_umum_sesudah');
        $obj->kesadaran_sebelum = $request->post('kesadaran_sebelum');
        $obj->kesadaran_sesudah = $request->post('kesadaran_sesudah');
        $obj->tensi_sebelum = $request->post('tensi_sebelum');
        $obj->tensi_sesudah = $request->post('tensi_sesudah');
        $obj->suhu_sebelum = $request->post('suhu_sebelum');
        $obj->suhu_sesudah = $request->post('suhu_sesudah');
        $obj->nadi_sebelum = $request->post('nadi_sebelum');
        $obj->nadi_sesudah = $request->post('nadi_sesudah');
        $obj->resp_sebelum = $request->post('resp_sebelum');
        $obj->resp_sesudah = $request->post('resp_sesudah');
        $obj->catatan_sebelum = $request->post('catatan_sebelum');
        $obj->catatan_sesudah = $request->post('catatan_sesudah');
        $obj->petugas_sebelum = $request->post('petugas_sebelum');
        $obj->petugas_sesudah = $request->post('petugas_sesudah');

        return json_encode($obj);
    }
}
