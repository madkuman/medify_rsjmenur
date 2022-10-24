<?php

namespace App\Http\Controllers\Kasus\TransferPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TransferPasien;

class DeleteController extends Controller
{
    public function delete(Request $request){
    	$id = $request->id;
        
        $transfer_pasien = TransferPasien::find($id);
        if($transfer_pasien)
            $transfer_pasien->delete();
    }
}