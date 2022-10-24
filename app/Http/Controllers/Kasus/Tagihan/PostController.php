<?php

namespace App\Http\Controllers\Kasus\Tagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TagihanDetail;
use Carbon\Carbon;
use App\Models\Kasus\BPJSSEP;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifTipe;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\Departemen;
use App\Jobs\Keuangan\QueueGeneratePenagihan;
use DB;
use Bugsnag;

class PostController extends Controller
{
    public function checkout(Request $request, $nomor_kasus)
    {
        DB::connection('keuangan')->beginTransaction();
        DB::connection('kasus')->beginTransaction();
        try {
            ini_set('memory_limit', "2048M");
            ini_set('max_execution_time', "300");
            $kasus = Kasus::with(['pembayaran.perusahaan.tipe'])->where('nomor_kasus',$nomor_kasus)->first();
            $tagihan_id = $request->tagihan_id;
            $tagihan = Tagihan::with('kasus')->where('id',$tagihan_id)->first();
            $tagihan->total_bill = TagihanDetail::where('kasus_tagihan_id',$tagihan_id)->sum('subtotal');
            $tagihan->save();
            
            $jumlah = $tagihan->total_bill;
            $diskon = 0;
            $total = $tagihan->total_bill;
            $pasien_id = $tagihan->kasus->pasien_id;
            $kasir_id = $request->kasir_tujuan;
            $created_at = $tagihan->created_at;
            $updated_at = $tagihan->updated_at;
            $tanggal = Carbon::now();
            $transaksi = TagihanDetail::where('kasus_tagihan_id',$tagihan_id)->get();
            $is_split = $request->split_piutang;

            $lokasiNow = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($kasus->lokasi->lokasi->id);
            $kategori_id = $lokasiNow->kategori_keuangan_id;
            $keterangan = app('App\Http\Controllers\Kasus\Kasus\ReadController')->getKeteranganPembayaran($kasus->id);

            foreach ($transaksi as $trans) {
                $lokasi_temp = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasi($trans->lokasi_id);

                $trans->tagihan_id = $trans->kasus_tagihan_id;
                $trans->layanan_id = $trans->tarif_id;
                $trans->layanan_string = $trans->desc;
                $trans->departemen_id = $trans->departemen_id;
                $trans->tipe = $trans->tarif_tipe_id;
                $trans->kelas = $tagihan->kasus->kelas->nama;
                $trans->kelas_id = $trans->tarif_kelas_id;
                $trans->harga = $trans->unit_price;
                $trans->diskon = 0;
                $trans->keterangan = "";
                $trans->jumlah = $trans->qty;
                $trans->lokasi = $trans->lokasi_id;
                $trans->kategori = $lokasi_temp->kategori_keuangan_id;
            }

            /*
            if($tagihan->kasus->lokasi->lokasi->departemen->id == 3)//jika lokasi departemen rawat inap
            {
                $tagihanAdminRanap = $this->tambahAdministrasiRawatInap($tagihan_id,$kasus->sep_id);
                $transaksi->push($tagihanAdminRanap);
                $total += $tagihanAdminRanap->subtotal;
                $jumlah = $total;
            }*/

            $sep = '';
            if(!empty($kasus->sep_id))
            {
                if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
                {
                    //UPDATE PLAFON INACBG
                    if(isset($kasus->active_sep->no_sep))
                        app('App\Http\Controllers\Kasus\Kasus\PostController')->autoUpdatePlafon($kasus);

                    $sep = BPJSSEP::find($kasus->sep_id);
                    if(!empty($sep->id)){
                        if($sep->total_plafon > 0){
                            $tagihanSEP = $this->hitungKeuntunganKerugian($kasus->id,$kasus->sep_id,$transaksi,$tagihan_id);
                            if($tagihanSEP->kasus_tagihan_id != 0) {
                                $transaksi->push($tagihanSEP);
                                $total = $sep->total_plafon;
                                $jumlah = $total;
                            }
                        }
                        $sep = ' - SEP '.$kasus->active_sep->no_sep;
                    }
                    else $sep = '- SEP - Tidak Diketahui';
                }
            }

            $asal_layanan = $tagihan->kasus->lokasi->lokasi->departemen->nama;
            
            $tipe_bayar = $kasus->pembayaran->perusahaan->nama;
           
            $judul = 'Tagihan '.$tipe_bayar.' - '.$tagihan->kasus->pasien->name.' - RM '.$tagihan->kasus->pasien->no_rm.' - '.$kasus->pembayaran->no_asuransi.$sep;
            $diskon = 0;
            $pasien_id = $pasien_id;
            $pihak_3 = $kasus->pembayaran->perusahaan->nama;
            $kategori_id = $kasus->lokasi->lokasi->id;
            $tanggal_transaksi = $tanggal;
            $transaksi_details = $transaksi;
            $pasien_pembayaran_id = $kasus->pembayaran->id;
            $lokasi_id = $kasus->lokasi->lokasi->id;
            $kategori_bpjs_id = $kasus->lokasi->lokasi->kategori_bpjs_id;
            $kasus_tagihan_id = $tagihan_id;
            $perusahaan_id = $kasus->pembayaran->perusahaan->perusahaan_keuangan_id;

            $transaksi_piutang = app('App\Http\Controllers\Keuangan\Piutang\CreateController')->create($kasir_id,$judul,$jumlah,$diskon,$total,$pasien_id,$pihak_3,$kategori_id,$tanggal_transaksi,$created_at,$updated_at,$transaksi_details,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$perusahaan_id,$keterangan,null, $kategori_bpjs_id);

            $checkout = app('App\Http\Controllers\Kasus\Tagihan\EditController')->checkout($tagihan_id);

            $status = 1;
            $message = 'Tagihan berhasil di checkout';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();
            DB::connection('kasus')->commit();

            if($kasus->pembayaran->perusahaan->tipe->slug == 'bpjs')
                 QueueGeneratePenagihan::dispatch(['piutang_id' => $transaksi_piutang->id])
                 ->delay(now()->addSeconds(45));

            if (empty($request->from_scheduler)) {
                return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            } else {
                return $status;
            }

        }
        catch (\Exception $e) {
            
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Tagihan gagal di checkout';
            $title = 'Gagal!';

            DB::connection('keuangan')->rollback();
            DB::connection('kasus')->rollback();
            
            if (empty($request->from_scheduler)) {
                return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            } else {
                return $status;
            }
        }

    }

