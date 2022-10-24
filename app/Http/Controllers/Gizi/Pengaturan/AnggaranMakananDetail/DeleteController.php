<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakananDetail;

use App\Models\Gizi\AnggaranMakananDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $anggaran_makanan_detail = AnggaranMakananDetail::find($id);
        $anggaran_makanan_detail->delete();
    }
}
