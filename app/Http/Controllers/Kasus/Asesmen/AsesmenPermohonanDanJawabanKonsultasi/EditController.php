<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use Auth;
use DB;


class EditController extends Controller
{
    public function edit($nomor_kasus, $id, Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            $data = new \stdclass();
            $data->permohonan = $request->input('permohonan');
            $data->jawaban = $request->input('jawaban');

            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $alatBantu = AlatBantu::find($id);
            $alatBantu->val = json_encode($data);
            $alatBantu->save();

            DB::connection('kasus')->commit();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id, 'edit', 'asesmen-permohonan-dan-jawaban-konsultasi', $alatBantu->id);

            $status = 1;
            $message = 'Asesmen Permohonan dan Jawaban Konsultasi berhasil diperbaharui';
            $title = 'Berhasil!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Asesmen gagal diperbaharui : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
