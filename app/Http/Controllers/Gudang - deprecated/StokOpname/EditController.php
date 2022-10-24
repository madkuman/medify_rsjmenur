<?php

namespace App\Http\Controllers\Gudang\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Penghapusan;
use App\Models\Gudang\Distribusi;
use App\Models\Gudang\StokOpname;
use App\Models\Gudang\OpnameDetail;
use App\Models\Gudang\Items;
use App\Models\Gudang\ItemsTemplate;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{
    public function edit(Request $request)
    {   
        //dd($request);
        $id = $request->input('id');
        $qty = $request->input('jumlah');
        $refer = $request->input('detail_refer');
        $keterangan = $request->input('keterangan');
        $harga = $request->harga;

        

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
                        $opname->harga = $harga[$i];
                        $opname->save();
                        $flag++;
                        break;
                    }
                }
                if(!$flag) $opname->delete();
            }

            
            return redirect('gudang/stokopname/'.$transaction->slug.'/'.$request->flag)
                    ->with('status', 1)
                    ->with('message', 'Stok Opname berhasil diubah')
                    ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function add(Request $request)
    {   
        //dd($request);
        $id = $request->input('id');
        $description = $request->input('deskripsi');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $kadaluarsa = $request->input('kadaluarsa');
        $keterangan = $request->input('keterangan');
        $harga = $request->harga;

        

        try
        {
            if($request->live == 1)
            {
                $item = Items::with('detail_item')->where('item_template_id', $items)->get();
                $this->confirmLive($item, $request->all());
                
                return back()
                        ->with('status', 1)
                        ->with('message', 'Stok Opname berhasil ditambahkan')
                        ->with('title', 'Sukses');
            }

            $transaction = StokOpname::find($id);
            $transaction->keterangan = $description;
            $transaction->save();
            
            $i=0;
            foreach ($items as $item) {
                $date = Carbon::createFromFormat('d/m/Y', $kadaluarsa[$i])->toDateTimeString();

                $detail = new OpnameDetail;
                $detail->keterangan = $keterangan[$i];
                $detail->jumlah = $qty[$i];
                $detail->item_id = $item;
                $detail->kadaluarsa = $date;
                $detail->stok_opname_id = $transaction->id;
                $detail->created_by = Auth::user()->id;

                $detail->harga = $harga[$i];

                $detail->save();
                $i++;
            }

            
            return redirect('gudang/stokopname/'.$transaction->slug.'/'.$request->flag)
                    ->with('status', 1)
                    ->with('message', 'Detail Stok Opname berhasil ditambahkan')
                    ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function confirmLive($item_gudang, $request)
    {   
        // dd($items, $farm, $request);
        try{
            $items = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getPerbedaanSingle($item_gudang, $request);
            // dd($items, $item, $request);
            $penghapusan = new Penghapusan;
            $penghapusan->keterangan = "Stok Opname Satuan";
            $penghapusan->stok_opname_id = null;
            $penghapusan->created_by = Auth::user()->id;
            $penghapusan->save();
            $penghapusan->slug = str_pad($penghapusan->id, 10, '0', STR_PAD_LEFT);
            $penghapusan->save();

            $distribusi = new Distribusi;
            //$transaction->client = $client;
            $distribusi->kategori = 'Kiriman';
            $distribusi->farmasi_id = 0;
            $distribusi->stok_opname_id = null;
            $distribusi->deskripsi = 'Stok Opname Satuan';
            $distribusi->tipe = 1;
            $distribusi->status = 2;
            $distribusi->created_by = Auth::user()->id;
            $distribusi->verified_by = Auth::user()->id;
            $distribusi->verified_at = date('Y-m-d H:i:s');
            $distribusi->save();
            $distribusi->slug = str_pad($distribusi->id, 10, '0', STR_PAD_LEFT);
            $distribusi->save();
            
            $total = 0;
            $i = 0;
            $hapus = 0;
            $tambah = 0;
                // dd($items, $request);
            foreach($items as $item)
            {
                //$temp = Items::find($item);
                if($item['beda'] == 0) {
                    $i++;
                    continue;
                }
                else if($item['beda'] > 0)
                {   
                    $tambah++;
                    $jumlah = $item['beda'];
                    // $item['kadaluarsa'] = str_replace("/", "-", $item['kadaluarsa']);
                    if (strpos($item['kadaluarsa'], '/') !== false)
                        $date = $item['kadaluarsa'];
                    else
                        $date = date('d/m/Y', strtotime($item['kadaluarsa']));
                    
                    $log = app('App\Http\Controllers\Gudang\Items\CreateController')->newItem($item['item_id'],$jumlah, $date, $item['harga']);
                    $subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLogMasuk($log->id,$jumlah,$distribusi->id);
                    // dd($log, $item, $jumlah, $distribusi, $subtotal, $tambah);
                    $total+=$subtotal;
                }
                else
                {
                    $hapus++;
                    $jumlah = $item['beda'];
                    // dd($jumlah);
                    

                    app('App\Http\Controllers\Gudang\LogPenghapusan\CreateController')->createLog($item['log_id'],abs($jumlah),$penghapusan->id);
                }
                $i++;
                if($item['sebenarnya'] > 0){
                    $log_id = array_key_exists("log_id", $item) ? $item['log_id'] : 0;
                    app('App\Http\Controllers\Gudang\Items\EditController')->editHarga($log_id, $item['item_id'], $item['harga']);   
                }
                $i++;
            } // dd('abc');
            if(!$hapus) $penghapusan->delete();
            if(!$tambah) $distribusi->delete();
            // dd($item_gudang);
            
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function confirm(Request $request)
    {   
        $id = $request->input('id');

        

        try
        {
            $transaction = StokOpname::find($id);
            $transaction->status = 1;
            $transaction->save();
            $items = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getPerbedaan($transaction->id);
            // dd($items);
            $penghapusan = new Penghapusan;
            $penghapusan->keterangan = "Stok Opname";
            $penghapusan->stok_opname_id = $transaction->id;
            $penghapusan->created_by = Auth::user()->id;
            $penghapusan->save();
            $penghapusan->slug = str_pad($penghapusan->id, 10, '0', STR_PAD_LEFT);
            $penghapusan->save();

            $distribusi = new Distribusi;
            //$transaction->client = $client;
            $distribusi->kategori = 'Kiriman';
            $distribusi->farmasi_id = 0;
            $distribusi->stok_opname_id = $transaction->id;
            $distribusi->deskripsi = 'Stok Opname';
            $distribusi->tipe = 1;
            $distribusi->status = 2;
            $distribusi->created_by = Auth::user()->id;
            $distribusi->verified_by = Auth::user()->id;
            $distribusi->verified_at = date('Y-m-d H:i:s');
            $distribusi->save();
            $distribusi->slug = str_pad($distribusi->id, 10, '0', STR_PAD_LEFT);
            $distribusi->save();
            
            $total = 0;
            $i = 0;
            $hapus = 0;
            $tambah = 0;
            foreach($items as $item)
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
                    $log = app('App\Http\Controllers\Gudang\Items\CreateController')->newItem($item['item_id'],$jumlah,date('d/m/Y', strtotime($item['kadaluarsa'])), $item['harga']);
                    $subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLogMasuk($log->id,$jumlah,$distribusi->id);
                    $total+=$subtotal;
                }
                else
                {
                    $hapus++;
                    $jumlah = $item['beda'];
                    // dd($jumlah);
                    app('App\Http\Controllers\Gudang\LogPenghapusan\CreateController')->createLog($item['log_id'],abs($jumlah),$penghapusan->id);
                }
                if($item['sebenarnya'] > 0){
                    $log_id = array_key_exists("log_id", $item) ? $item['log_id'] : 0;
                    app('App\Http\Controllers\Gudang\Items\EditController')->editHarga($log_id, $item['item_id'], $item['harga']);   
                }
                $i++;
            }
            // dd('abc');
            if(!$hapus) $penghapusan->delete();
            else $transaction->penghapusan_id = $penghapusan->id;
            if(!$tambah) $distribusi->delete();
            else $transaction->distribusi_id = $distribusi->id;
            $transaction->save();
            // dd($transaction);
            
            return redirect('gudang/stokopname/'.$transaction->slug.'/'.$transaction->flag)
                    ->with('status', 1)
                    ->with('message', 'Konfirmasi Stok Opname berhasil dilakukan')
                    ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }


    public function editFix(Request $request)
    {
        

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
                        $opname->harga = $change->harga;
                        $opname->save();
                    }
                    else{
                        $opname->delete();
                    }
                }
            }

            
            return back()
                    ->with('status', 1)
                      ->with('message', 'Perubahan Stok Opname berhasil dilakukan')
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }

    }
}
