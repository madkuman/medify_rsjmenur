<?php

namespace App\Http\Controllers\KamarOperasi\Rencana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Rencana;
use App\Models\KamarOperasi\RencanaAlat;
use App\Models\KamarOperasi\Transaksi;
use DB;

class CreateController extends Controller
{
    public function rencanaObat(Request $request)
    {
      $items = array_filter($request->input('item'));
      // $tipe = json_decode($request->input('tipe'));
    	$jumlahs = $request->input('jumlah');
  		$operasi_id = $request->input('id');

      $rencana_obat = Rencana::withTrashed()->where('operasi_id', $operasi_id)->pluck('item_id')->toArray();
      $rencana_alat = RencanaAlat::withTrashed()->where('operasi_id', $operasi_id)->pluck('item_id')->toArray();
      $obat_updated = [];
      $alat_updated = [];

      DB::beginTransaction();
      try {
        foreach ($items as $i => $item)
        {
          $item = explode("_", $item); //[0] -> tipe (alat/obat) [1] -> id item
          if ($item[0] == 'obat')
          {
            if(in_array(intval($item[1]), $rencana_obat))
            {
              $tim = Rencana::withTrashed()->where('operasi_id', $operasi_id)->where('item_id', $item[1])->first();
              $tim->jumlah = $jumlahs[$i];
              $tim->deleted_at = NULL;
              $tim->save();
            }
            else
            {
              $tim = new Rencana;
              $tim->operasi_id = $operasi_id;
              $tim->item_id = $item[1];
              $tim->jumlah = $jumlahs[$i];
              $tim->save();
            }
            $obat_updated[] = $tim->item_id;
          }
          else if ($item[0] == 'alat')
          {
            if(in_array(intval($item[1]), $rencana_alat))
            {
              $tim = RencanaAlat::withTrashed()->where('operasi_id', $operasi_id)->where('item_id', $item[1])->first();
              $tim->jumlah = $jumlahs[$i];
              $tim->deleted_at = NULL;
              $tim->save();
            }
            else
            {
              $tim = new RencanaAlat;
              $tim->operasi_id = $operasi_id;
              $tim->item_id = $item[1];
              $tim->jumlah = $jumlahs[$i];
              $tim->save();
            }
            $alat_updated[] = $tim->item_id;
          }
        }

        $tobedeleted_obat = array_diff($rencana_obat, $obat_updated);
        $tobedeleted_alat = array_diff($rencana_alat, $alat_updated);

        foreach ($tobedeleted_obat as $item_deleted)
        {
          $tim = Rencana::where('operasi_id', $operasi_id)->where('item_id', $item_deleted)->first();
          if($tim) $tim->delete();
        }

        foreach ($tobedeleted_alat as $item_deleted)
        {
          $tim = RencanaAlat::where('operasi_id', $operasi_id)->where('item_id', $item_deleted)->first();
          if($tim) $tim->delete();
        }

        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();
        //something went wrong
        $status = -1;
      	$message = 'Rencana Penggunaan Alat dan Obat Gagal Diperbaharui.';
       	$title = 'Gagal!';

        return redirect('kamaroperasi/pelaksanaan/'.$operasi_id)
      	->with('message', $message)
      	->with('title',$title)
      	->with('status', $status);
      }

      $status = 1;
    	$message = 'Rencana Penggunaan Alat dan Obat Berhasil Diperbaharui.';
     	$title = 'Berhasil!';

      return redirect('kamaroperasi/pelaksanaan/'.$operasi_id)
    	->with('message', $message)
    	->with('title',$title)
    	->with('status', $status);
    }
}
