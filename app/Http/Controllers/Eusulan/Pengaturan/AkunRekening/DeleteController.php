<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\AkunRekening;

use App\Models\Eusulan\AkunRekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    function delete($id)
    {
        $akun_rekening = AkunRekening::find($id);
        if($akun_rekening) {
            $akun_rekening->deleted_by = Auth::user()->id;
            $akun_rekening->save();
            $akun_rekening->delete();
        }
    }
}
