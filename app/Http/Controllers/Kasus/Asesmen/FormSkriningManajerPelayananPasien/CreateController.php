<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create(Request $req, $kasus_id)
    {
        $conn = DB::connection('kasus');
        $conn->beginTransaction();

        try {
            $asesmen = new AlatBantu();
            $asesmen->type = 'form-skrining-manajer-pelayanan-pasien';
            $asesmen->val = $this->createJson($req);
            $asesmen->created_by = Auth::user()->id;
            $asesmen->kasus_id = $kasus_id;
            $asesmen->save();

            $conn->commit();
        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function createJson(Request $req)
    {
        $obj = new \StdClass;
        $obj->dx_medis = $req->dx_medis;
        $obj->tanggal = $req->tanggal;
        $obj->mpp = $req->mpp;
        $obj->risiko = $req->risiko;
        $obj->waktu_prediksi = $req->waktu_prediksi;

        return json_encode($obj);
    }
}
