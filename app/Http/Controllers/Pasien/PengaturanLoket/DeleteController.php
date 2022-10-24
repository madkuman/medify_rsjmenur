<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PengaturanLoket;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $loket = PengaturanLoket::find($id);
        $loket->delete();
        // dd($loket);

        return $loket;
    }
}
