<?php

namespace App\Http\Controllers\Kasir\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Transaksi;
use App\Models\Kasir\Tagihan;
use App\Models\Kasir\TagihanDetail;
use App\Models\Keuangan\Deposit;

use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatJalan\Transaksi as IRJTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatInap\TempatTidur;
use Auth;
use DB;
use Carbon\Carbon;

class PostController extends Controller
{
    public function apiSubmit(Request $request)
    {      
        //dd($request);
        $id = $request->id;
        $kasir_id = $request->kasir_id;
        $judul = $request->judul;
        $pasien_id = $request->pasien_id;
        $pihak_ketiga = $request->pihak_3;
        $tanggal = $request->tanggal;
        $kategori_id = $request->kategori;
        $pasien_pembayaran_id = $request->pasien_pembayaran_id;
        $lokasi_id = $request->lokasi_id;
        $perusahaan_id = $request->perusahaan_id;
        $jumlah = $request->alljumlah;
        $diskon = $request->alldiskon;
        $total = $request->alltotal;
        $kasus_tagihan_id = $request->kasus_tagihan_id;
        $kasus_id = $request->kasus_id;
        $akun_id = $request->akun_id;
        $asal_layanan = $request->asal_layanan;
        $transaksi = $request->transaksi;
        $created_at = $request->created_at;
        $updated_at = $request->updated_at;
        $transaksi = json_decode($transaksi);
        //dd($transaksi);
        if(empty($request->dp))
        {
            $tanggal = Carbon::createFromFormat('d-m-Y', $tanggal, 'Asia/Jakarta');
        }
        else
        {
            $tanggal = Carbon::now();
        }
        try {
            DB::connection('kasir')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            if(is_null($id))
            {   
                if(!empty($request->dp))
                {   
                    //dd("masuk dp");
                    $transaksi = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->create
                    ($jumlah,$diskon,$total,$pasien_id,$judul,$kasir_id,$asal_layanan,
                    Carbon::now(),Carbon::now(),$transaksi,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$pihak_ketiga,
                    $perusahaan_id,$kategori_id,$akun_id,$kasus_id,$request->dp,$request->kelas);
                    //dd($transaksi,$deposit);
                }
                else
                {
                    $transaksi = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->create
                    ($jumlah,$diskon,$total,$pasien_id,$judul,$kasir_id,$asal_layanan,
                    $created_at,$updated_at,$transaksi,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$pihak_ketiga,
                    $perusahaan_id,$kategori_id,$akun_id,$kasus_id);
                }
            }
            else
            {
                $pemasukan = app('App\Http\Controllers\Keuangan\Pemasukan\DeleteController')->deletePemasukanByTagihanID($id);
                $tagihan_detail = app('App\Http\Controllers\Kasir\Transaksi\EditController')->undoIsPaid($id);
                $transaksi = app('App\Http\Controllers\Kasir\Transaksi\EditController')
                ->update($id,$jumlah,$diskon,$total,$pasien_id,$judul,$kasir_id,$asal_layanan,
                    $created_at,$updated_at,$transaksi,$pasien_pembayaran_id,$lokasi_id,$kasus_tagihan_id,$pihak_ketiga,
                    $perusahaan_id,$kategori_id,$akun_id,$kasus_id);
            }
            if(empty($request->dp))
            {
                $data['type'] = 'success';
                $data['title'] = 'Berhasil';
                $data['text'] = 'Transaksi Tagihan Berhasil Dibuat';
                $data['url'] = 'kasir/'.$transaksi->kasir_id.'/transaksi/invoice/'.$transaksi->id;
    
            }
            DB::connection('kasir')->commit();
            DB::connection('keuangan')->commit();
            if(!empty($request->from_kasir))
            {
                $status = 1;
                $message = 'Permintaan DP baru berhasil dibuat!';
                $title = 'Berhasil!';

                return redirect('/kasir/'.$kasir_id.'/transaksi')
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            }
            if(!empty($request->dp))
            {
                $status = 1;
                $message = 'Permintaan DP baru berhasil dibuat!';
                $title = 'Berhasil!';

                return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);
            }
        } catch (\Exception $e) {
            DB::connection('kasir')->rollback();
            DB::connection('keuangan')->rollback();
            dd($e);
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Tagihan Gagal Dibuat : Kesalahan Server, silahkan hubungi admin';
            $data['url'] = 0;
        }

