<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use App\Jobs\QueueArtisan;
use App\Models\Farmasi\LoketAntrian;
use App\Models\Farmasi\RacikanDetail;
use App\Models\Keuangan\Kategori;
use App\Models\Pasien\PembayaranPerusahaanType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\Pasien\Pasien;
use App\Models\Hospital\Lokasi;
use App\Models\Kasus\Kasus;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\PiutangDetail;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;
use stdClass;

class EditController extends Controller
{

    static protected $slug_kasir = "kasir-farmasi";

    public function payment(Request $request)
    {
        $id = $request->input('id');
        $farmasi = $request->input('farmasi');
        $transaction = TransaksiObat::find($id);
        if(count($transaction->copy_resep) > 0)
        {
            return redirect()->back()
                ->with('message', 'Transaksi sudah di copy resep')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
        if($transaction){
            $transaction = $this->updatePaid($transaction);
        }else{
            return redirect()->back()
                ->with('message', 'Transaksi sudah tidak tersedia')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }

        $kasus = Kasus::find($transaction->kasus_id);
        $laba = $request->input('laba');
        // $tagihan = $request->input('status_pembayaran');
        $kirim_tagihan = $request->kirim_tagihan;
        if(isset($kirim_tagihan)){
            $tagihan = $kirim_tagihan == '1'  ? 'on' : ($kirim_tagihan == '2' ? null : $kirim_tagihan);
        } else {
            $tagihan = $request->kirim_tagihan;
        }

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        try {
        DB::connection('farmasi')->beginTransaction();
            if(empty($transaction->paid_at) || empty($transaction->paid_by)) {
                $transaction->total_biaya_obat = $request->input('total_harga');
                $transaction->total_bayar = $request->input('pembayaran');
                if (!$tagihan) $transaction->kembalian = $request->input('pembayaran') - $request->input('total-harga');
                $transaction->paid_by = Auth::user()->id;
                $transaction->paid_at = Carbon::now();
                $transaction->shift_id = $request->shift_id;
                $transaction->embalase = $request->embalase;
                $transaction->dikerjakan_at = Carbon::now();
                $transaction->dikerjakan_by = Auth::user()->id;
                $transaction->save();

                $pay =app('App\Http\Controllers\Farmasi\ResepDetail\EditController')->payment($transaction->final_detail->id, $laba, $tagihan, $farm);
                if(is_string($pay))
                {
                    DB::connection('farmasi')->rollBack();
                    DB::connection('farmasi')->beginTransaction();
                    $transaction->paid_at =  null;
                    $transaction->save();
                    DB::connection('farmasi')->commit();
                    return redirect()->back()
                        ->with('message', 'Terdapat Stok Yang Tidak Tersedia')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
                }
            }

            $msg = 'Konfirmasi Pesanan Berhasil';
            if(is_null($transaction->waktu_check_in)){
                $req = new Request();
                $req->transaksi_id = $transaction->id;
                app('App\Http\Controllers\Farmasi\Screen\PostController')->confirm($req);
            }
            if(config('medify.third-party.jkn_online.on') &&!empty($transaction->kasus_id)) {
                $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($transaction->kasus->nomor_kasus);
                $transaksi = $kasus->rawat_jalan_transaksi_last_attr;
                if (($kasus->lokasi->lokasi->departemen->id ?? null) == 2 && $transaksi && $transaksi->task_id_jkn < 6) {
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today) * 1000;
                    $data['kodebooking'] = $transaksi->id;
                    $data['taskid'] = 6;
                    $data['waktu'] = $carbon_today;
                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 6, 'waktu' => $carbon_today]));
                }
            }
            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/transaksi/'.$transaction->slug)
                        ->with('message', $msg)
                        ->with('status', 1)
                        ->with('title', 'Pembayaran Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();
            DB::connection('farmasi')->beginTransaction();
            $transaction->paid_at =  null;
            $transaction->save();
            DB::connection('farmasi')->commit();

          return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function retur(Request $request, $farmasi)
    {
        $id = $request->input('id');
        $log = $request->input('log');
        $resep_detail_index = $request->input('resep_detail_index');
        $potongan = $request->input('potongan');
        $jumlah = $request->input('jumlah');
        $transaction = TransaksiObat::find($id);

        DB::connection('farmasi')->beginTransaction();
        try {
            $resep_id = app('App\Http\Controllers\Farmasi\Resep\CreateController')->copyResep($transaction->resep_final);
            $resep = Resep::with(['resep_detail'])->find($resep_id);
            $resep->retur =  1;
            $resep->save();
            $i=0; $total=0;
            foreach ($resep_detail_index as $index) {
              if($jumlah[$i]) $total += app('App\Http\Controllers\Farmasi\ResepDetail\EditController')->createRetur($log[$i],$potongan[$i],$jumlah[$i],$resep->resep_detail[$index]->id);
              $i++;
            }
            $returLama = is_null($transaction->total_retur) ? 0 : $transaction->total_retur;
        
            $transaction->total_retur = $total + $returLama;
            $transaction->total_biaya_obat = $transaction->total_biaya_obat - $total;
            $tur = 0;

            foreach ($resep->resep_detail as $detail){
                foreach ($detail->log as $log){
                    if (!empty($detail->kasusTagihanDetail)) {
                        if ($detail->kasusTagihanDetail->tagihan->checkout != 1) {
                            app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->farmasiRetur($detail->kasus_tagihan_detail_id, $log->jumlah_retur, $transaction->kasus_id);
                            $tur = 1;
                        }else{
                            DB::connection('farmasi')->rollBack();
                            return redirect()->back()
                                ->with('message', 'Tagihan Telah Di Checkout')
                                ->with('status', -1)
                                ->with('title', 'Gagal');
                        }
                    }
                }
            }

            //dd($tur);
            if($tur) $transaction->status_retur = $tur;
            $transaction->save();

            if($transaction->status == 1) $msg = 'Total Kembali : Rp. '.number_format($transaction->total_retur);
            else $msg = 'Pembayaran dimasukkan ke Tagihan';

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/transaksi/'.$transaction->slug)
                        ->with('message', $msg)
                        ->with('status', 1)
                        ->with('title', 'Retur Sukses');
        }
        catch (\Exception $e) 
        {
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          DB::connection('farmasi')->rollBack();

          return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function editRetur(Request $request, $farmasi)
    {
        $id = $request->input('id');
        $log = $request->input('log');
        $potongan = $request->input('potongan');
        $jumlah = $request->input('jumlah');
        $transaction = TransaksiObat::find($id);
        $old_subtotal = $request->input('old_subtotal');
        $old_jumlah = $request->input('old_jumlah');
        $resep_id = $request->input('resep_id');

        DB::connection('farmasi')->beginTransaction();
        try {
            $i = 0;
            $total = 0;
            $old_total = 0;
            $resep = Resep::find($resep_id);
            foreach ($log as $lo) {
                $old_total += $old_subtotal[$i];
                if (isset($jumlah[$i])) $total += app('App\Http\Controllers\Farmasi\ResepDetail\EditController')->retur($lo, $potongan[$i], $jumlah[$i], $old_jumlah[$i]);
                $i++;
            }

            $transaction->total_retur = $transaction->total_retur - $old_total + $total;
            $transaction->total_biaya_obat = $transaction->total_biaya_obat + $old_total - $total;
            $j=0;
            foreach ($resep->resep_detail as $detail){
                foreach ($detail->log as $log) {
                    if (!empty($transaction->kasus)) {
                        if (!empty($detail->kasusTagihanDetail)){
                           if($detail->kasusTagihanDetail->tagihan->checkout != 1) {
                               $jumlah_retur = $log->jumlah_retur - $old_jumlah[$j];
                               $j++;
                               app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->farmasiRetur($detail->kasus_tagihan_detail_id, $jumlah_retur, $transaction->kasus_id);
                           }else{
                               DB::connection('farmasi')->rollBack();
                               return redirect()->back()
                                   ->with('message', 'Tagihan Telah Di Checkout')
                                   ->with('status', -1)
                                   ->with('title', 'Gagal');
                           }
                        }
                    }
                }
            }
            $transaction->save();

            if ($transaction->status == 1) $msg = 'Total Kembali : Rp. ' . number_format($total);
            else $msg = 'Pembayaran dimasukkan ke Tagihan';

            DB::connection('farmasi')->commit();
            return redirect('farmasi/' . $farmasi . '/transaksi/' . $transaction->slug)
                ->with('message', $msg)
                ->with('status', 1)
                ->with('title', 'Ubah Retur Sukses');
        }
        catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();

            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function deleteRetur(Request $request,$farmasi)
    {
        $resep_id = $request->resep_id;
        DB::connection('farmasi')->beginTransaction();
        try {

            $resep = Resep::find($resep_id);
            $transaction = TransaksiObat::find($resep->transaksi_id);
            $total=0;
            foreach ($resep->resep_detail as $resep_detail){
                foreach ($resep_detail->log as $log){
                    $total+=$log->subtotal_retur;
                    if (!empty($transaction->kasus)) {
                        if (!empty($resep_detail->kasusTagihanDetail)) {
                            if ($resep_detail->kasusTagihanDetail->tagihan->checkout != 1) {
                                app('App\Http\Controllers\Kasus\TagihanDetail\EditController')->farmasiRetur($resep_detail->kasus_tagihan_detail_id, -$log->jumlah_retur, $resep->transaksi->kasus_id);
                            }else{
                                DB::connection('farmasi')->rollBack();
                                return redirect()->back()
                                    ->with('message', 'Tagihan Telah Di Checkout')
                                    ->with('status', -1)
                                    ->with('title', 'Gagal');
                            }
                        }
                    }
                    $item = Items::find($log->item_id);
                    $item->jumlah -= $log->jumlah_retur;
                    $item->save();
                    $log->delete();
                }
                $resep_detail->delete();
            }
            $resep->delete();
            $transaction->total_retur -=$total;
            $transaction->total_biaya_obat +=$total;
            $transaction->save();


            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/transaksi/'.$transaction->slug)
                ->with('message', 'Hapus Retur Berhasil!')
                ->with('status', 1)
                ->with('title', 'Sukses');

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();

            return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $farmasi = $request->input('farmasi');
        $description = $request->input('keterangan');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $antrian = $request->input('no_antrian');
        $tanggal_transaksi = $request->tanggal_transaksi;
        $dokter = $request['dokter'];
        $dokter_jenis = $request['dokter-jenis'];
        $dokter_rsal = $request['dokter-rsal'];
        $dokter_luar = $request['dokter-luar'];
        //dd($qty);
        $farm = Farmasi::find($farmasi);

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = TransaksiObat::find($id);
            $transaction->deskripsi = $description;
            $transaction->no_antrian = $antrian;

            if($dokter_jenis == 'rsal'){
                $transaction->dokter_id = $dokter_rsal;
                $dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($request->input('dokter-rsal'));
                if($dokter)
                    $transaction->dokter_nama = $dokter->name;
                else
                    $transaction->dokter_nama = '-';
            }
            else{
                $transaction->dokter_id = 0;
                $transaction->dokter_nama = $dokter_luar;
            }

            
            if(!empty($transaction->dikerjakan_at)) {
                $transaction->status = 0;
                $transaction->dikerjakan_at = NULL;
                $transaction->dikerjakan_by = NULL;
                $transaction->shift_id = NULL;
                $transaction->total_biaya_obat = NULL;
                $transaction->total_bayar = NULL;
                $transaction->kembalian = NULL;
                $transaction->paid_by = NULL;
                $transaction->paid_at = NULL;
                $transaction->lima_benar_at = NULL;
                $transaction->lima_benar_created_by = NULL;
                $transaction->lima_benar_pasien = NULL;
                $transaction->lima_benar_obat = NULL;
                $transaction->lima_benar_dosis = NULL;
                $transaction->lima_benar_aturan = NULL;
                $transaction->lima_benar_waktu = NULL;
                foreach($transaction->final_detail->resep_detail as $detail)
                {
                    foreach ($detail->log as $log) {
                        $item = Items::find($log->item_id);
                        if($item) {
                            $item->jumlah += $log->jumlah - $log->jumlah_retur;
                            $item->save();
                        }
                        $log->delete();
                    }
                    if(!empty($detail->kasusTagihanDetail)){
                        $minus = app('App\Http\Controllers\Kasus\Tagihan\EditController')->delete_bill($detail->kasusTagihanDetail->kasus_tagihan_id, $detail->kasusTagihanDetail->subtotal);
                        $detail->kasusTagihanDetail->delete();
                    }
                }
            }

            if($transaction->status_kasir ==  1 || !empty($transaction->piutang_id)){
                $piutang =  Piutang::where('id',$transaction->piutang_id)->first();
                if($piutang) {
                    if (count($piutang->pemasukan) == 0) {
                        $piutang->delete();
                        $transaction->status_kasir = 0;
                        $transaction->piutang_id = null;
                    } else {
                        DB::connection('farmasi')->rollBack();
                        return redirect('farmasi/' . $farm->slug . '/transaksi/' . $transaction->slug)
                            ->with('message', "Resep Gagal Diubah, Transaksi Sudah Terbayar Di kasir")
                            ->with('status', -1)
                            ->with('title', 'Gagal');
                    }
                }
            }

            $request->transaksi_id = $transaction->id;
            $request->tipe = 1;
            app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($transaction->resep_final);
            $resep = app('App\Http\Controllers\Farmasi\Resep\CreateController')->createWithRacikan($request);
            //dd($resep);

            $transaction->resep_final = $resep->id;
            $transaction->total_biaya_obat = $resep->jumlah_tagihan;
            $transaction->created_at = Carbon::createFromFormat('d-m-Y', $tanggal_transaksi, 'Asia/Jakarta');
            $transaction->save();


            $resep = $this->editStatus($transaction->id);

            if(config('medify.third-party.jkn_online.on') &&!empty($transaction->kasus_id)) {
                $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($transaction->kasus->nomor_kasus);
                $transaksi = $kasus->rawat_jalan_transaksi_last_attr;
                if (($kasus->lokasi->lokasi->departemen->id ?? null) == 2 && $transaksi && $transaksi->task_id_jkn < 6) {
                    $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                    $carbon_today = strtotime($carbon_today) * 1000;
                    $data['kodebooking'] = $transaksi->id;
                    $data['taskid'] = 6;
                    $data['waktu'] = $carbon_today;
                    dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 6, 'waktu' => $carbon_today]));
                }
            }

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farm->slug.'/transaksi/'.$transaction->slug)
                        ->with('message', "Resep Berhasil Diubah")
                        ->with('status', 1)
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          DB::connection('farmasi')->rollBack();

          return redirect()->back()
                    ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                    ->with('status', -1)
                    ->with('title', 'Gagal');
        }
    }

    public function editFromKasus(Request $request)
    {
        //dd($request);
        $id = $request->input('id');
        $farmasi = $request->input('farmasi');
        $description = $request->input('keterangan');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $antrian = $request->input('no_antrian');

        //dd($qty);
        $farm = Farmasi::find($farmasi);

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = TransaksiObat::find($id);
            $transaction->deskripsi = $description;
            $transaction->no_antrian = $antrian;
            if($transaction->status) {
                $transaction->status = 0;
                $transaction->shift_id = NULL;
                $transaction->total_biaya_obat = NULL;
                $transaction->total_bayar = NULL;
                $transaction->kembalian = NULL;
                $transaction->paid_by = NULL;
                $transaction->paid_at = NULL;
                
                foreach($transaction->final_detail->resep_detail as $detail)
                {
                  foreach ($detail->log as $log) {
                    $item = Items::find($log->item_id);
                    if($item) {
                      $item->jumlah += $log->jumlah - $log->jumlah_retur;
                      $item->save();
                    }
                    $log->delete();
                  }
                }                
            }

            $request->transaksi_id = $transaction->id;
            $request->tipe = 1;
            $resep = app('App\Http\Controllers\Farmasi\Resep\CreateController')->create($request);
            //dd($resep);

            $transaction->resep_final = $resep->id;
            $transaction->total_biaya_obat = $resep->jumlah_tagihan;
            $transaction->jenis_resep = $request->input('jenis_resep') ?? $transaction->jenis_resep;
            $transaction->save();

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farm->slug.'/transaksi/'.$transaction->slug)
                        ->with('message', "Resep Berhasil Diubah")
                        ->with('status', 1)
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          DB::connection('farmasi')->rollBack();

          return redirect()->back()
                    ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                    ->with('status', -1)
                    ->with('title', 'Gagal');
        }
    }

    public function analisa(Request $request, $farmasi)
    {
        $id = $request->input('id');

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = TransaksiObat::find($id);
            $transaction->analisa_resep_at = Carbon::now();
            $transaction->analisa_resep_by = Auth::user()->id;
            $transaction->analisa_resep_sep = $request->input('analisa_resep_sep');
            $transaction->analisa_resep_fotokopi_kartu = $request->input('analisa_resep_fotokopi_kartu');
            $transaction->analisa_resep_identitas_pasien = $request->input('analisa_resep_identitas_pasien');
            $transaction->analisa_resep_paraf_dokter = $request->input('analisa_resep_paraf_dokter');
            $transaction->analisa_resep_nama_obat = $request->input('analisa_resep_nama_obat');
            $transaction->analisa_resep_jumlah_obat = $request->input('analisa_resep_jumlah_obat');
            $transaction->analisa_resep_signa_obat = $request->input('analisa_resep_signa_obat');
            $transaction->analisa_resep_tepat_indikasi = $request->input('analisa_resep_tepat_indikasi');
            $transaction->analisa_resep_tepat_dosis = $request->input('analisa_resep_tepat_dosis');
            $transaction->analisa_resep_tepat_rute = $request->input('analisa_resep_tepat_rute');
            $transaction->analisa_resep_tepat_waktu = $request->input('analisa_resep_tepat_waktu');
            $transaction->analisa_resep_duplikasi_terapi = $request->input('analisa_resep_duplikasi_terapi');
            $transaction->analisa_resep_alergi_obat = $request->input('analisa_resep_alergi_obat');
            $transaction->analisa_resep_interaksi_obat = $request->input('analisa_resep_interaksi_obat');
            $transaction->analisa_resep_kontra_indikasi = $request->input('analisa_resep_kontra_indikasi');
            $transaction->status_ditelaah = '1';
            $transaction->save();

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/transaksi/'.$transaction->slug)
                        ->with('message', "Analisa Resep Berhasil Diubah")
                        ->with('status', 1)
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
          app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          DB::connection('farmasi')->rollBack();

          return redirect()->back()
                    ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                    ->with('status', -1)
                    ->with('title', 'Gagal');
        }
    }

    public function printed($transaksi = null)
    {
        if ($transaksi instanceof TransaksiObat) {
            $transaksi->printed = 1;
            unset($transaksi->fyi);
            $transaksi->save();
        }
    }
    public function labelPrinted($transaksi = null)
    {
        if ($transaksi instanceof TransaksiObat) {
            $transaksi->printed_label = 1;
            unset($transaksi->fyi);
            $transaksi->save();
        }
    }

    public function kerjakan($farmasi,$slug)
    {
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
        $transaksi->dikerjakan_at = Carbon::now()->format('Y-m-d H:m:s');
        $transaksi->save();
        $data['farmasi'] = $farm;
        $data['transaki']= $transaksi;
        $data['status'] = 1;
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['message'] = 'Sedang Dikerjakan';
        $data['url'] =0;
        return json_encode($data);
    }

    public function editStatus($transaksi_id)
    {
        $transaksi = TransaksiObat::where('id',$transaksi_id)->with('final_detail.resep_detail.obat_detail.item_detail.kategori_item.detail_kategori',
            'final_detail.resep_detail.racikan.obat_detail.item_detail.kategori_item.detail_kategori')->first();
        $resep = $transaksi->final_detail;

        $transaksi_is_racikan = 0;
        $transaksi_is_fornas = 1;
        $transaksi_is_formularium_rs = 1;

        $resep_details = [];

        foreach ($resep->resep_detail as $key => $resep_detail) {
            if(empty($resep_detail->obat_id))
            {
                $transaksi_is_racikan = 1;
                $temp_is_fornas = 1;
                $temp_is_formularium_rs = 1;
                foreach($resep_detail->racikan as $item_racikan)
                {
                    $kategori_items = $item_racikan->obat_detail->item_detail->kategori_item;
                    $item_racikan->is_fornas = $this->checkKategori($kategori_items,'fornas');
                    $item_racikan->is_formularium_rs = $this->checkKategori($kategori_items,'formularium-rs');
                    $item_racikan->save();

                    if($item_racikan->is_fornas == 0) $temp_is_fornas = 0;
                    if($item_racikan->is_formularium_rs == 0) $temp_is_formularium_rs = 0;
                }
                $resep_detail->is_fornas = $temp_is_fornas;
                $resep_detail->is_formularium_rs = $temp_is_formularium_rs;
                $resep_detail->save();
            } 
            else
            {
                $kategori_items = $resep_detail->obat_detail->item_detail->kategori_item;
                $resep_detail->is_fornas = $this->checkKategori($kategori_items,'fornas');
                $resep_detail->is_formularium_rs = $this->checkKategori($kategori_items,'formularium-rs');
                $resep_detail->save();
            }


            if($resep_detail->is_fornas == 0) $transaksi_is_fornas = 0;
            if($resep_detail->is_formularium_rs == 0) $transaksi_is_formularium_rs = 0;
        }

        $transaksi->is_fornas = $transaksi_is_fornas;
        $transaksi->is_formularium_rs = $transaksi_is_formularium_rs;
        $transaksi->is_racikan = $transaksi_is_racikan;
        $transaksi->save();
    }

    private function checkKategori($kategori_items,$slug)
    {
        foreach($kategori_items as $kategori_item)
        {
            $kategori_slug = $kategori_item->detail_kategori->slug;

            if($kategori_slug == $slug) 
            {
                return 1;
            }
        }
        return 0;
    }

    public function limaBenar(Request $request,$farmasi,$transaksi_slug)
    {
        $transaksi = TransaksiObat::where('slug',$transaksi_slug)->first();
        $transaksi->status = 1;
        $transaksi->lima_benar_pasien = $request->lima_benar_pasien;
        $transaksi->lima_benar_obat = $request->lima_benar_obat;
        $transaksi->lima_benar_dosis = $request->lima_benar_dosis;
        $transaksi->lima_benar_aturan = $request->lima_benar_aturan;
        $transaksi->lima_benar_waktu = $request->lima_benar_waktu;
        $transaksi->lima_benar_at = Carbon::now();
        $transaksi->lima_benar_created_by = Auth::user()->id;
        $transaksi->save();

        if(config('medify.third-party.jkn_online.on') && !empty($transaksi->kasus_id)) {
            $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($transaksi->kasus->nomor_kasus);
            $transaksi_rajal = $kasus->rawat_jalan_transaksi_last_attr;
            if (($kasus->lokasi->lokasi->departemen->id ?? null) == 2 && $transaksi_rajal && $transaksi_rajal->task_id_jkn < 7) {
                $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $carbon_today = strtotime($carbon_today) * 1000;
                $data['kodebooking'] = $transaksi_rajal->id;
                $data['taskid'] = 7;
                $data['waktu'] = $carbon_today;
                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi_rajal->id, 'taskid' => 7, 'waktu' => $carbon_today]));
            }
        }

        $data['status'] = 1;
        $data['type'] = 'success';
        $data['title'] = 'Berhasil';
        $data['message'] = '5 Benar telah berhasil tersimpan';
        $data['url'] = 0;
        return json_encode($data);
    }

    public function kirimKasir(Request $request)
    {
        $transaction = TransaksiObat::find($request->id);
        $kasir = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getBySlug(self::$slug_kasir);
        $farmasi = $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($request->slug);
        $kasir_id = $kasir->id;
        $diskon = 0;
        $pasien = Pasien::find($transaction->pasien_id);
        $nama_pasien = empty($pasien->name) ? $transaction->nama_pasien : $pasien->name;
        $judul = $farmasi->nama.' - '.$nama_pasien;
        $lokasi_id = $transaction->lokasi_id ?? $farmasi->lokasi_id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $pasien_pembayaran_id = $transaction->metode_pembayaran_id;
        $laba=explode(',',$request->laba);

        $transaksi_details = [];
        $i=0;
        $total = $request->embalase ?? 0;
        foreach($transaction->final_detail->resep_detail as $value){
            $value->laba = $laba[$i] ?? 0;
            if($value->tipe)
            {
                $subtotal = $this->countSubtotalRacikan($value->id,$laba[$i]);
                if($value->jumlah == 0){
                    $value->harga = 0;
                }else{
                    $value->harga = round($subtotal/$value->jumlah);
                }
                $value->subtotal = $value->harga*$value->jumlah;
            }
            else
            {
                $value->harga = round($value->obat_detail->item_detail->harga*(100 + $value->laba)/100);
                $value->subtotal = ceil($value->harga*$value->jumlah);
            }
            $i++;
            $detail_res = $this->detailItem((object)$value, $lokasi_id);
            array_push($transaksi_details, $detail_res);
            $total += $value->subtotal;
        }
        $jumlah = $total;
        $embalase = new \stdClass();
        $embalase->nama_obat = 'Embalase';
        $embalase->harga = $request->embalase;
        $embalase->jumlah = 1;
        $embalase->subtotal = $request->embalase;
        $embalase->aturan = '';
        $embalase_resep = $this->detailItem($embalase,$lokasi_id);
        array_push($transaksi_details, $embalase_resep);
        $transaksi_details = (object)$transaksi_details;
        $kategori_id = Kategori::where('slug','farmasi')->first()->id;
        $pihak_ketiga = empty($pasien->name) ? $transaction->nama_pasien : $pasien->name;
        $perusahaan_id = $transaction->perusahaan_tipe_id;

        $transaksi_kasir = app('App\Http\Controllers\Keuangan\Piutang\CreateController')
            ->create($kasir_id,$judul,$jumlah,$diskon,$total,($pasien->id ?? null),$pihak_ketiga,$kategori_id,
                $created_at,$created_at,$updated_at,
                $transaksi_details,$pasien_pembayaran_id,$lokasi_id,
                null,$perusahaan_id,'Administrasi Pendaftaran Pasien',null);
        $transaction->status_kasir = '1';
        $transaction->piutang_id = $transaksi_kasir->id;
        $transaction->save();

        if(config('medify.third-party.jkn_online.on') &&!empty($transaction->kasus_id)) {
            $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->get($transaction->kasus->nomor_kasus);
            $transaksi = $kasus->rawat_jalan_transaksi_last_attr;
            if (($kasus->lokasi->lokasi->departemen->id ?? null) == 2 && $transaksi && $transaksi->task_id_jkn < 6) {
                $carbon_today = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                $carbon_today = strtotime($carbon_today) * 1000;
                $data['kodebooking'] = $transaksi->id;
                $data['taskid'] = 6;
                $data['waktu'] = $carbon_today;
                dispatch(new QueueArtisan('command:update-task-jkn-id', ['kodebooking' => $transaksi->id, 'taskid' => 6, 'waktu' => $carbon_today]));
            }
        }

        if($transaksi_kasir){
            $data['status'] = 1;
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['message'] = 'Berhasil dikirim ke kasir';
            $data['url'] = 0;
            return json_encode($data);
        }
    }

    public function countSubtotalRacikan($resep_detail_id,$laba){
        $i=0;
        $subtotal=0;
        $racikan = RacikanDetail::where('resep_detail_id', $resep_detail_id)->get();
        foreach ($racikan as $detail) {
            $detail->laba = $laba;
            $detail->harga = $detail->obat_detail->item_detail->harga * (100 + $detail->laba) / 100;
            $detail->subtotal = $detail->harga * $detail->jumlah;
            $detail->save();
            $i++;
            $subtotal += $detail->subtotal;
        }
        return $subtotal;
    }

    public function detailItem($data, $lokasi_id)
    {
        $newtrans = new \stdClass();
        $newtrans->tarif_id = 0;
        $newtrans->deskripsi = $data->nama_obat;
        $newtrans->tarif_tipe_id = 0;
        $newtrans->tarif_kelas_id =0;
        $newtrans->kelas_id = 0;
        $newtrans->harga = $data->harga;
        $newtrans->diskon = 0;
        $newtrans->jumlah = $data->jumlah;
        $newtrans->subtotal = $data->subtotal;
        $newtrans->keterangan = $data->aturan;
        $newtrans->lokasi_id = $lokasi_id;
        $newtrans->kategori_id = 0;
        $newtrans->created_at = Carbon::now();
        $newtrans->updated_at = Carbon::now();
        $newtrans->created_by = Auth::user()->id;
        return $newtrans;
    }

    public function batalKirimKasir(Request $request){
      
        $piutang =  Piutang::where('id',$request->id)->first();
        // dd( $id, $id_transaksi);
        if(empty($piutang)){
            $transaksi = TransaksiObat::find($request->transaksi_id);
            $transaksi->status_kasir = '0';
            $transaksi->save();
            $data['status'] = 1;
            $data['url'] = 0;
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Transaksi Kasir Berhasil dibatalkan';
            return json_encode($data);
        }else if (count($piutang->pemasukan) == 0){
            $transaksi = TransaksiObat::find($request->transaksi_id);
            $transaksi->status_kasir = '0';
            $transaksi->save();

            $details = PiutangDetail::where('piutang_id',$piutang->id)->get();
            foreach($details as $item)
            {
                $temp = PiutangDetail::find($item->id);
                $temp->delete();
            }
            $piutang->delete();
            $data['status'] = 1;
            $data['url'] = 0;
            $data['type'] = 'success';
            $data['title'] = 'Berhasil';
            $data['text'] = 'Transaksi Kasir Berhasil dibatalkan';
            return json_encode($data);
        } else {
            $data['url'] = 0;
            $data['type'] = 'error';
            $data['title'] = 'Gagal';
            $data['text'] = 'Transaksi Kasir Sudah Dibayar';
            return json_encode($data);
        }
    }

    private function updatePaid($transaction)
    {
        DB::connection('farmasi')->beginTransaction();
        $transaction->paid_at =  Carbon::now();
        $transaction->save();
        DB::connection('farmasi')->commit();
        return $transaction;
    }

    public function saveAntrian($data)
    {
        $transaksi = TransaksiObat::with(['pembayaran_detail.perusahaan.tipe'])->find($data->id);
        $nomor_antrian = $transaksi->no_antrian ?? $transaksi->nomor_antrian;

        if (!$nomor_antrian) {
            return (object)[
                'status' => false,
                'message' => 'No antrian tidak boleh kosong!',
                'data' => null
            ];
        }

        $transaksi->loket_id = $data->loket;
        $transaksi->status_panggil = 0;
        $transaksi->save();
        $this->generateAudio($data->id, $transaksi, $nomor_antrian, $transaksi->loket_id);
        return (object)[
            'status' => true,
            'message' => 'OK!',
            'data' => $transaksi
        ];
    }

    public function generateAudio($transaksi_id, $transaksi, $nomor_antrian, $loket_id)
    {
        $path_generate = 'assets/img/farmasi-tv/sound/generate/';
        $path = 'assets/img/farmasi-tv/sound/';
        $nama_file = 'antrian_'.(string)$transaksi_id.'_'.$loket_id.'.mp3';
        $nama_file_wav = 'antrian_'.(string)$transaksi_id.'_'.$loket_id.'.wav';

        if(!file_exists($path_generate)) {
            mkdir($path_generate, 0777, true);
        }

        if(!file_exists(public_path($path_generate.$nama_file))) {
            $loket = LoketAntrian::find($loket_id);

            if($transaksi->pembayaran_detail) $tipe_perusahaan = $transaksi->pembayaran_detail->perusahaan->tipe;
            else $tipe_perusahaan = PembayaranPerusahaanType::where('slug', 'tunai')->first();

            $jenis_antrian = (new \App\Http\Controllers\Farmasi\JenisAntrian\ReadController())->getByTipePerusahaan($tipe_perusahaan->id);
            $panjang_kode_jenis_antrian = ($jenis_antrian->kode ?? null) ? strlen($jenis_antrian->kode) : 0;
            $t_nomor_antrian = substr($nomor_antrian, $panjang_kode_jenis_antrian);

            $antrian_name_arr = str_split($t_nomor_antrian);
            $audio_arr = [
                file_get_contents($path.'nomor.mp3'),
                file_get_contents($path.'-.mp3'),
                file_get_contents($path.'antrian.mp3'),
                file_get_contents($path.'-.mp3')
            ];

            if ($jenis_antrian->sound ?? null) {
                if (file_exists(public_path($jenis_antrian->sound))) {
                    $audio_arr[] = file_get_contents($jenis_antrian->sound);
                }
            }

            foreach ($antrian_name_arr as $value) {
                if ($value && $value != '') {
                    $audio_arr[] = file_get_contents($path.strtoupper($value).'.mp3');
                }
            }

            $audio_arr[] = file_get_contents($path.'menuju.mp3');
            $audio_arr[] = file_get_contents($path.'-.mp3');
            if ($loket->sound) {
                $audio_arr[] = file_get_contents(file_exists(public_path($loket->sound)) ? $loket->sound : $path.'default-loket.mp3');
            } else {
                $audio_arr[] = file_get_contents($path.'default-loket.mp3');
            }

            $merge_audio = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio($path_generate, $nama_file, $audio_arr);
            $merge_audio_wav = app('App\Http\Controllers\Functions\AudioCombine')->makeAudio($path_generate, $nama_file_wav, $audio_arr);

            // Untuk membersihkan file lama > 2 hari
            foreach (glob($path_generate."*") as $file) {
                if (filemtime($file) < time() - 172800) { // 2 hari
                    unlink($file);
                }
            }
        }
    }

    public function panggilAntrian($farmasi_id)
    {
        $hari_ini = Carbon::today()->toDateString();
        $data = TransaksiObat::with(['loket_antrian'])
            ->where('farmasi_id', '=', $farmasi_id)
            ->whereDate('created_at', '=', $hari_ini)
            ->where('status_panggil', '=', 0)
            ->first();
        if (!empty($data)) {
            $data->status_panggil = 1;
            $data->save();
        }
        return $data;
    }
}
