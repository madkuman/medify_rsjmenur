<?php

namespace App\Http\Controllers\Keuangan\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PenagihanBPJS;
use App\Models\Keuangan\PiutangPivot;
use App\Models\Keuangan\PiutangDetail;
use Auth;
use DB;
use Carbon\Carbon;

class EditController extends Controller
{
    public function update($id,$kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori_id,
        $tanggal_transaksi,$created_at,$updated_at,
        $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
        $kasus_tagihan_id,$perusahaan_id,$piutang_parent_id)
    {
        $user_id = Auth::user()->id;

        $piutang = Piutang::find($id);
        $piutang->kasir_id = $kasir_id;
        $piutang->judul = $judul;
        $piutang->jumlah = $jumlah;
        $piutang->diskon = $diskon;
        $piutang->total = $total;
        $piutang->pasien_id = $pasien_id;
        $piutang->pihak_ketiga = $pihak_3;
        $piutang->kategori_id = $kategori_id;
        $piutang->pasien_pembayaran_id = $pasien_pembayaran_id;
        $piutang->lokasi_id = $lokasi_id;
        $piutang->kasus_tagihan_id = $kasus_tagihan_id;
		$piutang->perusahaan_id = $perusahaan_id;
        $piutang->tanggal_transaksi = $tanggal_transaksi;
        $piutang->piutang_parent_id = $piutang_parent_id;
        if ($created_at != null) $piutang->created_at = $created_at;
        $piutang->updated_at = $updated_at;
        $piutang->created_by = $user_id;
        $piutang->save();

        //update or create detail
        foreach($transaksi_details as $item)
        {

            if($item->is_deleted){
                $detail = PiutangDetail::find($item->id_detail);
                $detail->delete();
            }
            else{
                $detail = PiutangDetail::firstOrNew(['id' => $item->id_detail]);
                $detail->piutang_id = $piutang->id;
                $detail->tarif_id = $item->tarif_id;
                $detail->kelas_id = $item->kelas_id;
                $detail->tarif_tipe_id = $item->tarif_tipe_id;
                $detail->deskripsi = $item->deskripsi;
                $detail->harga = $item->harga;
                $detail->diskon = $item->diskon;
                $detail->jumlah = $item->jumlah;
                $detail->subtotal = $item->subtotal;
                $detail->keterangan = $item->keterangan;
                $detail->created_by = $item->created_by;
                $detail->kategori_id = $item->kategori_id;
                $detail->lokasi_id = $item->lokasi_id;
                $detail->save();
            }
            
        }

        return $piutang;
    }

    public function split($id,$total,$new_split_id)
    {
        $user_id = Auth::user()->id;

        //create detail for new split
        $piutang_details = PiutangDetail::where('piutang_id', $id)->get();
        foreach($piutang_details as $item)
        {
            $detail = new PiutangDetail;
            $detail->piutang_id = $new_split_id;
            $detail->tagihan_id = $item->tagihan_id;
            $detail->departemen_id = $item->departemen_id;
            $detail->layanan_id = $item->layanan_id;
            $detail->layanan_string = $item->layanan_string;
            $detail->tarif_tipe_id = $item->tarif_tipe_id;
            $detail->kelas_id = $item->kelas_id;
            $detail->harga = $item->harga;
            $detail->diskon = $item->diskon;
            $detail->jumlah = $item->jumlah;
            $detail->subtotal = $item->subtotal;
            $detail->keterangan = $item->keterangan;
            $detail->created_by = $user_id;
            $detail->kategori_id = $item->kategori_id;
            $detail->save();
        }

        //substract parent total with split value
        $piutang = Piutang::find($id);
        $piutang->total = $piutang->total - (int)$total;
        $piutang->save();

        return $piutang;
    }

    public function kurangiTotalPaid($piutang_id,$total)
    {
        $piutang = Piutang::find($piutang_id);
        $piutang->total_paid = $piutang->total_paid - $total;
        $piutang->save();

        if($piutang->total_paid == 0)
        {
            if(!empty($piutang->kasus_tagihan_id))
                $tagihan_kasus = app('App\Http\Controllers\Kasus\Tagihan\EditController')->editPaid($piutang->kasus_tagihan_id,0); 
        }

        return $piutang;
    }

