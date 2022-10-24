<?php

namespace App\Http\Controllers\Keuangan\Kwitansi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Kwitansi;
use Carbon\Carbon;
use DB;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $data['kwitansi'] = Kwitansi::where('id',$id)->delete();
        
        return redirect()->route('kwitansi');
    }

    
}