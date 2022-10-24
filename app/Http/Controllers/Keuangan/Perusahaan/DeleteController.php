<?php

namespace App\Http\Controllers\Keuangan\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Perusahaan;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        // dd($id);
        $id = $request->id;
    	$perusahaan = Perusahaan::find($id);
        $perusahaan->delete();

    	$data['url'] = 'keuangan/pengaturan/rekanan/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'Rekanan Berhasil Dihapus.';
        return json_encode($data);
    }
}
