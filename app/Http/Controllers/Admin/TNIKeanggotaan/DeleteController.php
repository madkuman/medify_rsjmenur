<?php

namespace App\Http\Controllers\Admin\TNIKeanggotaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKeanggotaan;

class DeleteController extends Controller
{
    public function delete($id)
    {	
        $keanggotaan = TNIKeanggotaan::find($id);
        $keanggotaan->delete();
        return;
    }
}