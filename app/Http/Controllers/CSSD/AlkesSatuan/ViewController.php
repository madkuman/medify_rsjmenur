<?php

namespace App\Http\Controllers\CSSD\AlkesSatuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuan;
use DNS1D;
use DOMPDF;

class ViewController extends Controller
{
    public function single($id)
    {
        $navbar_active = 'alat';
        $data['alkes'] = AlkesSatuan::find($id);
        if($data['alkes'] == null) abort(404);
        
        $data['navbar_active'] = $navbar_active;
        return view('cssd.alkes-satuan.single',$data);
    }


    public function printLabel($id)
    {
        $alkes = AlkesSatuan::where('id',$id)->get();
        $alkes_barcode = array();
        $alkes_slug = array();
        foreach($alkes as $item)
        {
            $temp = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($item->slug, "C128",1,20) . '" alt="barcode"   />';
            $alkes_barcode[] = $temp;
            $alkes_slug[] = $item->slug;
        }
        $data['alkes_barcode'] = $alkes_barcode;
        $data['alkes_slug'] = $alkes_slug;

        $customPaper = array(0,0,150,100);
        $pdf = DOMPDF::loadView('cssd/alkes/print-label-semua', $data)->setPaper($customPaper);
        $filename = 'Print Label';
        return $pdf->stream($filename);

    }
}
