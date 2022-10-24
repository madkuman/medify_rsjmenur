<?php

namespace App\Http\Controllers\KamarOperasi\Rencana;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Rencana;
use App\Models\KamarOperasi\RencanaAlat;
use App\Models\KamarOperasi\PeranTim;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Gudang\ItemsTemplate;
use App\User as Dokter;
use DB;

class ReadController extends Controller
{
    public function rencanaObat(Request $request)
    {
      $operasi = Transaksi::find($request->input('id'));

      $items = array_filter($request->input('item'));
    	$jumlahs = $request->input('jumlah');
      $temp = [];
  		foreach ($items as $i => $item)
      {
        $temp[] = [
          'jumlah' => $jumlahs[$i]
        ];
  		}
      $syncdata = array_combine($items, $temp);
      $operasi->itemsTemplate()->sync($syncdata);

      $status = 1;
    	$message = 'Rencana Penggunaan Alat dan Obat Berhasil Diperbaharui.';
     	$title = 'Berhasil!';

      return redirect('kamaroperasi/pelaksanaan/'.$operasi->id)
    	->with('message', $message)
    	->with('title',$title)
    	->with('status', $status);
    }


    public function ajaxGetItem(Request $request)
    {
      $rencana = Rencana::where('operasi_id', $request->input('id'))
            ->select(['operasi_id', 'item_id', 'jumlah', 'jenis'])->get();

      foreach ($rencana as $i => $item)
      {
        $rencana[$i]['nama'] = $item->getItem->nama;
      }
      return response()->json($rencana->toArray());
    }

    public function ajaxSearchItem(Request $request)
    {
      $term = trim($request->search);
      if (empty($term))
      {
          return response()->json([]);
      }

      // $obat = ItemsTemplate::select(['id', DB::raw('CONCAT("obat_", id) as id2'), 'nama as text'])->where('nama', 'like', "%{$term}%")->get()->toArray();
      $alat = app('App\Http\Controllers\Cssd\Alat\ReadController')->GetAlat($term)->toArray();
      return response()->json($alat);
    }

    public function ajaxSearchAlkes(Request $request)
    {
      $term = trim($request->search);
      if (empty($term))
      {
          return response()->json([]);
      }

      $alat = app('App\Http\Controllers\Cssd\Alat\ReadController')->GetAlat($term)->toArray();
      return response()->json($alat);
    }

    public function ajaxSearchObat(Request $request)
    {
      $term = trim($request->search);
      if (empty($term))
      {
          return response()->json([]);
      }

      $obat = ItemsTemplate::select(['id', 'nama as text'])->where('nama', 'like', "%{$term}%")->get()->toArray();
      return response()->json($obat);
    }

    public function ajaxSearchTim(Request $request)
    {
      $term = trim($request->search);
      if (empty($term))
      {
          return response()->json([]);
      }

      $result = Dokter::select(['id', 'name as text'])->where('name', 'like', "%{$term}%")->get();
      return response()->json($result);
    }

    public function ajaxSearchRole(Request $request)
    {
      $term = trim($request->search);
      if (empty($term))
      {
          return response()->json([]);
      }

      $result = PeranTim::select(['id', 'nama as text'])->where('nama', 'like', "%{$term}%")->get();
      return response()->json($result);
    }
}
