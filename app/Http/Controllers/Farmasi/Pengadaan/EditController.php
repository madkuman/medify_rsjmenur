<?php

namespace App\Http\Controllers\Farmasi\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Pengadaan;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
    {   
        $id = $request->input('id');
        $penyedia = $request->input('peyedia');
        $description = $request->input('keterangan');
        //$category = $request->input('category');
        $tanggal = $request->input('tanggal_transaksi');
        $tgl_faktur = $request->input('tanggal_faktur');
        $tgl_surat_jalan = $request->input('tanggal_surat_jalan');
        $referral_number = $request->input('nomor_referensi');
        $nomor_surat = $request->input('nomor_surat');
        $refer = $request->input('refer');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');
        $harga = $request->input('harga_satuan');
        $diskon = $request->input('diskon');
        $batch = $request->input('batch');
        $ppn = $request->input('ppn');
        $subzero = $request->input('subtotal');
        $produsen = $request->input('produsen');
        $jumlah_besar = $request->input('jumlah_besar');
        $jumlah_kecil = $request->input('jumlah_kecil');
        $harga_box = $request->input('harga_box');
        $sumber_dana_id = $request->input('sumber_dana_id');
        $katalog_id = $request->input('katalog_id');
        
        $expired = $request->input('expired');
        $image = $request->file('image');

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        DB::connection('farmasi')->beginTransaction();

        try
        {
            $date = Carbon::createFromFormat('d/m/Y', $tanggal)->toDateTimeString();
            if($tgl_faktur) $date_faktur = Carbon::createFromFormat('d/m/Y', $tgl_faktur, 'Asia/Jakarta')->toDateTimeString();
            if($tgl_surat_jalan) $date_surat_jalan = Carbon::createFromFormat('d/m/Y', $tgl_surat_jalan, 'Asia/Jakarta')->toDateTimeString();

            $transaction = Pengadaan::find($id);
            $transaction->supplier_id = $penyedia;
            $transaction->sumber_dana_id = $sumber_dana_id;
            $transaction->katalog_id = $katalog_id;
            $transaction->keterangan = $description;
            $transaction->tanggal = $date;
            if($tgl_faktur) $transaction->tanggal_faktur = $date_faktur;
            if($tgl_surat_jalan) $transaction->tanggal_surat_jalan = $date_surat_jalan;
            //$transaction->category = $category;
            $transaction->nomor_referensi = $referral_number;
            $transaction->nomor_surat_jalan = $nomor_surat;

            if ($request->hasFile('image')) {
                $img = $this->uploadImage($request,$transaction->slug);
                $transaction->bukti_nota = $img['big'];
            }
            else $transaction->bukti_nota = null;
            //dd($harga);
            $transaction->save();

            $total = 0;
            $i = 0;
            foreach($transaction->log as $log)
            {
                if(isset($refer[$i]))
                {
                    if($log->id == $refer[$i]) {
                        $subtotal = app('App\Http\Controllers\Farmasi\LogPengadaan\EditController')->edit($refer[$i],$items[$i],$qty[$i],$harga[$i],$diskon[$i],$ppn[$i],$subzero[$i],$expired[$i],$batch[$i],$produsen[$i], $jumlah_kecil[$i], $jumlah_besar[$i], $harga_box[$i]);
                        $total += $subtotal;
                        $i++;
                    }
                    else app('App\Http\Controllers\Farmasi\LogPengadaan\DeleteController')->deleteLog($log->id);
                }
                else app('App\Http\Controllers\Farmasi\LogPengadaan\DeleteController')->deleteLog($log->id);
            }
            
            $j=0;
            foreach($items as $item)
            {
                if($j>=$i)
                {
                    if(!is_null($qty[$j])) {
                        $log = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item,$qty[$j],$expired[$j],$farm->id, null, null);
                        $log_pengadaan = app('App\Http\Controllers\Farmasi\LogPengadaan\CreateController')->create($log,$qty[$j],$transaction->id,$harga[$j],$diskon[$j],$ppn[$j],$subzero[$j],$date, $batch[$j],$produsen[$j], $jumlah_besar[$j],$jumlah_kecil[$j], $harga_box[$j]);

                        $log->log_pengadaan_id = $log_pengadaan->id;
                        $log->save();
                        $harga_template = app('App\Http\Controllers\Farmasi\ItemTemplateHarga\EditController')->checkAndUpdate($item, $penyedia, $harga[$j]);
                        
                        $total += $log_pengadaan->subtotal;
                    }
                }
                $j++;
            }

            $transaction->total_harga = $total;
            $transaction->save();

            DB::connection('farmasi')->commit();
            return redirect('farmasi/'.$farmasi.'/pengadaan/'.$transaction->slug)
                    ->with('status', 1)
                      ->with('message', 'Pengadaan berhasil diubah')
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
