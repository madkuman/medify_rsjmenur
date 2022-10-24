<?php

namespace App\Http\Controllers\KamarOperasi\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Paket;
use App\Models\KamarOperasi\PaketItem;
use Carbon\Carbon;
use DB;

class EditController extends Controller
{
  public function update(Request $request)
  {
    $connection = DB::connection('kamaroperasi');
    $connection->beginTransaction();
    try {
      $paket = Paket::findOrFail($request->id);
      $paket->nama = $request->input('nama_paket');
      $paket->tipe = $request->input('tipe');
      $paket->save();

      $delete_paket = PaketItem::where('paket_id', $request->id)->delete();

      $items = $request->input('item');
      $jumlahs = $request->input('jumlah');
      foreach ($items as $i => $item)
      {
        $paket_item = new PaketItem;
        $paket_item->paket_id = $paket->id;
        $paket_item->item_id = $item;
        $paket_item->jumlah = $jumlahs[$i];
        $paket_item->tipe = $paket->tipe;
        $paket_item->save();
      }
      $connection->commit();

      $status = 1;
      $title = 'Berhasil!';
     	$message = 'Sukses Memperbaharui Paket';

      if ($paket->tipe == "alkes") {
        return redirect('/cssd/pengaturan/paket/show/'.$paket->id)
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
      } else {
        return redirect('/kamaroperasi/paket/show/'.$paket->id)
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
      }
    } catch (\Exception $e) {
      $connection->rollback();

      $status = -1;
    	$message = $e;
     	$title = 'An Error Occured';
      return back()
      ->with('message', $message)
  		->with('title',$title)
  		->with('status', $status);;
    }

    $message = 'Data Kamar Berhasil Diperbaharui!';
    $title = 'Berhasil!';
    $status = 1;

    return redirect('kamaroperasi/kamar')
    ->with('message', $message)
    ->with('title',$title)
    ->with('status', $status);
  }

  public function destroy($id)
  {
    $kamar = Paket::findOrFail($id);
    $tipe = $kamar->tipe;
    $items = $kamar->paket_item;

    foreach ($items as $item)
    {
      $item->delete();
    }
    $kamar->delete();


    $message = 'Data Paket Berhasil Dihapus!';
    $title = 'Berhasil!';
    $status = 1;

    if ($tipe == "alkes") {
      return redirect('/cssd/pengaturan/paket')
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    } else {
      return redirect('/kamaroperasi/paket/')
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    }
  }
}
