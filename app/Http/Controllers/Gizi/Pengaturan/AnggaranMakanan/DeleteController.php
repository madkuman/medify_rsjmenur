<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakanan;

use App\Models\Gizi\AnggaranMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $anggaran_makanan = AnggaranMakanan::find($id);
        $anggaran_makanan->deleted_by = Auth::user()->id;
        foreach ($anggaran_makanan->detail as $detail)
        {
            $detail->deleted_by = Auth::user()->id;
            $detail->save();
        }
        $anggaran_makanan->save();
        $anggaran_makanan->detail()->delete();
        $anggaran_makanan->delete();
    }
}
