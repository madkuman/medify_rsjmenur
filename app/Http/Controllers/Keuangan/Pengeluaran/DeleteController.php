<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\Utang;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        // dd($id);
        $id = $request->id;
    	$pengeluaran = Pengeluaran::find($id);

        $utang = Utang::find($pengeluaran->utang_id);
        $utang->total_paid = 0;
        $utang->save();

        $pengeluaran->delete();

    	$data['url'] = 'keuangan/uji/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'UJI berhasil dihapus.';
        return json_encode($data);
    }
}