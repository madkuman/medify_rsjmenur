<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JenisMakanan;

use App\Models\Gizi\Diet;
use App\Models\Gizi\JenisMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $jenis_makanan = JenisMakanan::find($id);
        $jenis_makanan->delete();
    }
}
