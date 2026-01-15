<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi;

use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function create($nomor_kasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            $data = new \stdclass();
            $data->permohonan = $request->input('permohonan');
            $data->jawaban = $request->input('jawaban');

            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $alatBantu = new AlatBantu;
            $alatBantu->kasus_id = $kasus->id;
            $alatBantu->type = "asesmen-permohonan-dan-jawaban-konsultasi";
            $alatBantu->created_by = Auth::user()->id;
            $alatBantu->val = json_encode($data);
            $alatBantu->save();


            DB::connection('kasus')->commit();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($kasus->id, 'create', 'asesmen-permohonan-dan-jawaban-konsultasi', $alatBantu->id);

            $status = 1;
            $message = 'Asesmen Permohonan dan Jawaban Konsultasi berhasil dibuat';
            $title = 'Berhasil!';

            return redirect('kasus/' . $kasus->nomor_kasus . '/asesmen/asesmen-permohonan-dan-jawaban-konsultasi')
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Asesmen gagal dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}