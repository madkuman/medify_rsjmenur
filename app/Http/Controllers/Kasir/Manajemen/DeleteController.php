<?php

namespace App\Http\Controllers\Kasir\Manajemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasir\Kasir;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        // dd($id);
        $id = $request->id;
    	$kasir = Kasir::find($id);
        $kasir->delete();

    	$data['url'] = 'kasir/manajemen/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'Kasir berhasil dihapus.';
        return json_encode($data);
    }
}