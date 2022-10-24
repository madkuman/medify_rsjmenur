<?php

namespace App\Http\Controllers\Keuangan\PaketPemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPemasukan;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\Kategori;
use DB;

define('relasi_piutang', ['pasien', 'kategori', 'perusahaan']);

class ReadController extends Controller
{
    public function getByDate(Request $request)
    {
        $tanggal = $request->tanggal;
        if ($tanggal == 'all')
            $query = PaketPemasukan::query();
        else{
            $tanggal_min = Carbon::createFromFormat('d F Y H', $tanggal.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d F Y H', $tanggal.' 24')->toDateTimeString();
            $query = PaketPemasukan::where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)
            ->orderBy('tanggal_transaksi');
        }

        return DataTables::of($query)
            ->addColumn('rownum', function($q) use(&$rownum){
                return ++$rownum;
            })
            ->addColumn('kategori', function ($pemasukan) {
                return $pemasukan->kategori ? str_limit($pemasukan->kategori->name) : '';
            })
            ->toJson();
    }

    public function getLaporan($start, $end, $kategori, $tipe)
    {
        $res = [];

        if($tipe == 0)
        {
            foreach($kategori as $index => $k)
            {
                $string_kategori = $this->formatKategori($k->ids);
                $res[$k->id] = collect(DB::connection('keuangan')->select(DB::raw('select DATE(p.created_at) as tgl, sum(d.subtotal) as total from pemasukan_detail d, pemasukan p where p.deleted_at is null 
                            and p.created_at >= "'.$start.'" and p.created_at <= "'.$end.'" and d.pemasukan_id=p.id 
                            and d.kategori_id in '.$string_kategori.' group by tgl')))->keyBy('tgl')->toArray();
            }
        } else if($tipe == 1) {
            foreach($kategori as $index => $k)
            {
                $string_kategori = $this->formatKategori($k->ids);
                $res[$k->id] = collect(DB::connection('keuangan')->select(DB::raw('select DATE(p.created_at) as tgl, sum(d.subtotal) as total from pemasukan_detail d, pemasukan p where p.deleted_at is null 
                        and p.created_at >= "'.$start.'" and p.created_at <= "'.$end.'" and d.pemasukan_id=p.id 
                        and d.kategori_bpjs_id in '.$string_kategori.' group by tgl')))->keyBy('tgl')->toArray();
            }
        } else {
            foreach($kategori as $index => $k)
            {
                $string_kategori = $this->formatKategori($k->ids);
                $res[$k->id] = DB::connection('keuangan')->select(DB::raw('select DATE(p.created_at) as tgl, sum(d.subtotal) as total from pemasukan_detail d, pemasukan p where p.deleted_at is null 
                            and p.created_at >= "'.$start.'" and p.created_at <= "'.$end.'" and d.pemasukan_id=p.id 
                            and p.pembayaran_perusahaan_tipe_id='.$tipe.' and d.kategori_id in '.$string_kategori.' group by tgl'));
            }
        }
        return $res;
    }

    private function formatKategori($kategori_ids)
    {
        $res = "(";
        foreach($kategori_ids as $i => $id)
        {
            $res .= $id;
            if(isset($kategori_ids[$i+1]))
                $res .= ", ";
        }
        return $res.")";
    }

}