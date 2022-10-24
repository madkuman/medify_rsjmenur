<?php

namespace App\Http\Controllers\KamarOperasi\Pengembalian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pengembalian;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Farmasi\Farmasi;
use App\Models\CSSD\Transaksi as CSSDTransaksi;
use DB;

class PostController extends Controller
{
    public function submitPengembalian(Request $request)
    {
      $transaksi = Transaksi::findOrFail($request->input('id'));
      $connection = DB::connection('kamaroperasi');
      $connection_farmasi = DB::connection('farmasi');
      $connection_cssd = DB::connection('cssd');
      $connection->beginTransaction();
      try {
        $item_deleted = Pengembalian::where('operasi_id', $request->input('id'))->delete();
        
        if($transaksi->pengembalian_alat_id)
        {
          CSSDTransaksi::find($transaksi->pengembalian_alat_id)->delete();
        }

        $alkes = $request->input('alkes_pengembalian');
        $alkes_jumlah = $request->input('alkes_jumlah_pengembalian');
        $matkes = $request->input('matkes_pengembalian');
        $matkes_jumlah = $request->input('matkes_jumlah_pengembalian');
        $obat = $request->input('obat_pengembalian');
        $obat_jumlah = $request->input('obat_jumlah_pengembalian');
        $implan = $request->input('implan_pengembalian');
        $implan_jumlah = $request->input('implan_jumlah_pengembalian');


        $id_obat = [];
        $jumlah = [];

        if(is_array($alkes))
        {
          foreach ($alkes as $i => $item)
          {
            if($item)
            {
              $pengembalian = new Pengembalian;
              $pengembalian->jenis = 'alkes';
              $pengembalian->operasi_id = $transaksi->id;
              $pengembalian->item_id = $item;
              $pengembalian->jumlah = $alkes_jumlah[$i];
              $pengembalian->save();
            }
          }
        }

        if(is_array($matkes))
        {
          foreach ($matkes as $i => $item)
          {
            if($item)
            {
              $pengembalian = new Pengembalian;
              $pengembalian->jenis = 'matkes';
              $pengembalian->operasi_id = $transaksi->id;
              $pengembalian->item_id = $item;
              $pengembalian->jumlah = $matkes_jumlah[$i];
              $pengembalian->save();

              $id_obat[] = $item;
              $jumlah[] = $pengembalian->jumlah;
            }
          }
        }

        if(is_array($obat))
        {
          foreach ($obat as $i => $item)
          {
            if($item)
            {
              $pengembalian = new Pengembalian;
              $pengembalian->jenis = 'obat';
              $pengembalian->operasi_id = $transaksi->id;
              $pengembalian->item_id = $item;
              $pengembalian->jumlah = $obat_jumlah[$i];
              $pengembalian->save();

              $id_obat[] = $item;
              $jumlah[] = $pengembalian->jumlah;
            }
          }
        }

        if(is_array($implan))
        {
          foreach ($implan as $i => $item)
          {
            if($item)
            {
              $pengembalian = new Pengembalian;
              $pengembalian->jenis = 'implan';
              $pengembalian->operasi_id = $transaksi->id;
              $pengembalian->item_id = $item;
              $pengembalian->jumlah = $implan_jumlah[$i];
              $pengembalian->save();
              
              $id_obat[] = $item;
              $jumlah[] = $pengembalian->jumlah;
            }
          }
        }

        
        // $depo_bedah_sentral = Farmasi::where('slug', 'depo-bedah-sentral')->first();

        // $additional_data = [
        //   'farmasi_id' => $transaksi->ruangan->farmasi->id,
        //   'type' => 'Retur',
        //   'client' =>  $depo_bedah_sentral->id,
        //   'keterangan' => 'Rencana Kamar Operasi',
        //   'barang' => $id_obat,
        //   'jumlah' => $jumlah,
        //   'no_redirect' => true
        // ];

        // $request->request->add($additional_data);
        //OK tidak perlu melakukan pengembalian alat cukup via transaksi aja bisa di retur atau di edit
        //$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\CreateController')->createForeign($request);
        //Untuk edit(jangan lupa 'transaksi_id' nya)
        //$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\EditController')->editForeign($request);
        
        $data_cssd['type'] = 2; //1 UNTUK PERMINTAAN 2 UNTUK PENGEMBALIAN
        $data_cssd['ok_transaksi_id'] = $request->id; //ID TRANSAKSI KAMAR OPERASI
        $data_cssd['keterangan'] = 'Permintaan Melalui Rencana Kamar Operasi'; // KETERANGAN ISI SENDIRI BIASANYA SI PERMINTAAN MELALUI KAMAR OPERASI

        $data_cssd_detail['alkes_id'] = $request->alkes_pengembalian; //ARRAY ID_ALKES DARI DB CSSD TABEL ALKES
        $data_cssd_detail['alkes_jumlah'] = $request->alkes_jumlah_pengembalian; //JUMLAH UNTUK MASING MASING ALKES

        $cssd = app('App\Http\Controllers\CSSD\Transaksi\PostController')->ApiTransaksiBaru($data_cssd,$data_cssd_detail);


        $transaksi->pengembalian_alat_id = $cssd->id;
        $transaksi->save();
        $connection->commit();
        $connection_cssd->commit();
        $connection_farmasi->commit();

        $message = 'Hasil Operasi Berhasil Diperbaharui.';
       	$title = 'Berhasil!';
        $status = 1;

    		return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id.'#hasil_operasi')
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);
      } catch (\Exception $e) {

        app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        $connection->rollback();
        $connection_cssd->rollback();
        $connection_farmasi->rollback();
        

        $message = 'An error occured.';
       	$title = 'Error';
        $status = -1;

    		return redirect('kamaroperasi/pelaksanaan/'.$transaksi->id.'#hasil_operasi')
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);
      }
    }
}
