<?php

namespace App\Http\Controllers\Keuangan\Utang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\PODetail;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->id;
    	$utang = Utang::find($id);
        $po_id = $utang->po_id;

        if (!empty($po_id)) {
            $pjk_processed = 0;
            $termin_processed = 0;
            $detail_processed = [];
            $po = PO::with('penerimaan')->find($po_id);
            if (count($po->penerimaan) == 1) {
                foreach ($po->penerimaan as $key => $penerimaan) {
                    foreach ($penerimaan->detail as $detail) {
                        $detail_processed[$detail->po_detail_id] = [0, 0];
                    }
                }
                $utang->delete();
            } else {
                $utang->delete();
                $po = PO::with('penerimaan')->find($po_id);
                foreach ($po->penerimaan as $key => $penerimaan) {
                    $pjk_processed += $penerimaan->total;
                    $termin_processed += 1;
                    foreach ($penerimaan->detail as $detail) {
                        if ($key == 0) {
                            $detail_processed[$detail->po_detail_id] = [$detail->jumlah, $detail->subtotal];
                        } else {
                            $detail_processed[$detail->po_detail_id][0] += $detail->jumlah;
                            $detail_processed[$detail->po_detail_id][1] += $detail->subtotal;
                        }
                    }
                }
            }
            $po->pjk_processed = $pjk_processed;
            if(!empty($po->termin)) $po->termin_processed = $termin_processed;
            $po->save();
            foreach ($detail_processed as $po_detail_id => $value) {
                $po_detail = PODetail::find($po_detail_id);
                $po_detail->jumlah_processed = $value[0];
                $po_detail->subtotal_processed = $value[1];
                $po_detail->save();
            }
        }
        else {
            $utang->delete();
        }

        $data['url'] = 'keuangan/penerimaan/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'Penerimaan berhasil dihapus.';
        return json_encode($data);
    }

    public function deletePJK(Request $request)
    {
        $id = $request->id;
        $utang = Utang::find($id);
        if (!empty($utang->po_id)) {
            $utang->tanggal_transaksi = null;
            $utang->akun_pjk_id = null;
            $utang->tanggal_spkktr = null;
            $utang->tanggal_sprin = null;
            $utang->no_sprin = null;
            $utang->no_spkktr = null;
            $utang->no_pjk = null;
            $utang->nomorpjk = null;
            $utang->save();
        } else {
            $utang->delete();
        }
        

        $data['url'] = 'keuangan/pjk/';
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'PJK berhasil dihapus.';
        return json_encode($data);
    }
}

