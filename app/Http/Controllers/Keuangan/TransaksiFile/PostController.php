<?php

namespace App\Http\Controllers\Keuangan\TransaksiFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TransaksiFileLokasi;
use App\Models\Keuangan\TransaksiFileUtang;
use Carbon\Carbon;
use Auth;
use DB;

class PostController extends Controller
{
    public function send(Request $request)
    {
		if ($request->lokasi_tujuan == $request->lokasi_asal) {
			$status = -1;
            $message = 'Lokasi Tujuan tidak boleh sama dengan Lokasi Awal';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
		}
    	try {

            DB::connection('keuangan')->beginTransaction();
            $file = TransaksiFileUtang::find($request->file_id);
            $file->transfer_status = 1;
            $file->save();

            $transaksi = new TransaksiFileUtang;
            $transaksi->utang_id = $file->utang_id;
            $transaksi->transaksi_asal_id = $file->id;
            $transaksi->status = 0;
            $transaksi->transfer_status = 0;
            $transaksi->lokasi_tujuan = $request->lokasi_tujuan;
            $transaksi->lokasi_last = $request->lokasi;
            $transaksi->sender_keterangan = $request->keterangan;
            $transaksi->checklist = json_encode($request->checklist);
            $transaksi->sender_sent_at = Carbon::now();
            $transaksi->sender_sent_by = Auth::user()->id;
            $transaksi->created_by = Auth::user()->id;
            $transaksi->save();

            // seed file_id
            $transaksi->file_id = $transaksi->id;
            $transaksi->save();

            $status = 1;
            $message = 'Berhasil Mengirim File';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return redirect('keuangan/transaksi-file/'.$transaksi->utang_id)
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Mengirim File';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function confirmSingle(Request $request)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
            
            $transaksi = $this->confirm($request);

            $status = 1;
            $message = 'Berhasil Konfirmasi File';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return redirect('keuangan/transaksi-file/'.$transaksi->utang_id)
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Konfirmasi File';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function confirmBatch(Request $req)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
            
            $files = TransaksiFileUtang::with(['file','file.perusahaan'])->where('lokasi_tujuan', $req->lokasi)->where('status', 0)->whereNull('cancel_sent_by')->get();
            foreach ($files as $key => $file) {
            	$request = new \Illuminate\Http\Request();
	        	$request->replace(['file_id' => $file->id, 'keterangan' => 'Konfirmasi Massal']);
	            $transaksi = $this->confirm($request);
            }

            $status = 1;
            $message = 'Berhasil Konfirmasi File';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Konfirmasi File';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function confirm(Request $request)
    {
        $transaksi = TransaksiFileUtang::find($request->file_id);
        $transaksi->status = 1;
        $transaksi->holder_keterangan = $request->keterangan;
        $transaksi->holder_confirmed_at = Carbon::now();
        $transaksi->holder_confirmed_by = Auth::user()->id;
        $transaksi->save();

        return $transaksi;
    }

    public function done(Request $request)
    {
        try {
            DB::connection('keuangan')->beginTransaction();
            
            $transaksi = TransaksiFileUtang::find($request->file_id);
            $transaksi->transfer_status = 2;
            $transaksi->save();

            $status = 1;
            $message = 'File ini sudah tidak bisa dipindahkan lagi';
            $title = 'Transaksi File Selesai';

            DB::connection('keuangan')->commit();

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Terjadi kesalahan. Silahkan coba lagi.';
            $title = 'Gagal!';

            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function initialize($utang_id)
    {
        $transaksi = new TransaksiFileUtang;
        $transaksi->utang_id = $utang_id;
        $transaksi->status = 1;
        $transaksi->transfer_status = 0;
        $transaksi->lokasi_tujuan = 'UKPBJ';
        $transaksi->lokasi_last = 'UKPBJ';
        $transaksi->sender_sent_at = Carbon::now();
        $transaksi->sender_sent_by = 1;
        $transaksi->holder_confirmed_at = Carbon::now();
        $transaksi->holder_confirmed_by = 1;
        $transaksi->created_by = 1;
        $transaksi->save();

        // seed file_id
        $transaksi->file_id = $transaksi->id;
        $transaksi->save();

        return $transaksi;
    }

    public function cancelSendSingle(Request $request)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();

            $transaksi = $this->cancelSend($request->file_id);

            $status = 1;
            $message = 'Berhasil Membatalkan Pengiriman';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return redirect('keuangan/transaksi-file/'.$transaksi->utang_id)
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Membatalkan Pengiriman';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function cancelSendBatch(Request $req)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
            
            $files = TransaksiFileUtang::with(['file','file.perusahaan'])->where('lokasi_asal', $req->lokasi)->where('status', 0)->whereNull('cancel_sent_by')->get();
            foreach ($files as $key => $file) {
	            $transaksi = $this->cancelSend($file->id);
            }

            $status = 1;
            $message = 'Berhasil Membatalkan Pengiriman';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Membatalkan Pengiriman';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function cancelSend($file_id)
    {
    	$transaksi = TransaksiFileUtang::find($file_id);
    	$transaksi->cancel_sent_by = Auth::user()->id;
    	$transaksi->save();

    	$transaksi_asal = TransaksiFileUtang::find($transaksi->transaksi_asal_id);
        $transaksi_asal->transfer_status = 0;
        $transaksi_asal->save();

        return $transaksi;
    }

    public function cancelConfirmSingle(Request $request)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
            
            $transaksi = $this->cancelConfirm($request->file_id);

            $status = 1;
            $message = 'Berhasil Membatalkan Konfirmasi';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return redirect('keuangan/transaksi-file/'.$transaksi->utang_id)
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Membatalkan Konfirmasi';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function cancelConfirmBatch(Request $req)
    {
    	try {
            DB::connection('keuangan')->beginTransaction();
            
            $files = TransaksiFileUtang::with(['file','file.perusahaan'])->where('lokasi_tujuan', $req->lokasi)->where('status', 1)->where('transfer_status', 0)->get();
            foreach ($files as $key => $file) {
	            $transaksi = $this->cancelConfirm($file->id);
            }

            $status = 1;
            $message = 'Berhasil Membatalkan Konfirmasi';
            $title = 'Berhasil!';

            DB::connection('keuangan')->commit();

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        } catch (\Exception $e) {
        	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        	
            DB::connection('keuangan')->rollback();
            $status = -1;
            $message = 'Gagal Membatalkan Konfirmasi';
            $title = 'Gagal!';

            return back()
	        ->with('message', $message)
	        ->with('title',$title)
	        ->with('status', $status);
        }
    }

    public function cancelConfirm($file_id)
    {
    	$transaksi = TransaksiFileUtang::find($file_id);
        $transaksi->status = 0;
        $transaksi->holder_keterangan = null;
        $transaksi->holder_confirmed_at = null;
        $transaksi->holder_confirmed_by = null;
        $transaksi->cancel_confirmed_by = Auth::user()->id;
        $transaksi->save();

        return $transaksi;
    }
}
