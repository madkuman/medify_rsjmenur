<?php

namespace App\Http\Controllers\CSSD\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Paket;
use Carbon\Carbon;
use DNS1D;
use DOMPDF;

class ViewController extends Controller
{
	public function index()
	{
		$data['pakets'] = Paket::where('tipe', 'alkes')->get();
		return view('cssd.paket.index', $data);
	}

	public function edit($id)
	{
		$data['paket'] = Paket::findOrFail($id);
		$items = $data['paket']->paket_item;
		$item_data = [];
		foreach ($items as $item) {
			$temp = ['id' => $item->item_id, 'text' => $item->getItem->nama, 'jumlah' => $item->jumlah];
			$item_data[] = $temp;
		}

		$data['items'] = json_encode($item_data);
		return view('cssd.paket.edit', $data);
	}

	public function show($id)
	{
		$data['paket'] = Paket::findOrFail($id);
		$data['items'] = $data['paket']->paket_item;
		return view('cssd.paket.show', $data);
	}

	public function create()
	{
		return view('cssd.paket.create');
	}

	public function printLabel($id)
    {
        $alkes = Paket::where('id',$id)->get();
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
