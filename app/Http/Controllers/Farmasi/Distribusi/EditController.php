<?php

namespace App\Http\Controllers\Farmasi\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Distribusi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Gudang\Distribusi as GudangDistribusi;
use Illuminate\Http\Response;
use DB;
use Carbon\Carbon;
use Auth;
use Bugsnag;
use DateTime;

class EditController extends Controller
{
    public function confirm($request)
    {
        $id = $request->ptr;
        //$changed = $request->input('form_changed');
        $description = $request->input('keterangan');
        $transaction = Distribusi::find($id);

        $trans_id = $request->trans_id;
        $trans_slug = $request->slug;

        $distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getSingle($trans_slug);
        //$details = $transactions->transaction_detail;
        
        $transaction->status = 1;
        $transaction->deskripsi = $description;
        $transaction->save();

            //if($changed)
            //{
        /*foreach($transaction->log as $det)
        {
            app('App\Http\Controllers\Farmasi\Items\DeleteController')->deleteLog($det->id);
        }

        foreach($distribusi->log as $det)
        {
            $temp = ItemsFarmasi::where('item_template_id', $det->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
            app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
        }*/

    }

    //dipakai
    public function konfirmasiPermintaan(Request $request,$farmasi)
    {
        ini_set('max_execution_time', 300);
        $id = $request->input('id');
        $description = $request->input('keterangan');
        $refer = $request->input('refer');
        $items_farmasi = $request->input('barang');
        $qty = $request->input('jumlah');
        $expired = $request->input('expired');
        $transaction = Distribusi::find($id);
        if($transaction->status == 1){
        $msg = 'Permintaan barang telah dikirimkan';
                return redirect('farmasi/'.$farmasi.'/distribusi/'.$transaction->slug)
            ->with('status', 1)
            ->with('message', $msg)
            ->with('title', 'Sukses');
        }
        $this->updateStatus($id,$status = 1);
        try
        {
            DB::connection('farmasi')->beginTransaction();
            $transaction->deskripsi = $description;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            $transaction->status = 1;
            $transaction->save();

            $i = 0;
            $total = 0;
            foreach($items_farmasi as $item_farmasi)
            {
                if(is_numeric($item_farmasi))
                {
                    if(!is_null($qty[$i])) {
                        $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogKeluarTanpaMengurangi($item_farmasi,$qty[$i],$transaction->id);
                    }
                }
                $i++;
                $total+=$subtotal;
            }

            $transaction_ptr = Distribusi::find($transaction->transaksi_ptr);
            $transaction_ptr->status = 1;
            $transaction_ptr->deskripsi = $description;
            $transaction_ptr->save();

            $msg = 'Permintaan barang telah dikirimkan';
            $transaction->total_harga = $total;
            $transaction->save(); 

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/distribusi/'.$transaction->slug)
                        ->with('status', 1)
                        ->with('message', $msg)
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();
            $this->updateStatus($id,$status=0);

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }

    public function editTerkirim(Request $request ,$farmasi)
    {
        ini_set('max_execution_time', 300);
        
        $id = $request->input('id');
        $description = $request->input('keterangan');
        $template = $request->input('template');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = Distribusi::find($id);

            if($transaction->status == 2){
                DB::connection('farmasi')->rollBack();
                $msg = 'Barang sudah diterima';
                return back()
                    ->with('status', -1)
                    ->with('message', $msg)
                    ->with('title', 'Gagal');
            }elseif($transaction->status == -1)
            {
                DB::connection('farmasi')->rollBack();
                $msg = 'Distribusi telah ditolak';
                return back()
                    ->with('status', -1)
                    ->with('message', $msg)
                    ->with('title', 'Gagal');
            }
            //$transaction->client = $client;
            //$transaction->type = $type;
            $transaction->deskripsi = $description;
            //$transaction->category = $category;
            //$transaction->referral_number = $referral_number;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            $transaction->save();
            foreach($transaction->log as $log)
            {
                app('App\Http\Controllers\Farmasi\LogDistribusi\DeleteController')->deleteLog($log->id, 1);
            }
            
            $i = 0;
            $total = 0;
            foreach($items as $item)
            {
                if(is_numeric($item))
                {
                    if(!is_null($qty[$i])) {
                        $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogKeluar($item,$qty[$i],$transaction->id);
                    }
                }
                $i++;
                $total += $subtotal;
            }
            $msg = 'Barang Permintaan Berhasil Diubah';
            $transaction->total_harga = $total;
            $transaction->save();

            $request->ptr = $transaction->transaksi_ptr;
            $request->trans_id = $transaction->id;
            $request->slug = $transaction->slug;

            if($transaction->kategori == 'Retur') {
                if($transaction->unit_tujuan) $this->editRetur($request);
                else app('App\Http\Controllers\Gudang\Distribusi\EditController')->editRetur($request);
            }
            else {
                $description = $request->input('keterangan');
                $transaction_ptr = Distribusi::find($transaction->transaksi_ptr);
                
                $transaction_ptr->status = 1;
                $transaction_ptr->deskripsi = $description;
                $transaction_ptr->save();
            }

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/distribusi/'.$transaction->slug)
                        ->with('status', 1)
                        ->with('message', $msg)
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

    public function konfirmasiTerima(Request $request)
    {
        $id = $request->input('id');
        $items = $request->input('barang');
        $itemFarmasis = $request->input('template');
        $log_pengadaan_id = $request->input('log_pengadaan_id');
        $log_distribusi_id = $request->input('log_distribusi_id');
        $qty = $request->input('jumlah');
        $description = $request->input('keterangan');
        $alasans = $request->input('alasan');
        $ditolaks = $request->input('ditolak');
        $changed = $request->input('form_changed');
        $transaction = Distribusi::find($id);

        if($transaction->status==2){
            $msg = 'Verifikasi Barang baru telah dilakukan';
            return redirect('farmasi/'.$transaction->owner_detail->slug.'/distribusi/'.$transaction->slug)
                ->with('status', 1)
                ->with('message', $msg)
                ->with('title', 'Sukses');
        }
        $this->updateStatus($id,$status=2);

        DB::connection('farmasi')->beginTransaction();
        try {
            $transaction->status = 2;
            //$transaction->deskripsi = $description;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            $transaction->save();

            $transaction_ptr = $transaction->distribusi_detail;
            $transaction_ptr->status = 2;
            $transaction_ptr->save();

            // if($transaction->unit_tujuan){
                // $distribusi = Distribusi::find($transaction->transaksi_ptr);
                // $distribusi->status = 2;
                // $distribusi->verified_at = date('Y-m-d H:i:s');
                // $distribusi->save();  
            // }
            // else{
            //     $distribusi = GudangDistribusi::find($transaction->transaksi_ptr);
            //     $distribusi->status = 2;
            //     $distribusi->save();
            // }

            $total=0;
            // if($transaction->tipe == 1) {
                // if(!$transaction->unit_tujuan)
                // {
                //     foreach ($distribusi->log as $log) {
                //         $temp = ItemsFarmasi::where('item_template_id', $log->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
                //         $item = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($temp->id,$log->jumlah,date('d/m/Y', strtotime($log->detail_item->kadaluarsa)),$transaction->farmasi_id, null, $log->detail_item->log_pengadaan_id);
                //         $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogMasuk($item,$log->jumlah,$transaction->id);
                //         $total+=$subtotal;
                //     }
                // }
                // else
                // {
                    foreach ($itemFarmasis as $index => $itemFarmasi) {
                        $itemFarmasiLama = ItemsFarmasi::find($itemFarmasi);
                        $itemFarmasiBaru = ItemsFarmasi::where('item_template_id', $itemFarmasiLama->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
                        

                        if($ditolaks[$index]){
                            $jumlah = 0;
                            $alasan = $alasans[$index];
                        }else{
                            $jumlah = $qty[$index];
                            $alasan = null;
                        }
                        if($transaction->kategori == 'Permintaan'){
                            $itemLama = app('App\Http\Controllers\Farmasi\Items\EditController')->verifyKeluar($items[$index],
                            $jumlah);
                        }else{
                            $itemLama = app('App\Http\Controllers\Farmasi\Items\EditController')->verifyKeluarKiriman($items[$index],
                                $jumlah,$log_distribusi_id[$index]);
                        }
                        $kadaluarsa = Carbon::createFromFormat('Y-m-d H:i:s', $itemLama->kadaluarsa)->format('d/m/Y');
                        $itemBaru = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($itemFarmasiBaru->id,
                            $jumlah,
                            $kadaluarsa,
                            $transaction->farmasi_id, null,
                            $log_pengadaan_id[$index]);

                        app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createFixLogKeluar($log_distribusi_id[$index],$jumlah,$alasan);

                        $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLogMasuk($itemBaru,$jumlah,$transaction->id, $alasan);
                        $total+=$subtotal;
                    }
                // }
                $msg = 'Verifikasi Barang baru telah dilakukan';
                $transaction->total_harga = $total;
                $transaction->save();
            // } else {
            //     $i = 0;
            //     $total = 0;
            //     foreach($items as $item)
            //     {
            //         if(is_numeric($item))
            //         {
            //             if(!is_null($qty[$i])) {
            //                 $subtotal = app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createLog($item,$qty[$i],$transaction->id);
            //             }
            //         }
            //         $i++;
            //         $total+=$subtotal;
            //     }
            //     $request->ptr = $transaction->transaksi_ptr;
            //     $request->slug = $transaction->slug;
            //     $request->trans_id = $transaction->id;
            //     $this->receive($request);
            //     $msg = 'Permintaan barang telah dikirimkan';
            //     $transaction->total_harga = $total;
            //     $transaction->save();
            // }

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$transaction->owner_detail->slug.'/distribusi/'.$transaction->slug)
                        ->with('status', 1)
                        ->with('message', $msg)
                        ->with('title', 'Sukses');
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();
            $this->updateStatus($id,$status=1);
            
            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
            //return redirect('apotek/transaction/'.$transaction->slug)->with('status', 'Terjadi kesalahan server');
        }

    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $farmasi = $request->input('farmasi');
        $description = $request->input('keterangan');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');


        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = Distribusi::find($id);
            if($transaction->status == 2){
                DB::connection('farmasi')->rollBack();
                $msg = 'Barang sudah diterima';
                return back()
                    ->with('status', -1)
                    ->with('message', $msg)
                    ->with('title', 'Gagal');
            }
            $transaction->deskripsi = $description;
            //$transaction->created_by = Auth::user()->id;

            foreach($transaction->draft as $draft)
            {
                app('App\Http\Controllers\Farmasi\LogDistribusi\DeleteController')->deleteLog($draft->id);
            }

            $total = 0;
            $i = 0;
            if(!empty($items))
            foreach($items as $item)
            {
                app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createDraft($item,$qty[$i],$transaction->id,$transaction->unit_tujuan);
                $i++;
            }

            //$transaction->total_price = $total;
            $transaction->save();

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/distribusi/'.$transaction->slug)
                        ->with('status', 1)
                        ->with('message', 'Permintaan berhasil diubah')
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

    public function reject(Request $request)
    {
        $transaction_id = $request->ptr;
        $explanation = $request->input('explanation');

        $transaction = Distribusi::find($transaction_id);
        $transaction->status = -1;
        $transaction->deskripsi = $explanation;
        $transaction->verified_by = Auth::user()->id;
        $transaction->verified_at = date('Y-m-d H:i:s');
        foreach ($transaction->log as $log){
            $log->jenis = 0;
            $log->save();
            if($transaction->kategori != 'Permintaan'){
                $items = Items::find($log->item_id);
                $items->jumlah += $log->jumlah;
                $items->save();
            }
        }

        $transaction->save();
    }

    public function rejectOwn(Request $request)
    {
        $transaction_id = $request->input('id');
        $farm = $request->farmasi;
        $explanation = $request->input('explanation');

        DB::connection('farmasi')->beginTransaction();

        try {
            $transaction = Distribusi::find($transaction_id);
            $transaction->status = -1;
            $transaction->deskripsi = $explanation;
            $transaction->verified_by = Auth::user()->id;
            $transaction->save();

            $request->ptr = $transaction->transaksi_ptr;
            $request->trans_id = $transaction->id;
            $request->slug = $transaction->slug;

            app('App\Http\Controllers\Farmasi\Distribusi\EditController')->reject($request); 

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farm.'/distribusi/'.$transaction->slug)
                            ->with('status', 1)
                            ->with('message', 'Permintaan berhasil ditolak')
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


    public function editRetur($request)
    {
        $id = $request->ptr;
        //$changed = $request->input('form_changed');
        $description = $request->input('keterangan');
        $transaction = Distribusi::find($id);

        $trans_id = $request->trans_id;
        $trans_slug = $request->slug;

        $distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($trans_slug);
        //$details = $transactions->transaction_detail;
        
        $transaction->status = 1;
        $transaction->deskripsi = $description;
        $transaction->save();

            //if($changed)
            //{
        /*foreach($transaction->draft as $det)
        {
            app('App\Http\Controllers\Farmasi\LogDistribusi\DeleteController')->deleteLog($det->id,0);
        }
        
        foreach($distribusi->record as $det)
        {
            $item_farmasi = ItemsFarmasi::where('item_template_id', $det->detail_item->detail_item->item_template_id)->where('farmasi_id', $transaction->farmasi_id)->first();
            $temp = Items::where('item_farmasi_id', $item_farmasi->id)->whereDate('kadaluarsa',date('Y-m-d', strtotime($det->detail_item->kadaluarsa)))->first();

            if(is_null($temp)) {
                $item = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item_farmasi->id, $det->jumlah, $transaction->id, $det->detail_item->kadaluarsa);
                app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createDraftRetur($item->id,$det->jumlah,$transaction->id);
            }
            else {
                app('App\Http\Controllers\Farmasi\LogDistribusi\CreateController')->createDraftRetur($temp->id,$det->jumlah,$transaction->id);
            }
        }*/

            //}

    }

    public function updateStatus($id,$status)
    {
        DB::connection('farmasi')->beginTransaction();
        $transaction = Distribusi::find($id);
        $transaction->status = $status;
        $transaction->save();
        DB::connection('farmasi')->commit();
    }
}
