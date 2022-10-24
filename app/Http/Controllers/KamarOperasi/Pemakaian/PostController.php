<?php

namespace App\Http\Controllers\KamarOperasi\Pemakaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pemakaian;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Farmasi\Resep;
use DB;

class PostController extends Controller
{
    public function submitPemakaian(Request $request)
    {
      $transaksi = Transaksi::with('ruangan')->findOrFail($request->input('id'));
      $connection = DB::connection('kamaroperasi');

      $connection->beginTransaction();
      try {
        if($transaksi->transaksi_obat)
        {
          $trans_obat = $transaksi->transaksi_obat;
          $resep = Resep::where('transaksi_id', $trans_obat->id)->first();
          foreach ($resep->resep_detail as $detail)
          {
            $detail->delete();
          }
          $resep->delete();
          $trans_obat->delete();
        }

        $item_deleted = Pemakaian::where('operasi_id', $request->input('id'))->delete();

        $nama_obat = json_decode($request->input('nama_obat'));
        if($alkes = $request->input('alkes_pemakaian'))
          $alkes_jumlah = array_filter($request->input('alkes_jumlah_pemakaian'));
        else
        {
          $alkes = [];
          $alkes_jumlah = [];
        }

        if($matkes = $request->input('matkes_pemakaian'))
          $matkes_jumlah = array_filter($request->input('matkes_jumlah_pemakaian'));
        else
        {
          $matkes = [];
          $matkes_jumlah = [];
        }

        if($obat = $request->input('obat_pemakaian'))
          $obat_jumlah = array_filter($request->input('obat_jumlah_pemakaian'));
        else
        {
          $obat = [];
          $obat_jumlah = [];
        }

        if($implan = $request->input('implan_pemakaian'))
          $implan_jumlah = array_filter($request->input('implan_jumlah_pemakaian'));
        else
        {
          $implan = [];
          $implan_jumlah = [];
        }
        $tipe_obat = [];
        $aturan = [];

        if(count($alkes))
        {
          foreach ($alkes as $i => $item)
          {
            if($item && array_key_exists($i, $alkes_jumlah) && $alkes_jumlah[$i] != 0)
            {
              $pemakaian = new Pemakaian;
              $pemakaian->jenis = 'alkes';
              $pemakaian->operasi_id = $transaksi->id;
              $pemakaian->item_id = $item;
              $pemakaian->jumlah = $alkes_jumlah[$i];
              $pemakaian->save();
            }
          }
        }

        if(count($matkes))
        {
          foreach ($matkes as $i => $item)
          {
            if($item && array_key_exists($i, $matkes_jumlah) && $matkes_jumlah[$i] != 0)
            {
              $pemakaian = new Pemakaian;
              $pemakaian->jenis = 'matkes';
              $pemakaian->operasi_id = $transaksi->id;
              $pemakaian->item_id = $item;
              $pemakaian->jumlah = $matkes_jumlah[$i];
              $pemakaian->save();

              $tipe_obat[] = 'Matkes';
              $aturan[] = null; //selalu null
            }
          }
        }

        if(count($obat))
        {
          foreach ($obat as $i => $item)
          {
            if($item && array_key_exists($i, $obat_jumlah) && $obat_jumlah[$i] != 0)
            {
              $pemakaian = new Pemakaian;
              $pemakaian->jenis = 'obat';
              $pemakaian->operasi_id = $transaksi->id;
              $pemakaian->item_id = $item;
              $pemakaian->jumlah = $obat_jumlah[$i];
              $pemakaian->save();

              $tipe_obat[] = 'Obat';
              $aturan[] = null; //selalu null
            }
          }
        }

        if(count($implan))
        {
          foreach ($implan as $i => $item)
          {
            if($item && array_key_exists($i, $implan_jumlah) && $implan_jumlah[$i] != 0)
            {
              $pemakaian = new Pemakaian;
              $pemakaian->jenis = 'implan';
              $pemakaian->operasi_id = $transaksi->id;
              $pemakaian->item_id = $item;
              $pemakaian->jumlah = $implan_jumlah[$i];
              $pemakaian->save();

              $tipe_obat[] = 'Implan';
              $aturan[] = null; //selalu null
            }
          }
        }
        $additional_data = [
          'nama-apotek' =>$transaksi->ruangan->farmasi_id,
          'farmasi_id' => $transaksi->ruangan->farmasi_id,
          'pasien' => $transaksi->pasien_id,
          'metode_pembayaran' => $transaksi->kasus_id ? $transaksi->kasus->pasien_pembayaran_id : null,
          'kasus_id' => $transaksi->kasus_id,
          'resep_id' => 0,
          'sep_id' => $transaksi->kasus_id ? $transaksi->kasus->sep_id : null,
          'id-obat' => array_merge($matkes, $obat, $implan),
          'nama-obat' => $nama_obat,
          'jumlah-obat' => array_merge($matkes_jumlah, $obat_jumlah, $implan_jumlah),
          'tipe-obat' => $tipe_obat,
          'aturan-obat' => $aturan,
          'no_redirect' => true,
          'keterangan' => $transaksi->ruangan->name
        ];

        $request->request->add($additional_data);

        $transaksi_obat = app('App\Http\Controllers\Farmasi\Transaksi\CreateController')->create($request);
        $transaksi->transaksi_obat_id = $transaksi_obat->id;
        $transaksi->save();

        $connection->commit();

        $message = 'Hasil Operasi Berhasil Diperbaharui.';
       	$title = 'Berhasil!';
        $status = 1;

    		return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id.'#hasil_operasi')
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);
      } catch (\Exception $e) {
        $connection->rollback();
        app('App\Http\Controllers\Error\Handler')->bugsnag($e);

        $message = 'An error occured.';
       	$title = 'Error';
        $status = -1;

    		return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id.'#hasil_operasi')
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);
      }
    }

    public function gantiPlafon(Request $request)
    {
      $transaksi = Transaksi::find($request->input('transaksi_id'));
      $kasus = $transaksi->kasus;
      $kasus->sep_id = $request->input('sep_id');
      $kasus->save();

      $message = 'Plafon Berhasil Diganti.';
      $title = 'Berhasil!';
      $status = 1;

      return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id.'#hasil_operasi')
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    }
}
