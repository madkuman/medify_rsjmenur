<?php

namespace App\Http\Controllers\Gudang\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Distribusi;
use App\Models\Gudang\Items;
use App\Models\Farmasi\Distribusi as FarmasiDistribusi;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{
    public function confirm(Request $request)
    {
        //dd($request);
        ini_set('max_execution_time', 300);
        
        $id = $request->input('id');
        //$client = $request->input('client');
        //$type = $request->input('type');
        $description = $request->input('keterangan');
        //$category = $request->input('category');
        //$changed = $request->input('form_changed');
        $refer = $request->input('refer');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $expired = $request->input('expired');

        
        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = Distribusi::find($id);
            //$transaction->client = $client;
            //$transaction->type = $type;
            $transaction->deskripsi = $description;
            //$transaction->category = $category;
            //$transaction->referral_number = $referral_number;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            
            if($id)
            {
                $transaction->status = 1;
                $transaction->save();
                if($transaction->tipe == 1)
                {
                    $total = 0;
                    $i = 0;
                    foreach($refer as $ref)
                    {
                        if($transaction->kategori == 'Retur') $subtotal = app('App\Http\Controllers\Gudang\Items\EditController')->verifyRetur($ref,$items[$i],$qty[$i],$expired[$i]);
                        $i++;
                        $total+=$subtotal;
                    }

                    $j=0;
                    foreach ($items as $item) 
                    {
                        if($j>=$i) {
                            $date = Carbon::createFromFormat('d/m/Y', $expired[$j])->toDateTimeString();
                            $new = app('App\Http\Controllers\Gudang\Items\CreateController')->newReturItem($item,$qty[$j],$date);
                            $new->jumlah_sedia = $qty[$j];
                            $new->status = 1;
                            $new->save();

                            $new_log = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createDraftRetur($new->id,$qty[$i],$transaction->id);
                            $new_log->jenis = 1;
                            $new_log->subtotal = $new_log->jumlah * $new->detail_item->harga;
                            $new_log->save();

                            $subtotal = $new_log->subtotal;
                            $total+=$subtotal;
                        }
                        $j++;
                    }
                    $transaction->total_harga = $total;
                    $transaction->save();
                    $msg = 'Konfirmasi barang telah dilakukan';
                }
                else
                {
                    $i = 0;
                    $total = 0;
                    foreach($items as $item)
                    {
                        if(is_numeric($item))
                        {
                            if(!is_null($qty[$i])) {
                                $subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLog($item,$qty[$i],$transaction->id);
                                //dd($log_id);
                            }
                        }
                        $i++;
                        $total += $subtotal;
                    }
                    $msg = 'Permintaan berhasil dikirim';
                    $transaction->total_harga = $total;
                    $transaction->save();

                    $request->ptr = $transaction->transaksi_ptr;
                    $request->trans_id = $transaction->id;
                    $request->slug = $transaction->slug;

                    app('App\Http\Controllers\Farmasi\Distribusi\EditController')->confirm($request); 
                }

            }
            else 
            {
                //
                /*$transaction->status = 1;
                $transaction->update();

                foreach($transaction->transaction_detail as $item)
                {
                    $check = app('App\Http\Controllers\Warehouse\ItemsRecord\CreateController')->createRecord($item->item_id,$item->qty,$item->id);
                    app('App\Http\Controllers\Warehouse\Items\EditController')->changeStock($item->item_id,$item->qty,$type);
                }*/
            }           

            
            DB::connection('farmasi')->commit();
            return redirect('gudang/distribusi/'.$transaction->slug)
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

    public function verify(Request $request)
    {
        //dd($request);
        ini_set('max_execution_time', 300);
        
        $id = $request->input('id');

        
        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = Distribusi::find($id);
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            $transaction->status = 2;
            $transaction->save();

            $distribusi = FarmasiDistribusi::find($transaction->transaksi_ptr);
            $distribusi->status = 2;
            $distribusi->verified_at = date('Y-m-d H:i:s');
            $distribusi->save();

            $total = 0;
            foreach($distribusi->log as $log)
            {
                $item = app('App\Http\Controllers\Gudang\Items\CreateController')->newItem($log->detail_item->detail_item->item_template_id,$log->jumlah,date('d/m/Y', strtotime($log->detail_item->kadaluarsa)));
                $subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLogMasuk($item->id,$log->jumlah,$transaction->id);
                $total+=$subtotal;
            }

            $transaction->total_harga = $total;
            $transaction->save();
            $msg = 'Konfirmasi barang telah dilakukan';
                
            
            DB::connection('farmasi')->commit();
            return redirect('gudang/distribusi/'.$transaction->slug)
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

    public function edit(Request $request)
    {
        //dd($request);
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
            //$transaction->client = $client;
            //$transaction->type = $type;
            $transaction->deskripsi = $description;
            //$transaction->category = $category;
            //$transaction->referral_number = $referral_number;
            // $transaction->verified_by = Auth::user()->id;
            $transaction->save();
            foreach($transaction->log as $log)
            {
                app('App\Http\Controllers\Gudang\LogDistribusi\DeleteController')->deleteLog($log->id, 1);
            }
            
            $i = 0;
            $total = 0;
            foreach($items as $item)
            {
                if(is_numeric($item))
                {
                    if(!is_null($qty[$i])) {
                        $subtotal = app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createLogFix($item,$qty[$i],$transaction->id);
                        //dd($log_id);
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

            app('App\Http\Controllers\Farmasi\Distribusi\EditController')->confirm($request);

            
            DB::connection('farmasi')->commit();
            return redirect('gudang/distribusi/'.$transaction->slug)
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

    public function editRetur($request)
    {
        //dd($request);
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

        //dd($transaction->draft);
        /*foreach($transaction->draft as $det)
        {
            app('App\Http\Controllers\Gudang\LogDistribusi\DeleteController')->deleteLog($det->id,0);
        }
        
        foreach($distribusi->record as $det)
        {
            $temp = Items::where('item_template_id', $det->detail_item->detail_item->item_template_id)->whereDate('kadaluarsa',date('Y-m-d', strtotime($det->detail_item->kadaluarsa)))->first();
            
            if(is_null($temp)) {
                $item = app('App\Http\Controllers\Gudang\Items\CreateController')->newReturItem($det->detail_item->detail_item->item_template_id,$det->jumlah,$det->detail_item->kadaluarsa);
                app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createDraftRetur($item->id,$det->jumlah,$transaction->id);
            }
            else {
                app('App\Http\Controllers\Gudang\LogDistribusi\CreateController')->createDraftRetur($temp->id,$det->jumlah,$transaction->id);
            }
        }*/

            //}

    }

    public function reject(Request $request)
    {
        //dd($request->explanation);
        //ini_set('max_execution_time', 300);
        
        $id = $request->input('id');
        $explanation = $request->input('explanation');
        
        
        DB::connection('farmasi')->beginTransaction();

        try
        {
            $transaction = Distribusi::find($id);
            //$transaction->client = $client;
            //$transaction->type = $type;
            $transaction->deskripsi = $explanation;
            //$transaction->category = $category;
            //$transaction->referral_number = $referral_number;
            $transaction->verified_by = Auth::user()->id;
            $transaction->verified_at = date('Y-m-d H:i:s');
            $transaction->status = -1;
            $transaction->save();            

            $request->ptr = $transaction->transaksi_ptr;
            $request->trans_id = $transaction->id;
            $request->slug = $transaction->slug;

            app('App\Http\Controllers\Farmasi\Distribusi\EditController')->reject($request); 

            
            DB::connection('farmasi')->commit();
            return redirect('gudang/distribusi/'.$transaction->slug)
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
    
}