    public function syncSEP(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        try {
            $tagihan_detail = TagihanDetail::where('kasus_tagihan_id',$request->id)->get();
            $kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
            $sep_id = $kasus->sep_id;
            foreach($tagihan_detail as $item)
            {
                if($item->sep_id != $sep_id)
                {
                    $detail = TagihanDetail::find($item->id);
                    $detail->sep_id = $sep_id;
                    $detail->save();
                }
            }
            DB::connection('kasus')->commit();

            $status = 1;
            $message = 'Tagihan berhasil di sinkronisasi';
            $title = 'Berhasil!';
        }
        catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Tagihan gagal di sinkronisasi';
            $title = 'Gagal!';

            DB::connection('kasus')->rollback();
        }

        return back()
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    private function tambahAdministrasiRawatInap($kasus_tagihan_id,$sep_id)
    {
        $tagihan = Tagihan::find($kasus_tagihan_id);
        $kasus = $tagihan->kasus;
        $tarif_admin = TarifMaster::where('slug','administrasi-rawat-inap-akhir')->first();
        $tipe_default = TarifTipe::where('slug','default')->first();
        $persen = 5;
        $kategori_tanpa_farmasi = Kategori::where('slug','!=','farmasi')->orWhereNull('slug')->pluck('id')->toArray();
        $kategori_admin = Kategori::where('slug','administrasi')->first();
        if(!empty($tarif_admin->id)){
            $tarif = Tarif::where('tarif_master_id',$tarif_admin->id)->where('tipe_id',$tipe_default->id)->first(); 
            $total_administrasi_ranap = TagihanDetail::where('kasus_tagihan_id',$kasus_tagihan_id)->whereIn('kategori_id',$kategori_tanpa_farmasi)->sum('subtotal');//mencari transaksi yang bukan farmasi
            $total_administrasi_ranap = $total_administrasi_ranap*$persen/100;
            if($total_administrasi_ranap > 500000) $total_administrasi_ranap = 500000;
            if(!empty($tarif->id))
            {
                $lokasi_admin = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getSingleLokasiSlug('administrasi');

                $adminRanap = new TagihanDetail;
                $adminRanap->kasus_tagihan_id = $kasus_tagihan_id;
                $adminRanap->tarif_id = $tarif->id;
                $adminRanap->deskripsi = $tarif_admin->deskripsi;
                $adminRanap->lokasi_id = $lokasi_admin->id;
                $adminRanap->kategori_id = $kategori_admin->id;
                $adminRanap->tarif_tipe_id = $tipe_default->id;
                $adminRanap->tarif_kelas_id = $kasus->kelas->id;
                $adminRanap->harga = $total_administrasi_ranap;
                $adminRanap->diskon = 0;
                $adminRanap->jumlah = 1;
                $adminRanap->subtotal = $total_administrasi_ranap;
                $adminRanap->keterangan = "";
                $adminRanap->sep_id = $sep_id;
                $adminRanap->created_at = Carbon::now();
                $adminRanap->updated_at = Carbon::now();
                return $adminRanap;
            }
            else
            {
                abort(500,'Tidak ditemukan Tarif Administrasi Rawat Inap');
            }

        }
        else
        {
            abort(500,'Tidak ditemukan Tarif Administrasi Rawat Inap');
        }


    }

