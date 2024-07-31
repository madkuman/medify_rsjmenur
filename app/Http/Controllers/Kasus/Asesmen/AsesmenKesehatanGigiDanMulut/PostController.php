<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenKesehatanGigiDanMulut;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Kasus\Kasus;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->asesmen_title = 'Asesmen Kesehatan Gigi dan Mulut';
        $this->asesmen_namespace = 'App\Http\Controllers\Kasus\Asesmen\AsesmenKesehatanGigiDanMulut';
        $this->asesmen_slug = 'asesmen-kesehatan-gigi-dan-mulut';
    }

    public function submitForm($nomor_kasus, Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            // dd($request);
            $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
            $id = $request->id;

            $hasil = [];
            $vitalsign = [];
            $input = $request->all();
            $input_image = [];
            foreach ($input as $key => $val) {
                if ($key == '_token')    continue;
                if ($key == 'kasus')    continue;
                if ($key == 'id')    continue;
                if ($key == 'sistol') $vitalsign[$key] = $val;
                if ($key == 'diastol') $vitalsign[$key] = $val;
                if ($key == 'nadi') $vitalsign[$key] = $val;
                if ($key == 'suhu') $vitalsign['temperatur'] = $val;
                if ($key == 'rr') $vitalsign['pernapasan'] = $val;
                if ($key == 'image') {
                    foreach ($val as $key => $item_name) {
                        if ($request->$item_name) {
                            $input_image[$item_name] = base64ToImage(
                                $request->$item_name,
                                "uploads/asesmen/" . $this->asesmen_slug,
                                $key
                            );
                        }
                    }
                    continue;
                }
                if ($input_image[$key] ?? null) {
                    $hasil[$key] = $input_image[$key];
                } else {
                    $hasil[$key] = $val == "on" ? 'Ya' : $val;
                }
            }

            $vitalsign['tanggal_pemeriksaan'] = Carbon::now()->format('Y-m-d') . 'T' . Carbon::now()->format('H:i');
            $vitalsign = new Request($vitalsign);
            $check_vitalsign = $request->id;
            if ($check_vitalsign == null) {
                app(\App\Http\Controllers\Kasus\VitalSign\CreateController::class)->create($nomor_kasus, $vitalsign);
            }
            if ($id != null) {
                $alatBantu = AlatBantu::find($id);
                $alatBantu->updated_by = Auth::user()->id;
                $alatBantu->updated_by = Auth::user()->id;
            } else {
                $alatBantu = new AlatBantu;
                $alatBantu->created_by = Auth::user()->id;
                $alatBantu->created_by = Auth::user()->id;
            }

            $alatBantu->kasus_id = $kasus->id;
            $alatBantu->type = $this->asesmen_slug;
            $alatBantu->val = json_encode($hasil);
            $alatBantu->save();

            DB::connection('kasus')->commit();

            if ($id != null) {
                return redirect('kasus/' . $nomor_kasus . '/asesmen/' . $this->asesmen_slug . '/edit/' . $id)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Diperbaharui!');
            } else {
                return redirect('kasus/' . $nomor_kasus . '/asesmen/' . $this->asesmen_slug)
                    ->with('status', 1)
                    ->with('title', 'Sukses')
                    ->with('message', 'Asesmen Berhasil Dibuat!');
            }
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function delete(Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            $id = $request->id;

            $form = AlatBantu::find($id);
            $form->delete();

            DB::connection('kasus')->commit();

            return back()
                ->with('status', 1)
                ->with('title', 'Sukses')
                ->with('message', 'Asesmen Berhasil di Hapus');
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Gagal : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
