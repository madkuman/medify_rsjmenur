<?php

namespace App\Http\Controllers\Keuangan\Utang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\PODetail;
use App\Models\Keuangan\AkunPJK;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($judul,$jumlah,$diskon,$total,$transaksi_details,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur)
    {
        $user_id = Auth::user()->id;

        if($no_faktur != "-" && $no_faktur != "0" && $no_faktur != "")
            $utang = Utang::where('no_faktur', $no_faktur)->where('perusahaan_id', $perusahaan_id)->first();
        else
            $utang = Utang::where('no_faktur', $no_faktur)->where('perusahaan_id', $perusahaan_id)->where('po_id', $id_po)->first();

        if(!isset($utang))
            $utang = new Utang;

        $utang->judul = $judul;
        $utang->jumlah = $jumlah;
        $utang->diskon = $diskon;
        $utang->total = $total;
        $utang->perusahaan_id = $perusahaan_id;
        $utang->tanggal_penerimaan = $tanggal_penerimaan;
        if(!empty($tanggal_faktur)) $utang->tanggal_faktur = $tanggal_faktur;
        if(!empty($tanggal_po)) $utang->tanggal_po = $tanggal_po;
        if(!empty($no_faktur)) $utang->no_faktur = $no_faktur;
        if(!empty($no_po)) $utang->no_po = $no_po;
        if(!empty($id_po)) $utang->po_id = $id_po;
        if(!empty($faktur)){
            $utang->photo_faktur = $faktur;
        }
        $utang->created_by = $user_id;
        $utang->save();

        //create detail
        foreach($transaksi_details as $index => $item)
        {
            $detail = new UtangDetail;
            $detail->jumlah = 0;
            $detail->subtotal = 0;

            if(count($utang->detail) > 0 && isset($utang->detail[$index])){
                $detail = $utang->detail[$index];
            }

            $detail->utang_id = $utang->id;
            if ($item->id_detail != 0) $detail->po_detail_id = $item->id_detail;
            $detail->deskripsi = $item->layanan_string;
            $detail->harga = $item->harga;
            $detail->diskon = $item->diskon;
            $detail->jumlah += $item->jumlah;
            $detail->subtotal += $item->subtotal;
            $detail->keterangan = $item->keterangan;
            $detail->created_by = $user_id;
            $detail->save();

            if ($item->id_detail != 0) {
                $po_detail = PODetail::find($item->id_detail);
                $po_detail->jumlah_processed = empty($po_detail->jumlah_processed) ? $item->jumlah : $po_detail->jumlah_processed+$item->jumlah;
                $po_detail->subtotal_processed = empty($po_detail->subtotal_processed) ? $item->subtotal : $po_detail->subtotal_processed+$item->subtotal;
                $po_detail->save();
            }
        }

        //update pjk_processed
        if (!empty($id_po)) {
            $pjk_processed = 0;
            $termin_processed = 0;
            $po = PO::with('penerimaan')->find($id_po);
            foreach ($po->penerimaan as $key => $value) {
                $pjk_processed += $value->total;
                $termin_processed += 1;
            }
            $po->pjk_processed = $pjk_processed;
            if(!empty($po->termin)) $po->termin_processed = $termin_processed;
            $po->save();
        }

        return $utang;
    }
}
