<?php

namespace App\Http\Controllers\Kasus\Asesmen\GeneralConsentFortreatment;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Kasus\AlatBantu;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        DB::connection('kasus')->beginTransaction();

        try {
            $id = $request->id;

            $alatBantu = AlatBantu::find($id);
            if ($alatBantu) {
                $alatBantu->deleted_by = Auth::user()->id;
                $alatBantu->save();
                $alatBantu->delete();
            }

            DB::connection('kasus')->commit();

            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
                ->create($alatBantu->kasus_id, 'delete', 'general-consent-for-treatment', $alatBantu->id);

            $status = 1;
            $message = 'General Consent For Treatment berhasil dihapus';
            $title = 'Berhasil!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            DB::connection('kasus')->rollBack();
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'General Consent For Treatment gagal dihapus : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
            $data['error'] = $e->getMessage();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
