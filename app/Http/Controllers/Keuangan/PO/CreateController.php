<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\PODetail;
use Auth;

class CreateController extends Controller
{
    public function create($judul,$jumlah,$diskon,$total,$transaksi_details,$perusahaan_id,$tanggal_po,$no_po,$tanggal_spkktr,$no_spkktr,$tipe_po,$termin,$adendum,$faktur=null)
	{
		$user_id = Auth::user()->id;
		if(!isset($no_po) || $no_po == ""){
			$po_last = PO::orderBy('id', 'desc')->first();
			$bulan = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman(substr($tanggal_po, 5, 2));
			$tahun = substr($tanggal_po, 0, 4);
			$no_po = ($po_last->id+1).'/'.$bulan.'/BEKKES/'.$tahun;
		}

		if (!empty(PO::where('no_po', $no_po)->first())) {
			return "No PO sudah digunakan oleh PO lain. Silahkan ganti No PO.";
		}

		$po = new PO;
		$po->judul = $judul;
		$po->jumlah = $jumlah;
		$po->diskon = $diskon;
		$po->total = $total;
		$po->perusahaan_id = $perusahaan_id;
        $po->tanggal_po = $tanggal_po;
        $po->no_po = $no_po;
        if(!empty($tanggal_spkktr)) $po->tanggal_spkktr = $tanggal_spkktr;
        if(!empty($no_spkktr)) $po->no_spkktr = $no_spkktr;
        $po->jenis_po = $tipe_po;
        if ($total >= 200000000) {
        	$po->termin = $termin;
        	if (!empty($adendum)) $po->adendum = $adendum;
        }
        if(!empty($faktur)){
            $po->file_pendukung = $faktur;
        }
		$po->created_by = $user_id;
		$po->save();

		//create detail
		foreach($transaksi_details as $item)
		{
			$detail = new PODetail;
			$detail->po_id = $po->id;
			$detail->deskripsi = $item->layanan_string;
			if ($tipe_po == 'Farmasi') {
				$detail->item_gudang_id = $item->layanan_id;
			} else if ($tipe_po == 'Umum') {
				$detail->item_aset_id = $item->layanan_id;
			}
			
			$detail->harga = $item->harga;
			$detail->diskon = $item->diskon;
			$detail->jumlah = $item->jumlah;
			$detail->subtotal = $item->subtotal;
			$detail->keterangan = $item->keterangan;
			$detail->created_by = $user_id;
			$detail->save();
		}

		return $po;
	}
}
