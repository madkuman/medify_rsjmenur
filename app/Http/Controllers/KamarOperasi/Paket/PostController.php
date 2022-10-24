<?php

namespace App\Http\Controllers\KamarOperasi\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Paket;
use App\Models\KamarOperasi\PaketItem;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

class PostController extends Controller
{
  public function new(Request $request)
  {
    $connection = DB::connection('kamaroperasi');
    $connection->beginTransaction();
    try {
      $paket = new Paket;
      $paket->nama = $request->input('nama_paket');
      $paket->tipe = $request->input('tipe');
      $paket->save();

      //generate slug
      $paket->slug = str_pad($paket->id, 6, '0', STR_PAD_LEFT);
      $paket->save();

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
     	$message = 'Sukses Membuat Paket';

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
      
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      $connection->rollback();

      $status = -1;
    	$message = $e;
     	$title = 'An Error Occured';
      return back()
      ->with('message', $message)
  		->with('title',$title)
  		->with('status', $status);;
    }

  }
}
