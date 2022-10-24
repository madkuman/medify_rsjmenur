<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormTransferInternalRumahSakit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\FormTransferInternalRumahSakit;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $form_transfer_internal_rumah_sakit = FormTransferInternalRumahSakit::find($id);
        if($form_transfer_internal_rumah_sakit)
        {
            $form_transfer_internal_rumah_sakit->deleted_by = Auth::user()->id;
            $form_transfer_internal_rumah_sakit->save();
            $form_transfer_internal_rumah_sakit->delete();
        }
    }
}