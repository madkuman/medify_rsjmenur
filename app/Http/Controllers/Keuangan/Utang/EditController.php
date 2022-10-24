<?php

namespace App\Http\Controllers\Keuangan\Utang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\PODetail;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\AkunPJK;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function update($id,$judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur)
    {
        $user_id = Auth::user()->id;

        $utang = Utang::find($id);
        $utang->judul = $judul;
        $utang->jumlah = $jumlah;
        $utang->diskon = $diskon;
        $utang->total = $total;
        $utang->perusahaan_id = $perusahaan_id;
        $utang->tanggal_penerimaan = $tanggal_penerimaan;
        if (!empty($tanggal_faktur) && $tanggal_faktur != "undefined") $utang->tanggal_faktur = $tanggal_faktur;
        if (!empty($tanggal_po) && $tanggal_po != "undefined") $utang->tanggal_po = $tanggal_po;
        if (!empty($no_faktur) && $no_faktur != "undefined") $utang->no_faktur = $no_faktur;
        if (!empty($no_po) && $no_po != "undefined") $utang->no_po = $no_po;
        if (!empty($id_po) && $id_po != "undefined") $utang->po_id = $id_po;
        if (!empty($faktur)){
            $utang->photo_faktur = $faktur;
        }
        $utang->created_by = $user_id;
        $utang->save();

        //seed nomorpjk column
        $utang->nomorpjk = $utang->nomor_pjk;
        $utang->save();

        //update or create detail
        foreach($transaksi as $item)
        {

            if(isset($item->is_deleted)){
                if ($item->is_deleted) {
                    $detail = UtangDetail::find($item->id_detail);
                    $detail->delete();
                } else {
                    $detail = UtangDetail::firstOrNew(['id' => $item->id_detail]);
                    $detail->utang_id = $utang->id;
                    $detail->deskripsi = $item->layanan_string;
                    $detail->harga = $item->harga;
                    $detail->diskon = $item->diskon;
                    $detail->jumlah = $item->jumlah;
                    $detail->subtotal = $item->subtotal;
                    $detail->keterangan = $item->keterangan;
                    $detail->created_by = $user_id;
                    $detail->save();
                }
            }
            else{
                $detail = UtangDetail::firstOrNew(['id' => $item->id_detail]);
                $detail->utang_id = $utang->id;
                $detail->deskripsi = $item->layanan_string;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->jumlah = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $user_id;
                $detail->save();
            }
            
        }

        //update pjk_processed
        if(!empty($utang->po_id)){
            $pjk_processed = 0;
            $detail_processed = [];
            $po = PO::with('penerimaan')->find($utang->po_id);
            foreach ($po->penerimaan as $key => $value) {
                $pjk_processed += $value->total;
                foreach ($value->detail as $detail) {
                    if ($key == 0) {
                        $detail_processed[$detail->po_detail_id] = [$detail->jumlah, $detail->subtotal];
                    } else {
                        $detail_processed[$detail->po_detail_id][0] += $detail->jumlah;
                        $detail_processed[$detail->po_detail_id][1] += $detail->subtotal;
                    }
                }
            }
            $po->pjk_processed = $pjk_processed;
            $po->save();
            foreach ($detail_processed as $po_detail_id => $value) {
                $po_detail = PODetail::find($po_detail_id);
                $po_detail->jumlah_processed = $value[0];
                $po_detail->subtotal_processed = $value[1];
                $po_detail->save();
            }
        }

        return $utang;
    }

    public function updateMultiSource($id, $judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur)
    {
        $user_id = Auth::user()->id;
        $utang_lama = Utang::find($id);
        if($utang_lama && $utang_lama->no_faktur != $no_faktur){
            $utang_changed = true;
            $utang = Utang::where('no_faktur', $no_faktur)->where('po_id', $id_po)->first();
            if(!isset($utang)){
                $utang_new = 1;
                $utang = app('App\Http\Controllers\Keuangan\Utang\CreateController')->create($judul,$jumlah,$diskon,$total,$transaksi,$perusahaan_id,$tanggal_penerimaan,$tanggal_faktur,$tanggal_po,$no_faktur,$no_po,$id_po,$faktur);
            }
        }else{
            $utang_changed = false;
            $utang = $utang_lama;
        }

        $utang->judul = $judul;
        $utang->perusahaan_id = $perusahaan_id;
        $utang->tanggal_penerimaan = $tanggal_penerimaan;
        if (!empty($tanggal_faktur) && $tanggal_faktur != "undefined") $utang->tanggal_faktur = $tanggal_faktur;
        if (!empty($tanggal_po) && $tanggal_po != "undefined") $utang->tanggal_po = $tanggal_po;
        if (!empty($no_faktur) && $no_faktur != "undefined") $utang->no_faktur = $no_faktur;
        if (!empty($no_po) && $no_po != "undefined") $utang->no_po = $no_po;
        if (!empty($id_po) && $id_po != "undefined") $utang->po_id = $id_po;
        if (!empty($faktur)){
            $utang->photo_faktur = $faktur;
        }
        $utang->created_by = $user_id;
        $utang->save();

        //update or create detail
        $details = $utang->detail;
        $jumlah = 0;
        $total = 0;
        foreach($transaksi as $i => $item)
        {
            if(isset($utang_new)){
                $jumlah = $utang->jumlah;
                $total = $utang->total;
                continue;
            }

            if(isset($item->is_deleted)){
                if ($item->is_deleted) {
                    $detail = UtangDetail::find($item->id_detail);
                    $detail->delete();
                } else {
                    if($utang_changed){
                        $detail = $details[$i];
                    }else{
                        $detail = UtangDetail::find($item->id_detail_utang);
                        if(!isset($detail))
                            $detail = new UtangDetail;
                    }
                    $detail->utang_id = $utang->id;
                    $detail->deskripsi = $item->layanan_string;
                    $detail->harga = $item->harga;
                    $detail->diskon = $item->diskon;
                    $detail->jumlah += $item->jumlah;
                    $detail->subtotal += $item->subtotal;
                    $detail->keterangan = $item->keterangan;
                    $detail->created_by = $user_id;
                    $detail->save();

                    $jumlah += $detail->jumlah * $detail->harga;
                    $total += $detail->subtotal;
                }
            }
            else{
                if($utang_changed){
                    $detail = $details[$i];
                }else{
                    $detail = UtangDetail::find($item->id_detail_utang);
                    if(!isset($detail))
                        $detail = new UtangDetail;
                }
                $detail->utang_id = $utang->id;
                $detail->deskripsi = $item->layanan_string;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->jumlah += $item->jumlah;
                $detail->subtotal += $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $user_id;
                $detail->save();

                $jumlah += $detail->jumlah * $detail->harga;
                $total += $detail->subtotal;
            }
            
        }


        $utang->jumlah = $jumlah;
        $utang->total = $total;
        $utang->diskon = $jumlah - $total;
        $utang->save();

        if($utang_changed){
            $req = new Request;
            $req->merge(['id'=> $utang_lama->id]);
            app('App\Http\Controllers\Keuangan\Utang\DeleteController')->delete($req);
        }
        //update pjk_processed
        if(!empty($utang->po_id)){
            $pjk_processed = 0;
            $detail_processed = [];
            $po = PO::with('penerimaan')->find($utang->po_id);
            foreach ($po->penerimaan as $key => $value) {
                $pjk_processed += $value->total;
                foreach ($value->detail as $detail) {
                    if ($key == 0) {
                        $detail_processed[$detail->po_detail_id] = [$detail->jumlah, $detail->subtotal];
                    } else {
                        $detail_processed[$detail->po_detail_id][0] += $detail->jumlah;
                        $detail_processed[$detail->po_detail_id][1] += $detail->subtotal;
                    }
                }
            }
            // dd($detail_processed);
            $po->pjk_processed = $pjk_processed;
            $po->save();
            foreach ($detail_processed as $po_detail_id => $value) {
                $po_detail = PODetail::find($po_detail_id);
                $po_detail->jumlah_processed = $value[0];
                $po_detail->subtotal_processed = $value[1];
                $po_detail->save();
            }
        }
        return $utang;
    }

    public function PJK($id_utang,$judul,$jumlah,$diskon,$total,$transaksi_details,$perusahaan_id,$akun_pjk_id,$tanggal_pjk,$tanggal_spkktr,$tanggal_sprin,$tanggal_faktur,$tanggal_po,$no_spkktr,$no_sprin,$no_faktur,$no_po)
    {
        // dd($id_po, $tanggal_po, $no_po);
        $user_id = Auth::user()->id;
        $date = Carbon::parse($tanggal_pjk);
        $pjk_last = Utang::whereYear('tanggal_transaksi', $date->year)->where('akun_pjk_id', $akun_pjk_id)->withTrashed()->orderBy('no_pjk','desc')->first();
        if(!empty($pjk_last->no_pjk))
        {
            $no_pjk = $pjk_last->no_pjk+1;
        }
        else
        {
            $no_pjk = 1;
        }

        $utang = !empty($id_utang) ? Utang::find($id_utang) : new Utang;
        $utang->judul = $judul;
        $utang->jumlah = $jumlah;
        $utang->diskon = $diskon;
        $utang->total = $total;
        $utang->perusahaan_id = $perusahaan_id;
        if($akun_pjk_id != $utang->akun_pjk_id){
            $utang->akun_pjk_id = $akun_pjk_id;
            $utang->no_pjk = $no_pjk;
        }
        $utang->tanggal_transaksi = $tanggal_pjk;
        if(!empty($tanggal_spkktr)) $utang->tanggal_spkktr = $tanggal_spkktr;
        if(!empty($tanggal_sprin)) $utang->tanggal_sprin = $tanggal_sprin;
        if(!empty($tanggal_faktur)) $utang->tanggal_faktur = $tanggal_faktur;
        if(!empty($tanggal_po)) $utang->tanggal_po = $tanggal_po;
        if(!empty($no_spkktr)) $utang->no_spkktr = $no_spkktr;
        if(!empty($no_sprin)) $utang->no_sprin = $no_sprin;
        if(!empty($no_faktur)) $utang->no_faktur = $no_faktur;
        if(!empty($no_po)) $utang->no_po = $no_po;
        $utang->created_by = $user_id;
        $utang->save();

        //seed nomorpjk column
        $utang->nomorpjk = $utang->nomor_pjk;
        $utang->save();

        //create/edit detail
        if (empty($utang->po_id)) {
            foreach($transaksi_details as $item)
            {
                if(isset($item->is_deleted)){
                    if ($item->is_deleted) {
                        $detail = UtangDetail::find($item->id_detail);
                        $detail->delete();
                    } else {
                        $detail = UtangDetail::firstOrNew(['id' => $item->id_detail]);
                        $detail->utang_id = $utang->id;
                        $detail->deskripsi = $item->layanan_string;
                        $detail->harga = $item->harga;
                        $detail->diskon = $item->diskon;
                        $detail->jumlah = $item->jumlah;
                        $detail->subtotal = $item->subtotal;
                        $detail->keterangan = $item->keterangan;
                        $detail->created_by = $user_id;
                        $detail->save();
                    }
                }
                else{
                    $detail = UtangDetail::firstOrNew(['id' => $item->id_detail]);
                    $detail->utang_id = $utang->id;
                    $detail->deskripsi = $item->layanan_string;
                    $detail->harga = $item->harga;
                    $detail->diskon = $item->diskon;
                    $detail->jumlah = $item->jumlah;
                    $detail->subtotal = $item->subtotal;
                    $detail->keterangan = $item->keterangan;
                    $detail->created_by = $user_id;
                    $detail->save();
                }
            }
        }

        //initialize transaksi file
        if(count($utang->file_transaksi) == 0)
            $transaksi = app('App\Http\Controllers\Keuangan\TransaksiFile\PostController')->initialize($utang->id);

        return $utang;
    }

    public function SPP($id,$tanggal_spp,$kategori_id,$tahun_anggaran)
    {
        $user_id = Auth::user()->id;

        $utang = Utang::find($id);
        if(is_null($kategori_id)){
            $utang->tanggal_spp = null;
            $utang->kategori_id = null;
            $utang->tahun_anggaran = null;
        }
        else{
            if(!is_null($tanggal_spp)){
                $spp_last = Utang::whereNotNull('tanggal_spp')->withTrashed()->orderBy('no_spp','desc')->first();
                if(!empty($spp_last->no_spp))
                {
                    $no_spp = $spp_last->no_spp+1;
                }
                else
                {
                    $no_spp = 1;
                }
                $utang->tanggal_spp = $tanggal_spp;
                $utang->no_spp = $no_spp;
            }
            $utang->kategori_id = $kategori_id;
            $utang->tahun_anggaran = $tahun_anggaran;
        }
        $utang->created_by = $user_id;
        $utang->save();

        return $utang;
    }

    public function paySPP($utang_id,$total_paid){

        $utang = Utang::find($utang_id);
        if ($utang->total > $utang->total_paid) {
            $paid = $utang->total_paid;
            $utang->total_paid = $paid + $total_paid;
            $utang->save();
        }
    
        return $utang;
    }

    public function addNoSE($utang_id,$no_se){

        $utang = Utang::find($utang_id);
        $utang->no_se = $no_se;
        $utang->save();
    
        return $utang;
    }
}
