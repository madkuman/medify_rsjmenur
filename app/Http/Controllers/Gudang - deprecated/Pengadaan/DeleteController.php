<?php

namespace App\Http\Controllers\Gudang\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Pengadaan;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\Utang;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete(Request $request)
  {
  	$id = $request->input('id');

    
    DB::connection('keuangan')->beginTransaction();

  	try {
  		$transaction = Pengadaan::find($id);
  		//dd($transaction);

      $same_utang = Pengadaan::where('utang_id', $transaction->utang_id)->get();
      $po = PO::with('detail')->find($transaction->po_id);
      $utang = Utang::find($transaction->utang_id);
      if(isset($utang) && isset($utang->tanggal_transaksi)){        
        
        DB::connection('keuangan')->rollBack();
        return redirect()->back()
                  ->with('message', 'Tidak dapat menghapus penerimaan. PJK telah diproses.')
                  ->with('status', -1)
                  ->with('title', 'Gagal');
      }
      if(count($same_utang) > 0){ 
        $is_deleted = false;
      }
      else{
        $is_deleted = true;
      }
      $detail_utangs = [];
      $new_processed_jumlah = [];
      $new_processed_subtotal = [];
      $j=0;
      $total_non_diskon = 0;
      $diskon_total = 0;
      $total = 0;
      foreach($transaction->log as $item)
      {
        $deleted = app('App\Http\Controllers\Gudang\LogPengadaan\DeleteController')->deleteLog($item->id);

        if(!$is_deleted && isset($po)){
          $detail_utang['id_detail'] = $po->detail[$j]->id;
          $detail_utang['id_detail_utang'] = $transaction->utang->detail[$j]->id;
          $detail_utang['layanan_string'] = $po->detail[$j]->deskripsi;
          $detail_utang['harga'] = $po->detail[$j]->harga;
          $detail_utang['diskon'] = $po->detail[$j]->diskon;
          $detail_utang['keterangan'] = $po->detail[$j]->keterangan;
          $detail_utang['is_deleted'] = false;
          $detail_utang['jumlah'] = -$item->jumlah;
          $detail_utang['subtotal'] = -$item->subtotal;
          $subtotal = -$item->subtotal;
          $subtotal_non_diskon =  $subtotal * 100 /(100-$po->detail[$j]->diskon);
          $total += $subtotal;
          $total_non_diskon += $subtotal_non_diskon;
          $diskon_total += $subtotal_non_diskon - $subtotal;
          array_push($detail_utangs, (object) $detail_utang);
        }
        $j++;
      }
      // dd($is_deleted, $po,  $detail_utangs, $total, $total_non_diskon, $diskon_total);
      // if(!is_null($transaction->po_id)){
      //     // dd($new_processed);
      //     app('App\Http\Controllers\Keuangan\PO\EditController')->processDetail($transaction->po_id, $new_processed);
      // }

      if($is_deleted && isset($utang)){
        $req = new Request;
        $req->merge(['id' => $transaction->utang_id]);
        app('App\Http\Controllers\Keuangan\Utang\DeleteController')->delete($req);
      }elseif(isset($utang)){
        $utang = app('App\Http\Controllers\Keuangan\Utang\EditController')->updateMultiSource(
          $transaction->utang_id,
          $po->judul,
          $utang->jumlah - $total_non_diskon,
          $utang->diskon - $diskon_total,
          $utang->total - $total,
          $detail_utangs,
          $transaction->supplier_id,
          $transaction->tanggal,
          $transaction->tanggal_faktur,
          $po->tanggal_po,
          $transaction->nomor_referensi,
          $po->no_po,
          $po->id,
          null
        );
      }

  		$transaction->delete();

      
      DB::connection('keuangan')->commit();
      return redirect('gudang/pengadaan/')
                ->with('status', 1)
                ->with('message', 'Pengadaan berhasil dihapus')
                ->with('title', 'Sukses');
  	} catch (\Exception $e) {
      
      DB::connection('keuangan')->rollBack();
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);
  		return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
  	}
  }
}