    private function hitungKeuntunganKerugian($kasus_id,$sep_id,$transaksi,$tagihan_id)
    {
        $sep = BPJSSEP::find($sep_id);
        $tagihan = Tagihan::find($tagihan_id);
        $total_tagihan_sep = $transaksi->where('sep_id',$sep_id)->sum('subtotal');
        $sisa = $sep->total_plafon - $total_tagihan_sep;
        $kasus = Kasus::find($kasus_id);
        $kategori_admin = Kategori::where('slug','administrasi')->first();
        $tipe_default = TarifTipe::where('slug','default')->first();
        if ($sisa>0) {

            $tarif_kategori = TarifKategori::where('slug','selisih-biaya-untung')->first();
            $tarif_master = TarifMaster::where('kategori_id',$tarif_kategori->id)->first();
            $tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first(); 
            $kategori = Kategori::where('slug','selisih-biaya-untung')->first();
        }elseif($sisa<0){
            $tarif_kategori = TarifKategori::where('slug','selisih-biaya-rugi')->first();
            $tarif_master = TarifMaster::where('kategori_id',$tarif_kategori->id)->first();
            $tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe_default->id)->first(); 
            $kategori = Kategori::where('slug','selisih-biaya-rugi')->first();
        }
        else{
            $is_hutang = '';
            $tarif_id = 0;
        }

        if($sisa != 0){
            $sisaDB = new TagihanDetail;
            $sisaDB->kasus_tagihan_id = $tagihan_id;
            $sisaDB->tarif_id = $tarif->id;
            $sisaDB->deskripsi = $tarif_master->deskripsi;
            $sisaDB->lokasi_id = $kasus->lokasi->lokasi->kategori_keuangan_id;
            $sisaDB->kategori_id = $kategori->id;
            $sisaDB->tarif_tipe_id = $tipe_default->id;
            $sisaDB->tarif_kelas_id = $kasus->kelas->id;
            $sisaDB->harga = $sisa;
            $sisaDB->diskon = 0;
            $sisaDB->jumlah = 1;
            $sisaDB->subtotal = $sisa;
            $sisaDB->keterangan = "";
            $sisaDB->sep_id = $sep_id;
            $sisaDB->created_at = Carbon::now();
            $sisaDB->updated_at = Carbon::now();
        }
        else
        {
            $sisaDB = new TagihanDetail;
            $sisaDB->kasus_tagihan_id = 0;
        }

        return $sisaDB;
    }

    public function split(Request $request,$nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        try {
            $data['tanggal_awal'] = Carbon::parse($request->tanggal_awal)->startOfDay();
            $data['tanggal_akhir'] = Carbon::parse($request->tanggal_akhir)->endOfDay();
            $tagihan = Tagihan::where('id',$request->id)->with(['detail'=> function ($q) use($data){
                $q->whereBetween('created_at',[$data['tanggal_awal'],$data['tanggal_akhir']]);
            }])->first();

            if($tagihan->checkout) {
                $pemasukan = $tagihan->piutang->pemasukan ?? [];

                #cek jika ada pemasukan maka tidak boleh batal checkout
                if (count($pemasukan) > 0) {
                    $status = 'error';
                    $message = 'Sudah terdapat pemasukan piutang.';
                    $title = 'Gagal!';

                    return back()
                        ->with('message', $message)
                        ->with('title', $title)
                        ->with('status', $status);
                }

                app('App\Http\Controllers\Keuangan\Piutang\DeleteController')->deleteKasusTagihan($tagihan->id);
                app('App\Http\Controllers\Kasir\Transaksi\DeleteController')->deleteKasusTagihan($tagihan->id);
                $tagihan->checkout = null;
                $tagihan->checkout_at = null;
                $tagihan->save();
            }
            $new_tagihan = collect($tagihan)->except(['id','created_at','updated_at','deleted_at','piutang','detail'])->toArray();
            $new_tagihan_id = DB::connection('kasus')->table('tagihan')->insertGetId($new_tagihan);

            foreach ($tagihan->detail as $item)
            {
                $item->kasus_tagihan_id = $new_tagihan_id;
                $item->save();
            }
            DB::connection('kasus')->commit();

            $status = 1;
            $message = 'Tagihan berhasil displit';
            $title = 'Berhasil!';
        }
        catch (\Exception $e) {

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = 'Tagihan gagal displit';
            $title = 'Gagal!';

            DB::connection('kasus')->rollback();
        }
        return redirect('/kasus/'.$nomor_kasus.'/tagihan')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
    }
}
