<?php

namespace App\Http\Controllers\KamarOperasi\Pasca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PengembalianObat;
use App\Models\KamarOperasi\PengembalianAlat;
use App\Models\KamarOperasi\Transaksi;
use DB;

class CreateController extends Controller
{
  public function pengembalian(Request $request)
  {
    $items = array_filter($request->input('pengembalian_item'));
    // $tipe = json_decode($request->input('tipe'));
    $jumlahs = $request->input('pengembalian_jumlah');
    $operasi_id = $request->input('id');

    $pengembalian_obat = PengembalianObat::withTrashed()->where('operasi_id', $operasi_id)->pluck('item_id')->toArray();
    $pengembalian_alat = PengembalianAlat::withTrashed()->where('operasi_id', $operasi_id)->pluck('item_id')->toArray();
    $obat_updated = [];
    $alat_updated = [];

    DB::beginTransaction();
    try {
      foreach ($items as $i => $item)
      {
        $item = explode("_", $item); //[0] -> tipe (alat/obat) [1] -> id item
        if ($item[0] == 'obat')
        {
          if(in_array(intval($item[1]), $pengembalian_obat))
          {
            $tim = PengembalianObat::withTrashed()->where('operasi_id', $operasi_id)->where('item_id', $item[1])->first();
            $tim->jumlah = $jumlahs[$i];
            $tim->deleted_at = NULL;
            $tim->save();
          }
          else
          {
            $tim = new PengembalianObat;
            $tim->operasi_id = $operasi_id;
            $tim->item_id = $item[1];
            $tim->jumlah = $jumlahs[$i];
            $tim->save();
          }
          $obat_updated[] = $tim->item_id;
        }
        else if ($item[0] == 'alat')
        {
          if(in_array(intval($item[1]), $pengembalian_alat))
          {
            $tim = PengembalianAlat::withTrashed()->where('operasi_id', $operasi_id)->where('item_id', $item[1])->first();
            $tim->jumlah = $jumlahs[$i];
            $tim->deleted_at = NULL;
            $tim->save();
          }
          else
          {
            $tim = new PengembalianAlat;
            $tim->operasi_id = $operasi_id;
            $tim->item_id = $item[1];
            $tim->jumlah = $jumlahs[$i];
            $tim->save();
          }
          $alat_updated[] = $tim->item_id;
        }
      }

      $tobedeleted_obat = array_diff($pengembalian_obat, $obat_updated);
      $tobedeleted_alat = array_diff($pengembalian_alat, $alat_updated);

      foreach ($tobedeleted_obat as $item_deleted)
      {
        $tim = PengembalianObat::where('operasi_id', $operasi_id)->where('item_id', $item_deleted)->first();
        if($tim) $tim->delete();
      }

      foreach ($tobedeleted_alat as $item_deleted)
      {
        $tim = PengembalianAlat::where('operasi_id', $operasi_id)->where('item_id', $item_deleted)->first();
        if($tim) $tim->delete();
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      //something went wrong
      $status = -1;
      $message = 'Rencana Pengembalian Alat dan Obat Gagal Diperbaharui.';
      $title = 'Gagal!';

      return redirect('kamaroperasi/pelaksanaan/'.$operasi_id.'#hasil_operasi')
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    }

    $status = 1;
    $message = 'Rencana Pengembalian Alat dan Obat Berhasil Diperbaharui.';
    $title = 'Berhasil!';

    return redirect('kamaroperasi/pelaksanaan/'.$operasi_id.'#hasil_operasi')
    ->with('message', $message)
    ->with('title',$title)
    ->with('status', $status);
  }

  // public function pengembalian(Request $request)
  // {
  //   $items = array_filter($request->input('pengembalian_item'));
  //   $jumlahs = $request->input('pengembalian_jumlah');
  //   $operasi_id = $request->input('id');
  //
  //   $pengembalian_obat = PengembalianObat::withTrashed()->where('operasi_id', $operasi_id)->pluck('item_id')->toArray();
  //   $ada = array_intersect($pengembalian_obat, $items);
  //   $tobedeleted = array_diff($pengembalian_obat, $items);
  //
  //   foreach ($items as $i => $item)
  //   {
  //     if(in_array(intval($item), $ada))
  //     {
  //       $tim = PengembalianObat::withTrashed()->where('operasi_id', $operasi_id)->where('item_id', $item)->first();
  //       $tim->jumlah = $jumlahs[$i];
  //       $tim->deleted_at = NULL;
  //       $tim->save();
  //     }
  //     else
  //     {
  //       $tim = new PengembalianObat;
  //       $tim->operasi_id = $operasi_id;
  //       $tim->item_id = $item;
  //       $tim->jumlah = $jumlahs[$i];
  //       $tim->save();
  //     }
  //   }
  //
  //   foreach ($tobedeleted as $item_deleted)
  //   {
  //     $tim = PengembalianObat::where('operasi_id', $operasi_id)->where('item_id', $item_deleted)->first();
  //     if($tim) $tim->delete();
  //   }
  //
	// 	$status = 1;
  // 	$message = 'Rencana Pengembalian Alat dan Obat Berhasil Diperbaharui.';
  //  	$title = 'Berhasil!';
  //
	// 	return redirect('kamaroperasi/pelaksanaan/'.$operasi_id.'#hasil_operasi')
	// 	->with('message', $message)
	// 	->with('title',$title)
	// 	->with('status', $status);
  // }
}
