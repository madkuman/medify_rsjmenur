<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use App\Models\Keuangan\Piutang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\Items;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete($farm, Request $request)
  {
  	$id = $request->input('id');

  	DB::connection('farmasi')->beginTransaction();

  	try {
  		$transaction = TransaksiObat::find($id);
  		//dd($transaction);
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

        if($transaction->status_kasir ==  1 || !empty($transaction->piutang_id)){
            $piutang =  Piutang::where('id',$transaction->piutang_id)->first();
            if($piutang) {
                if (count($piutang->pemasukan) == 0) {
                    $piutang->delete();
                    $transaction->status_kasir = 0;
                    $transaction->piutang_id = null;
                } else {
                    DB::connection('farmasi')->rollBack();
                    return redirect('farmasi/' . $farm . '/transaksi/' . $transaction->slug)
                        ->with('message', "Resep Gagal Dihapus, Transaksi Sudah Terbayar Di kasir")
                        ->with('status', -1)
                        ->with('title', 'Gagal');
                }
            }
        }

      # copy resep
      if ($transaction->transaksi_asal != null) {
        $transaksi_asal = $transaction->transaksi_asal;
        $transaksi_asal->status = 0;
        $transaksi_asal->save();
      }
      app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($transaction->resep_final);
      $transaction->deleted_by = Auth::user()->id;
      $transaction->save();
  		$transaction->delete();

  		DB::connection('farmasi')->commit();
      return redirect('farmasi/'.$farm.'/transaksi/')
                ->with('message', 'Transaksi berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
  	} catch (\Exception $e) {
  		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      DB::connection('farmasi')->rollBack();
  		return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
  	}
  }
  public function cancelKrs($kasus)
  {
    $transaction = TransaksiObat::where('kasus_id',$kasus)
    ->whereNull('paid_at')->get();
    $user_id = Auth::user()->id;

    foreach ($transaction as $t) 
    {
      app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($t->resep_final);
      $t->deleted_by = $user_id;
      $t->save();
      $t->delete();
    }
    return 1;
  }
  public function kasusDelete($trans)
  {
    DB::connection('farmasi')->beginTransaction();

    try {
      $transaction = TransaksiObat::find($trans);
      //dd($transaction);
      foreach($transaction->final_detail->resep_detail as $detail)
      {
        foreach ($detail->log as $log) {
          $item = Items::find($log->item_id);
          if($item) {
            $item->jumlah_sedia += $log->jumlah - $log->jumlah_retur;
            $item->save();
          }
          $log->delete();
        }
      }
      app('App\Http\Controllers\Farmasi\Resep\DeleteController')->deleteResep($transaction->resep_final);
      $transaction->deleted_by = Auth::user()->id;
      $transaction->save();
      $transaction->delete();

      DB::connection('farmasi')->commit();
      return;
    }
    catch (\Exception $e) {
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      DB::connection('farmasi')->rollBack();
      return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
    }
  }
}
