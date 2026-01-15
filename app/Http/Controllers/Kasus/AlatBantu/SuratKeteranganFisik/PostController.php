<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganFisik;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            $new_alat_bantu->type = 'surat-keterangan-fisik';
            $new_alat_bantu->val = $form;
            $new_alat_bantu->created_by = Auth::user()->id;
            $new_alat_bantu->save();

            $conn->commit();

            $status = 1;
            $message = 'Surat Keterangan Fisik berhasil dibuat';
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 0;
            $message = 'Surat Keterangan Fisik gagal dibuat';
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
            $message = 'Surat Keterangan Fisik berhasil diperbarui';
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 0;
            $message = 'Surat Keterangan Fisik gagal diperbarui';
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
            $message = 'Surat Keterangan Fisik berhasil dihapus';
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            $status = 0;
            $message = 'Surat Keterangan Fisik gagal dihapus';
            $title = 'Gagal!';
        }

        return back()
            ->with('message', $message)
            ->with('title', $title)
            ->with('status', $status);
    }

    private function formValuesToJson($request, $alatbantu_id = null)
    {
        $id_user = $request->post('dpjp');
        $user = User::find($id_user);
        $sip = $user->sip;
        $nip = $user->employee->nrp;

        $obj = new \stdClass;
        if (!empty($alatbantu_id)) $obj->id = $alatbantu_id;
        $obj->nomor = $request->post('nomor');
        $obj->dpjp = $request->post('dpjp');
        $obj->sip = $sip;
        $obj->nip = $nip;
        $obj->alamat = $request->post('alamat');
        $obj->pendidikan = $request->post('pendidikan');
        $obj->tanggal_pemeriksaan = $request->post('tanggal_pemeriksaan');
        $obj->tensi = $request->post('tensi');
        $obj->berat_badan = $request->post('berat_badan');
        $obj->tinggi_badan = $request->post('tinggi_badan');
        $obj->visus = $request->post('visus');
        $obj->syarat = $request->post('syarat');

        return json_encode($obj);
    }
}
