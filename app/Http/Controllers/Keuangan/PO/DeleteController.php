<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PO;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
    	$po = PO::find($id);
    	$po->deleted_by = Auth::user()->id;
    	$po->save();
        $po->delete();

        $data['url'] = 'keuangan/po/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'PO berhasil dihapus.';
        return json_encode($data);
    }
}
