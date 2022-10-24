<?php

namespace App\Http\Controllers\Keuangan\PO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\Utang;
use App\Models\Keuangan\UtangDetail;
use App\Models\Keuangan\PODetail;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
    public function get(Request $request)
    {
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            if ($filter == 'all')
                $query = PO::with('perusahaan');
            else if($filter == 'processed')
                $query = PO::with('perusahaan')->whereHas('pjk');
            else if($filter == 'unprocessed')
                $query = PO::with('perusahaan')->whereDoesntHave('pjk');
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal_end.' 24')->toDateTimeString();
            if($filter == 'all')
                $query = PO::with('perusahaan')->where('tanggal_po','>',$tanggal_min)->where('tanggal_po','<',$tanggal_max);
            else if($filter == 'processed')
                $query = PO::with('perusahaan')->where('tanggal_po','>',$tanggal_min)->where('tanggal_po','<',$tanggal_max)
                ->whereHas('pjk');
            else if($filter == 'unprocessed')
                $query = PO::with('perusahaan')->where('tanggal_po','>',$tanggal_min)->where('tanggal_po','<',$tanggal_max)
                ->whereDoesntHave('pjk');
        }
            
        return DataTables::of($query)
            ->make(true);
    }

    public function getForPenerimaan()
    {
        $po = PO::where(function($q){
            $q->whereColumn('termin', '>', 'termin_processed')->orWhereNull('termin_processed')->orWhereNull('termin');
        })->where(function($q){
            $q->whereColumn('total', '>', 'pjk_processed')->orWhereNull('pjk_processed');
        })->get();
        return json_encode($po);
    }

    public function getSingle($id)
    {
        $po = PO::with(['perusahaan', 'detail'])->find($id);
            
        return json_encode($po);
    }
    
    public function getActivePO($jenis_po)
    {
        $po = PO::where('jenis_po',$jenis_po)->where(function($q){
            $q->whereColumn('termin', '>', 'termin_processed')->orWhereNull('termin_processed')->orWhereNull('termin');
        })->where(function($q){
            $q->whereColumn('total', '>', 'pjk_processed')->orWhereNull('pjk_processed');
        })->get();
      
        return $po;
    }

    public function adminImportData()
    {
        $file = fopen("rsal-keuangan-po-import-data.csv","r");
        $count = 0;
        while(! feof($file))
        {
            $data = fgetcsv($file,null,";");
            $count++;
            if($count == 1) continue;
            $no_po = $data[0];
            $tgl_po = $data[1];
            $distributor = $data[2];
            $jenis_po = $data[3];
            $uraian = $data[4];
            $no_faktur = $data[5];
            $no_spk = $data[6];
            $total = $data[7];
            $tgl_po = Carbon::createFromFormat('m/d/Y', $tgl_po);

            $po = new PO;
            $po->judul = $uraian;
            $po->jenis_po = $jenis_po;
            $po->no_po = $no_po;
            $po->no_spkktr = $no_spk;
            $po->jumlah = $total;
            $po->diskon = 0;
            $po->total = $total;
            $po->tanggal_po = $tgl_po;
            $po->created_by = 1;
            $po->save();

            $po_detail = new PODetail;
            $po_detail->po_id = $po->id;
            $po_detail->deskripsi = $uraian;
            $po_detail->harga = $total;
            $po_detail->jumlah = 1;
            $po_detail->diskon = 0;
            $po_detail->subtotal = $total;
            $po_detail->save();

            $utang = Utang::where('no_faktur',$no_faktur)->get();
            if(count($utang) == 1)
            {
                $utang_current = Utang::find($utang[0]->id);
                $utang_current->po_id = $po->id;
                $utang_current->save();

                $utang_detail = UtangDetail::where('utang_id',$utang[0]->id)->first();
                $utang_detail->po_detail_id = $po_detail->id;
                $utang_detail->save();

                $po->pjk_processed = $utang_current->total;
                $po->perusahaan_id = $utang_current->perusahaan->id;
                $po->save();


                $po_detail->jumlah_processed = $utang_detail->jumlah;
                $po_detail->subtotal_processed = $utang_detail->subtotal;
                $po_detail->save();
            }
            else
            {
                $po->judul = $uraian.'-- ditemukan '.count($utang).' yang sama';
                $po->save(); 
            }
        }
        dd('done--'.$count++);
    }
}
