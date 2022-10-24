<?php

namespace App\Http\Controllers\CSSD\Alkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\CSSD\AlkesSatuan;
use DNS1D;
use DOMPDF;

class ViewController extends Controller
{
    public function index()
    {
        $navbar_active = 'alat';
        $alkes = ItemsTemplate::where('jenis','alkes')->with('cssd_stok_total','cssd_stok_siap_pakai','cssd_stok_sedang_digunakan')->get();
        $data['alkes'] = $alkes;
        $data['navbar_active'] = $navbar_active;
        return view('cssd.alkes.index',$data);
    }

    public function baru()
    {
        $navbar_active = 'alat';
        $data['navbar_active'] = $navbar_active;
        return view('cssd.alkes.baru',$data);
    }

    public function single($id)
    {
        $navbar_active = 'alat';
        $data['alkes'] = ItemsTemplate::find($id);
        if($data['alkes'] == null) abort(404);
        
        $data['navbar_active'] = $navbar_active;
        return view('cssd.alkes.single',$data);
    }

    public function edit($id)
    {
        $navbar_active = 'alat';
        $data['alkes'] = ItemsTemplate::find($id);
        $data['navbar_active'] = $navbar_active;
        return view('cssd.alkes.edit',$data);
    }

    public function printLabelSemua($id)
    {
        $alkes = AlkesSatuan::where('item_template_id',$id)->get();
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
