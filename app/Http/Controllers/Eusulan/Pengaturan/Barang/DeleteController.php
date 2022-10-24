<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Barang;

use App\Models\Eusulan\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DeleteController extends Controller
{
    function delete($id)
    {
        $barang = Barang::find($id);
        if($barang) {
            $barang->deleted_by = Auth::user()->id;
            $barang->save();
            $barang->delete();
        }
    }
}
