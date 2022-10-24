<?php

namespace App\Http\Controllers\Farmasi\StokOpname;

use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\LogPenghapusan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Penghapusan;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\StokOpname;
use App\Models\Farmasi\OpnameDetail;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
    {   
        //dd($request);
        $id = $request->input('id');
        $qty = $request->input('jumlah');
        $refer = $request->input('detail_refer');
        $keterangan = $request->input('keterangan');

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = StokOpname::find($id);
            
            $i=0;
            foreach ($transaction->opname_detail as $opname) {
                $flag=0;
                for($i=0;$i<count($refer);$i++) {
                    if($opname->id == $refer[$i]) {
                        $opname->jumlah = $qty[$i];
                        $opname->keterangan = $keterangan[$i];
                        $opname->save();
                        $flag++;
                        break;
                    }
                }
                if(!$flag) $opname->delete();
            }

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/stokopname/'.$transaction->slug.'/'.$request->flag)
                    ->with('status', 1)
                      ->with('message', 'Stok Opname berhasil diubah')
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

    public function add(Request $request, $farmasi)
    {   
        //dd($request);
        $id = $request->input('id');
        $description = $request->input('deskripsi');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $kadaluarsa = $request->input('kadaluarsa');
        $keterangan = $request->input('keterangan');

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        if($request->live == 1)
        {
            app('App\Http\Controllers\Farmasi\Items\EditController')->recalculateStok($items);
        }

        DB::connection('farmasi')->beginTransaction();

        try
        {
            if($request->live == 1)
            {
                $item = ItemsFarmasi::with(['item_detail', 'items_available'])->where('id', $items)->first();
                $this->confirmLive($item, $farm, $request->all());
                DB::connection('farmasi')->commit();
                return back()
                        ->with('status', 1)
                        ->with('message', 'Stok Opname berhasil ditambahkan')
                        ->with('title', 'Sukses');
            }else{
                $transaction = StokOpname::find($id);
                $transaction->keterangan = $description;
                $transaction->save();
                
                $i=0;
                foreach ($items as $item) {
                    $date = Carbon::createFromFormat('d/m/Y', $kadaluarsa[$i])->toDateTimeString();

                    $detail = new OpnameDetail;
                    $detail->keterangan = $keterangan[$i];
                    $detail->jumlah = $qty[$i];
                    $detail->farmasi_id = $farm->id;
                    $detail->item_id = $item;
                    $detail->kadaluarsa = $date;
                    $detail->stok_opname_id = $transaction->id;
                    $detail->created_by = Auth::user()->id;
                    $detail->save();
                    $i++;
                }
            }
            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/stokopname/'.$transaction->slug.'/'.$request->flag)
                    ->with('status', 1)
                    ->with('message', 'Detail Stok Opname berhasil ditambahkan')
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

    public function confirmLive($item_farmasi, $farm, $request)
    {
        $items = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaanSingle($item_farmasi, $request);
        // dd($items, $farm, $request);
        $penghapusan = new Penghapusan;
        $penghapusan->keterangan = "Stok Opname Live";
        $penghapusan->farmasi_id = $farm->id;
        $penghapusan->stok_opname_id = null;
        $penghapusan->created_by = Auth::user()->id;
        $penghapusan->save();
        $penghapusan->slug = str_pad($penghapusan->id, 10, '0', STR_PAD_LEFT);
        $penghapusan->save();

        $distribusi = new Distribusi;
        $distribusi->kategori = 'Kiriman';
        $distribusi->farmasi_id = $farm->id;
        $distribusi->unit_tujuan = $farm->id;
        $distribusi->stok_opname_id = null;
        $distribusi->deskripsi = 'Stok Opname Live';
        $distribusi->tipe = 1;
        $distribusi->status = 2;
        $distribusi->created_by = Auth::user()->id;
        $distribusi->verified_by = Auth::user()->id;
        $distribusi->save();
        $distribusi->slug = str_pad($distribusi->id, 10, '0', STR_PAD_LEFT);
        $distribusi->save();

        $transaction = new StokOpname;
        $transaction->keterangan = 'Stok Opname Live';
        $transaction->farmasi_id = $farm->id;
        $transaction->status = 1;
        $transaction->created_by = Auth::user()->id;
        $transaction->distribusi_id = $distribusi->id;
        $transaction->penghapusan_id = $penghapusan->id;
        $transaction->flag = 1;
        $transaction->save();
        $transaction->slug = str_pad($transaction->id, 10, '0', STR_PAD_LEFT);
        $transaction->save();
        $i=0;
        foreach ($request['barang'] as $item) {
            $date = Carbon::createFromFormat('d/m/Y', $request['kadaluarsa'][$i])->toDateTimeString();

            $detail = new OpnameDetail;
            $detail->keterangan = $request['keterangan'][$i];
            $detail->jumlah = $request['jumlah'][$i];
            $detail->farmasi_id = $farm->id;
            $detail->item_id = $item;
            $detail->kadaluarsa = $date;
            $detail->stok_opname_id = $transaction->id;
            $detail->created_by = Auth::user()->id;
            $detail->save();
            $i++;
        }
        
        $total = 0;
        $i = 0;
        $hapus = 0;
        $tambah = 0;
        foreach($items as $item)
        {
            // dd($item);
            //$temp = Items::find($item);
            if($item['beda'] == 0) {
                $i++;
                continue;
            }
            else if($item['beda'] > 0)
            {   
                $tambah++;
                $jumlah = $item['beda'];
                $log = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item['item_id'],$jumlah,$item['kadaluarsa'],$farm->id,$distribusi->id);
                $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogMasuk($log,$jumlah,$distribusi->id);
                // dd($log, $item, $jumlah, $distribusi, $subtotal, $tambah);
                $total+=$subtotal;
            }
            else
            {
                $hapus++;
                $jumlah = $item['beda'];
                // dd($jumlah);
                app('App\Http\Controllers\Farmasi\LogPenghapusan\CreateController')->createLog($item['log_id'],abs($jumlah),$penghapusan->id);
            }
            $i++;
        }
        if(!$hapus) $penghapusan->delete();
        if(!$tambah) $distribusi->delete();
    }
    public function confirm(Request $request, $farmasi)
    {   
        $id = $request->input('id');

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = StokOpname::find($id);
            $transaction->status = 1;
            $transaction->save();
            $items = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaan($transaction->id);
            $penghapusan = new Penghapusan;
            $penghapusan->keterangan = "Stok Opname";
            $penghapusan->farmasi_id = $farm->id;
            $penghapusan->stok_opname_id = $transaction->id;
            $penghapusan->created_by = Auth::user()->id;
            $penghapusan->save();
            $penghapusan->slug = str_pad($penghapusan->id, 10, '0', STR_PAD_LEFT);
            $penghapusan->save();

            $distribusi = new Distribusi;
            //$transaction->client = $client;
            $distribusi->kategori = 'Kiriman';
            $distribusi->farmasi_id = $farm->id;
            $distribusi->unit_tujuan = $farm->id;
            $distribusi->stok_opname_id = $transaction->id;
            $distribusi->deskripsi = 'Stok Opname';
            $distribusi->tipe = 1;
            $distribusi->status = 2;
            $distribusi->created_by = Auth::user()->id;
            $distribusi->verified_by = Auth::user()->id;
            $distribusi->save();
            $distribusi->slug = str_pad($distribusi->id, 10, '0', STR_PAD_LEFT);
            $distribusi->save();
            
            $total = 0;
            $i = 0;
            $hapus = 0;
            $tambah = 0;
            // dd($items);
            $log_distribusi = [];
            $log_penghapusan = [];

            foreach($items as $index => $item)
            {
                //dd($item);
                //$temp = Items::find($item);
                if($item['beda'] == 0) {
                    $i++;
                    continue;
                }
                else if($item['beda'] > 0)
                {   
                    $tambah++;
                    $jumlah = $item['beda'];
                    $log = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item['item_id'],$jumlah,date('d/m/Y', strtotime($item['kadaluarsa'])),$farm->id,$distribusi->id);
                    //$subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogMasuk($log,$jumlah,$distribusi->id);
                    $new_log = array(
                        'item_id' => $log->id,
                        'jumlah' => $jumlah,
                        'jenis' => 1,
                        'alasan_ditolak' => null,
                        'tipe' => 1,
                        'distribusi_id' => $distribusi->id,
                        'subtotal' => $log->detail_item->item_detail->harga * $jumlah,
                        'jumlah_setelah_distribusi' => $log->jumlah,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    );

                    $total+= $new_log['subtotal'];
                    $log_distribusi []= $new_log;
                }
                else
                {
                    $hapus++;
                    $jumlah = $item['beda'];
                    // dd($jumlah);
                    //app('App\Http\Controllers\Farmasi\LogPenghapusan\CreateController')->createLog($item['log_id'],abs($jumlah),$penghapusan->id);
                    $items_hapus = Items::with('detail_item.item_detail')->where('id', $item['log_id'])->first();
                    if($items_hapus){
                        $new_log = array(
                            'item_id' => $items_hapus->id,
                            'penghapusan_id' => $penghapusan->id,
                            'jumlah' => abs($jumlah),
                            'subtotal' => $items_hapus->detail_item->item_detail->harga * abs($jumlah),
                            'created_at' => $request->tanggal ?? Carbon::now()->toDateTimeString(),
                            'updated_at' => $request->tanggal ?? Carbon::now()->toDateTimeString(),
                        );
                        $items_hapus->jumlah -= abs($jumlah);
                        $new_log['jumlah_setelah_penghapusan'] = $items_hapus->jumlah;

                        $items_hapus->save();
                        $log_penghapusan []= $new_log;

                    }
                }
                $i++;
            }
            // dd('abc');

            foreach(array_chunk($log_distribusi, 1000) as $chunked){
                LogDistribusi::insert($chunked);
            }

            foreach(array_chunk($log_penghapusan, 1000) as $chunked){
                LogPenghapusan::insert($chunked);
            }

            if(!$hapus) $penghapusan->delete();
            else $transaction->penghapusan_id = $penghapusan->id;
            if(!$tambah) $distribusi->delete();
            else $transaction->distribusi_id = $distribusi->id;
            $transaction->save();
            // dd($transaction);
            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/stokopname/'.$transaction->slug.'/'.$transaction->flag)
                    ->with('status', 1)
                      ->with('message', 'Konfirmasi Stok Opname berhasil dilakukan')
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

    public function editFix(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();

        $id = $request->id;
        $transaction = StokOpname::find($id);
        try
        {
            $changes = json_decode($request->changes);
            foreach ($changes as $change) {
                $opname = OpnameDetail::find($change->id);
                if($opname){
                    if($change->type == 1){
                        $opname->jumlah = $change->jumlah;
                        $opname->keterangan = $change->keterangan;
                        $opname->save();
                    }
                    else{
                        $opname->delete();
                    }
                }
            }

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/stokopname/'.$transaction->slug.'/'.$transaction->flag)
                    ->with('status', 1)
                      ->with('message', 'Perubahan Stok Opname berhasil dilakukan')
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
}
