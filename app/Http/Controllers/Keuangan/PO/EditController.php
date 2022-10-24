<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\PODetail;
use Auth;

class EditController extends Controller
{
    public function update($id,$judul,$jumlah,$diskon,$total,$transaksi_details,$perusahaan_id,$tanggal_po,$no_po,$tanggal_spkktr,$no_spkktr,$termin,$adendum)
	{
		$user_id = Auth::user()->id;

		$po = PO::find($id);
		$po->judul = $judul;
		$po->jumlah = $jumlah;
		$po->diskon = $diskon;
		$po->total = $total;
		$po->perusahaan_id = $perusahaan_id;
        $po->tanggal_po = $tanggal_po;
        $po->no_po = $no_po;
        if(!empty($tanggal_spkktr)) $po->tanggal_spkktr = $tanggal_spkktr;
        if(!empty($no_spkktr)) $po->no_spkktr = $no_spkktr;
        if ($total >= 200000000) {
        	$po->termin = $termin;
        	if (!empty($adendum)) $po->adendum = $adendum;
        }
		$po->created_by = $user_id;
		$po->save();
		//create detail
		foreach($transaksi_details as $item)
		{
			if($item->is_deleted){
                $detail = PODetail::find($item->id_detail);
                $detail->delete();
            }
            else{
                $detail = PODetail::firstOrNew(['id' => $item->id_detail]);
                $detail->po_id = $po->id;
                $detail->deskripsi = $item->layanan_string;
                if ($po->jenis_po == 'Farmasi') {
					$detail->item_gudang_id = $item->layanan_id;
				} else if ($po->jenis_po == 'Umum') {
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
		}

		return $po;
	}

	public function processDetail($id, $processed)
	{	
        $details = PODetail::where('po_id', $id)->get();
        foreach ($details as $key => $detail) {
	        $detail->jumlah_processed += $processed[$key];
	        $detail->save();
        }
	}
}
