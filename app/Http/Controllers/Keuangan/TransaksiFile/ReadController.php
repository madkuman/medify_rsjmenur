<?php

namespace App\Http\Controllers\Keuangan\TransaksiFile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TransaksiFileLokasi;
use App\Models\Keuangan\TransaksiFileUtang;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ReadController extends Controller
{
    public function getTable(Request $request)
    {
    	$start_date = $request->start_date;
        $end_date = $request->end_date;
        $lokasi = $request->lokasi;
        $status = $request->status;

        if(empty($start_date) && empty($end_date)){
            if ($status == "0") //menunggu konfirmasi
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('lokasi_tujuan', $lokasi)->where('status', 0)->whereNull('cancel_sent_by')->orderBy('sender_sent_at', 'desc');
            else if ($status == "1") //sedang dipegang
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('lokasi_tujuan', $lokasi)->where('status', 1)->where('transfer_status', '!=', 1)->orderBy('holder_confirmed_at', 'desc');
            else if ($status == "2") //telah dikirim
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('lokasi_last', $lokasi)->where('status', 0)->whereNull('cancel_sent_by')->orderBy('sender_sent_at', 'desc');
            else if ($status == "3") //semua
            	$query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')
                ->where(function ($query) use ($lokasi)
                {
                    $query->where('lokasi_tujuan', $lokasi)->where('transfer_status', '!=', 1);
                })
                ->orWhere(function ($query) use ($lokasi)
                {
                    $query->where('lokasi_last', $lokasi)->where('status', 0)->whereNull('cancel_sent_by');
                })
                ->orderBy('transaksi_file_utang.status')
                ->orderBy('transaksi_file_utang.updated_at', 'desc')
                ->orderBy('transaksi_file_utang.created_at', 'desc');
        }
        else {
            $tanggal_start = Carbon::createFromFormat('d-m-Y', $start_date)->startOfDay();
            $tanggal_end = Carbon::createFromFormat('d-m-Y', $end_date)->endOfDay();
            if ($status == "0") //menunggu konfirmasi
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('sender_sent_at','>',$tanggal_start)->where('sender_sent_at','<',$tanggal_end)->where('lokasi_tujuan', $lokasi)->where('status', 0)->whereNull('cancel_sent_by')->orderBy('sender_sent_at', 'desc');
            else if ($status == "1") //sedang dipegang
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('holder_confirmed_at','>',$tanggal_start)->where('holder_confirmed_at','<',$tanggal_end)->where('transfer_status', '!=', 1)->where('lokasi_tujuan', $lokasi)->where('status', 1)->orderBy('holder_confirmed_at', 'desc');
            else if ($status == "2") //telah dikirim
                $query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')->where('sender_sent_at','>',$tanggal_start)->where('sender_sent_at','<',$tanggal_end)->where('lokasi_last', $lokasi)->where('status', 0)->whereNull('cancel_sent_by')->orderBy('sender_sent_at', 'desc');
            else if ($status == "3") //semua
            	$query = TransaksiFileUtang::with(['file','file.perusahaan','holder','sender'])->whereHas('file')
                ->where('transaksi_file_utang.updated_at','>',$tanggal_start)->where('transaksi_file_utang.updated_at','<',$tanggal_end)
                ->where(function ($query) use ($lokasi)
                {
                    $query->where('lokasi_tujuan', $lokasi)->where('transfer_status', '!=', 1);
                })
                ->orWhere(function ($query) use ($lokasi)
                {
                    $query->where('lokasi_last', $lokasi)->where('status', 0)->whereNull('cancel_sent_by');
                })
                ->orderBy('transaksi_file_utang.status')
                ->orderBy('transaksi_file_utang.updated_at', 'desc')
                ->orderBy('transaksi_file_utang.created_at', 'desc');
        }

        return DataTables::of($query)
            ->make(true);
    }

    public function getFileDipegang($lokasi)
    {
    	$file = TransaksiFileUtang::with(['file','file.perusahaan'])->whereHas('file')->where('status', 1)->where('transfer_status', 0)->where('lokasi_tujuan', $lokasi)->orderBy('holder_confirmed_at', 'desc')->get();
    	return json_encode($file);
    }
}