    public function updateTotal($piutang_id)
    {
        $piutang = Piutang::find($piutang_id);
        if(!empty($piutang->piutang_parent_id))
            $total_sister = Piutang::where('piutang_parent_id',$piutang->piutang_parent_id)->where('id','!=',$piutang->id)->sum('total');
        else
            $total_sister = 0;

        $diskon = 0;
        $jumlah = 0;
        $total = 0;
        foreach($piutang->detail as $item)
        {
            $item->subtotal = ceil(($item->harga * $item->jumlah) - $item->diskon);
            $item->save();

            $diskon+= $item->diskon;
            $jumlah+= ceil(($item->harga * $item->jumlah) - $item->diskon);
            $total+= $item->subtotal;
        }
        $piutang->diskon = $diskon;
        $piutang->jumlah = $jumlah;
        $piutang->total = $total - $total_sister;
        $piutang->save();
    }

    public function deleteDetailByKategori($piutang_id,$kategori_ids)
    {
        $detail = PiutangDetail::where('piutang_id',$piutang_id)->whereIn('kategori_id',$kategori_ids)->get();
        foreach($detail as $item)
        {
            $temp = PiutangDetail::find($item->id);
            $temp->delete();
        }
        $this->updateTotal($piutang_id);
        return 1;
    }

    public function updateDetailBpjs($penagihan_bpjs, $req)
    {
        foreach($penagihan_bpjs->piutang_pivot_detail as $p)
        {
            if(!isset($req['pivot_id']) || !in_array($p->id, $req['pivot_id']))
                $p->status = 0;
            else {
                $p->status = 1;
            }
            $p->save();
        }
    }

    public function preparePenagihan($paket, $req)
    {
        $now=Carbon::now();
        $total = 0;
        $piutang_ids = phparray_to_mysql($req->piutang_id);
        $kategori_bpjs = DB::connection('keuangan')->select(DB::raw('select d.kategori_bpjs_id, p.id as piutang_id, sum(d.subtotal) as total from piutang p, piutang_detail d where p.id in '.$piutang_ids.' and p.paket_penagihan_id is null and d.piutang_id=p.id and d.deleted_at is null and d.kategori_bpjs_id is not null group by d.kategori_bpjs_id, p.id;'));

        $total_kategori = $this->countTotalKategori($kategori_bpjs);

        foreach($kategori_bpjs as $count => $k)
        {
            $piutang = Piutang::find($k->piutang_id);
            $piutang->paket_penagihan_id = $paket->id;
            $piutang->tagihkan_at=$now;
            $piutang->save();

            if($count == 0 || $kategori_bpjs[$count-1]->kategori_bpjs_id != $k->kategori_bpjs_id)
            {
                $penagihan = PenagihanBPJS::where('paket_penagihan_id', $paket->id)->where('kategori_bpjs_id', $k->kategori_bpjs_id)->first();
     
                if(is_null($penagihan))
                {
                    $total += $total_kategori[$k->kategori_bpjs_id];

                    $penagihan = new PenagihanBPJS;
                    $penagihan->paket_penagihan_id = $paket->id;
                    $penagihan->kategori_bpjs_id = $k->kategori_bpjs_id;
                    $penagihan->total = $total_kategori[$k->kategori_bpjs_id];
                    $penagihan->perusahaan_id = $piutang->perusahaan_id;
                    $penagihan->save();
                } else {
                    $penagihan->total += $total_kategori[$k->kategori_bpjs_id];
                    $penagihan->save();
                }
            }

            $pivot = new PiutangPivot;
            $pivot->piutang_id = $k->piutang_id;
            $pivot->pasien_id = $piutang->pasien_id;
            $pivot->penagihan_bpjs_id = $penagihan->id;
            $pivot->total = $k->total;
            $pivot->save();

            $piutang_detail_ids = $piutang->detail->pluck('id')->toArray();
            PiutangDetail::whereIn('id', $piutang_detail_ids)->where('kategori_bpjs_id', $k->kategori_bpjs_id)->update(['piutang_pivot_id' => $pivot->id]);
        }

        return $total;
    }

    private function countTotalKategori($kategori_bpjs)
    {
        $total = [];
        foreach($kategori_bpjs as $k)
        {
            if(isset($total[$k->kategori_bpjs_id]))
                $total[$k->kategori_bpjs_id] += $k->total;
            else
                $total[$k->kategori_bpjs_id] = $k->total;
        }
        return $total;
    }
}