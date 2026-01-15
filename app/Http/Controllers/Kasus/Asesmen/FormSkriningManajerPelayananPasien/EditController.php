<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit(Request $req){
    	$asesmen = AlatBantu::find($req->id);
    	
        $conn = DB::connection('kasus');
        $conn->beginTransaction();

        try {
            $asesmen->type = 'form-skrining-manajer-pelayanan-pasien';
            $asesmen->val = app(\App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien\CreateController::class)
                ->createJson($req);
            $asesmen->updated_by = Auth::user()->id;
    	    $asesmen->save();

            $conn->commit();
        } catch (\Exception $e) {
            $conn->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}