        return json_encode($data);
    }


    public function pay(Request $request)
    {   
        //dd($request);
        try {
            DB::connection('kasir')->beginTransaction();
            DB::connection('keuangan')->beginTransaction();
            $tagihan_id = $request->id;
            if($request->pakai_deposit == "on")
            {
                $total_bayar = $request->total_paid + $request->uang_deposit;    
            }
            else
            {
                $total_bayar = $request->total_paid;
            }
            //dd($total_bayar);
            $total_piutang = $request->total_piutang;
            $pasien_pembayaran_id = $request->pasien_pembayaran_id;
            $perusahaan_id = $request->perusahaan_id;
            $penanggungjawab = $request->penanggungjawab;
            $akun_id = $request->akun_id;
            $is_dp = $request->is_dp;
            $pakai_deposit = $request->pakai_deposit;
            //dd($pakai_deposit);
            $tagihan = Tagihan::find($tagihan_id);
            $tagihan->total_paid = $tagihan->total_bayar + $total_bayar;
            $tagihan->updated_by = Auth::user()->id;
            $tagihan->paid_date = Carbon::now();
            $tagihan->akun_id = $akun_id;
            $pasien_id = $tagihan->pasien_id;
            $tagihan->save();

            if($pakai_deposit == "on")
            {   
                //dd("123");
                $log = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->logDeposit($total_bayar,$tagihan_id,$pasien_id);
                $deposit = app('App\Http\Controllers\Kasir\Transaksi\EditController')->kurangiDeposit($pasien_id);
                //dd($log,$deposit);
            }
            //dd("keluar");
            $total_tagihan = 0;
            $tagihan = Tagihan::find($tagihan_id);
            //dd($tagihan->detail);
            foreach($tagihan->detail as $item){
                if(!$item->is_paid){
                    $total_tagihan = $total_tagihan + ($item->unit_price * $item->qty);
                }
            }    

            $judul = $tagihan->judul;

            if($total_piutang > 0){
                $diskon_piutang = (100 - (($total_piutang * 100) / $total_tagihan));
                if($total_bayar>0)
                    $diskon_pemasukan = (100 - (($total_bayar * 100) / $total_tagihan));

                $tagihan = Tagihan::find($tagihan_id);
                foreach($tagihan->detail as $item){
                    if(!$item->is_paid){
                        $subtotal_piutang = $item->unit_price*$item->qty*((100-$diskon_piutang)/100);
                        $transaksi_detail_piutang[] = (object) array(
                            'layanan_id'=> $item->tarif_id,
                            'departemen_id' => $item->departemen_id,
                            'tagihan_id' => $item->tagihan_id,
                            'layanan_string'=> $item->desc,
                            'tipe'=> $item->tarif_tipe_id,
                            'kelas'=> $item->tarif_kelas,
                            'harga'=> $item->unit_price,
                            'diskon'=> $diskon_piutang,
                            'jumlah'=> $item->qty,
                            'subtotal'=> $subtotal_piutang,
                            'created_at' => null,
                            'updated_at' => null,
                            'kategori' => $item->kategori_id,
                            'keterangan' => null);

                        if($total_bayar>0){
                            $subtotal_pemasukan = $item->unit_price*$item->qty*((100-$diskon_pemasukan)/100);
                            $transaksi_detail[] = (object) array(
                                'layanan_id'=> $item->tarif_id,
                                'departemen_id' => $item->departemen_id,
                                'piutang_id' =>null,
                                'tagihan_id' => $item->tagihan_id,
                                'layanan_string'=> $item->desc,
                                'tipe'=> $item->tarif_tipe_id,
                                'kelas'=> $item->tarif_kelas,
                                'harga'=> $item->unit_price,
                                'diskon'=> $diskon_pemasukan,
                                'jumlah'=> $item->qty,
                                'subtotal'=> $subtotal_pemasukan,
                                'created_by' => $item->created_by,
                                'kategori' => $item->kategori_id,
                                'keterangan' => 'Diskon '.round($diskon_pemasukan,2).'% karena pembayaran sisanya melalui piutang');
                        }
                        //dd($transaksi_detail);
                        $detail = TagihanDetail::find($item->id);
                        $detail->is_paid = 1;
                        $detail->save();
                    }
                }
                $transaksi_piutang = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
                ->create($judul,$total_tagihan,$total_tagihan-$total_piutang,$total_piutang,$tagihan->pasien_id,$penanggungjawab,1,$tagihan->paid_date,null,null,$transaksi_detail_piutang,$pasien_pembayaran_id,$tagihan->lokasi_id,$tagihan->kasus_tagihan_id,$perusahaan_id);
                //dd($transaksi_detail);
                if($total_bayar>0){
                    /*dd($judul,$total_tagihan,$total_tagihan-$total_bayar,$total_bayar,
                        $tagihan->pasien_id,$tagihan->pasien->name,$tagihan->kategori_id,$tagihan->paid_date,
                        $transaksi_detail,$tagihan->pasien_pembayaran_id,$akun_id,16,$tagihan->lokasi_id);*/
                    $transaksi = app('App\Http\Controllers\Keuangan\Pemasukan\CreateController')
                    ->create($judul,$total_tagihan,$total_tagihan-$total_bayar,$total_bayar,
                        $tagihan->pasien_id,$tagihan->pasien->name,$tagihan->kategori_id,$tagihan->paid_date,
                        $transaksi_detail,$tagihan->pasien_pembayaran_id,$akun_id,16,$tagihan->lokasi_id);
                    //dd("abc");
                }
            }
            else{
                $tagihan = Tagihan::find($tagihan_id);
                foreach($tagihan->detail as $item){
                    if(!$item->is_paid){
                        //dd("belm bayar");
                        $transaksi_detail[] = (object) array(
                            'layanan_id'=> $item->tarif_id,
                            'departemen_id' => $item->departemen_id,
                            'piutang_id' =>null,
                            'tagihan_id' => $item->tagihan_id,
                            'layanan_string'=> $item->desc,
                            'tipe'=> $item->tarif_tipe_id,
                            'kelas'=> $item->tarif_kelas,
                            'harga'=> $item->unit_price,
                            'diskon'=> $item->diskon,
                            'jumlah'=> $item->qty,
                            'subtotal'=> $item->subtotal,
                            'created_by' => $item->created_by,
                            'kategori' => $item->kategori_id,
                            'keterangan' => NULL);

                        $detail = TagihanDetail::find($item->id);
                        $detail->is_paid = 1;
                        $detail->save();
                    }
                }
                $transaksi = app('App\Http\Controllers\Keuangan\Pemasukan\CreateController')
                ->create($judul,$tagihan->subtotal,$tagihan->diskon,$tagihan->total_bill,
                    $tagihan->pasien_id,$tagihan->pasien->name,$tagihan->kategori_id,$tagihan->paid_date,
                    $transaksi_detail,$tagihan->pasien_pembayaran_id,$akun_id,$tagihan->perusahaan_id,
                    $tagihan->lokasi_id);
            }

            //if($tagihan->kasus_id != null)
            //    $remove = $this->removePasienFromAnyTransaction($tagihan->kasus_id);

            //dd()
            $tagihan = Tagihan::find($tagihan_id);
            //dd($is_dp);
            if($is_dp == 1)
            {   
                $cari = Deposit::where('pasien_id',$pasien_id)->get();
                //dd($cari);
                if(count($cari) == 0)
                {   
                    //dd("tes");
                    $deposit = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->createDeposit($total_bayar,$pasien_id,$tagihan->id);
                    $logDeposit = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->logDeposit($total_bayar,$tagihan->id,$pasien_id,1);
                    //dd($deposit);    
                }
                else
                {
                    $deposit2 = app('App\Http\Controllers\Kasir\Transaksi\EditController')->tambahDeposit($total_bayar,$pasien_id);
                    $logDeposit = app('App\Http\Controllers\Kasir\Transaksi\CreateController')->logDeposit($total_bayar,$tagihan->id,$pasien_id,1);    
                }
            }

            //Update IsPaid di Tagihan Kasus
            else 
            {   
                if(isset($tagihan->kasus_id))
                {
                    $tagihan_kasus = app('App\Http\Controllers\Kasus\Tagihan\EditController')->editPaid($tagihan->kasus_tagihan_id);    
                } 
            }
            
            //dd("gak");
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Transaksi Berhasil';
            $data['url'] = 'kasir/'.$tagihan->kasir_id.'/transaksi/invoice/'.$tagihan_id;


            DB::connection('kasir')->commit();
            DB::connection('keuangan')->commit();

            return json_encode($data);
        } catch (\Exception $e) {
            DB::connection('kasir')->rollback();
            DB::connection('keuangan')->rollback();
            dd($e);
        }
    }
    
    public function diskon(Request $request)
    {
        $tagihan_id = $request->id;
        $diskon = $request->diskon;

        $tagihan_detail = TagihanDetail::where('tagihan_id',$tagihan_id)->get();
        $subtotal = 0;

        foreach($tagihan_detail as $item)
        {
            if(!$item->is_paid){
                $detail = TagihanDetail::find($item->id);
                $disc = $detail->diskon;
                $detail->diskon = $disc + $diskon;
                $detail->subtotal = ($item->unit_price*(100 - ($disc + $diskon))/100) * $item->qty;
                $detail->save();
            }
            $subtotal = $subtotal + ($item->unit_price * $item->qty);
        }

        $tagihan_total = TagihanDetail::where('tagihan_id',$tagihan_id)->sum('subtotal');
        
        $tagihan = Tagihan::find($tagihan_id);
        $tagihan->diskon = $subtotal - $tagihan_total;
        $tagihan->subtotal = $subtotal;
        $tagihan->total_bill = $tagihan_total;
        $tagihan->updated_by = Auth::user()->id;
        $tagihan->save();

        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['text'] = 'Transaksi Berhasil';
        $data['url'] = 'kasir/'.$tagihan->kasir_id.'/transaksi/invoice/'.$tagihan_id;

        return json_encode($data);
    }

    public function split(Request $request, $kasir_id, $piutang_id)
    {
        try {
            DB::connection('keuangan')->beginTransaction();
            $redir_id = app('App\Http\Controllers\Keuangan\Piutang\PostController')->doSplit($request, $piutang_id );

            DB::connection('keuangan')->commit();

            $status = 1;
            $message = 'Piutang Berhasil di split.';
            $title = 'Berhasil!';

            return redirect('kasir/'.$kasir_id.'/transaksi/'.$redir_id)
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 1;
            $message = 'Piutang Gagal di split. Kesalahan Server. Hubungi Admin';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }



    public function revokeSplit($kasir_id, $piutang_id)
    {
        try {
            DB::connection('keuangan')->beginTransaction();
            $data = app('App\Http\Controllers\Keuangan\Piutang\PostController')->doRevokeSplit($piutang_id);
            DB::connection('keuangan')->commit();


            return redirect('kasir/'.$kasir_id.'/transaksi/'.$data['piutang_parent_id'])
            ->with('message', $data['message'])
            ->with('title',$data['title'])
            ->with('status', $data['status']);

        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = 1;
            $message = 'Piutang Split gagal dikembalikan. Kesalahan Server. Hubungi Admin';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }
}
