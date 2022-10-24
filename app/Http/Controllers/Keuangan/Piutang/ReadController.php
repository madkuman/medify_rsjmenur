<?php

namespace App\Http\Controllers\Keuangan\Piutang;

use App\Models\Keuangan\PiutangDetail;
use App\Models\Keuangan\TarifKategoriINACBG;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Keuangan\Perusahaan;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\Hospital\Lokasi;
use DB;

define('relasi_piutang', ['pasien', 'kategori', 'perusahaan']);

class ReadController extends Controller
{
    public function getByFilter(Request $request)
    {
        $all_perusahaan = Perusahaan::get()->pluck('id')->toArray();
        $filter = $request->filter;
        $tanggal_start = $request->tanggal_start;
        $tanggal_end = $request->tanggal_end;
        $asal_layanan = $request->asal_layanan;

        $pt_array = [];
        if(empty($request->perusahaan))
        {
            $pt_array = $all_perusahaan;
            $perusahaan = $pt_array;
        }
        else{
            $perusahaan = $request->perusahaan;
            foreach($perusahaan as $pt)
            {
                if($pt == 'all') {
                    $pt_array = $all_perusahaan;
                    break;
                }
                else $pt_array[] = $pt;
            }

        }


        if(($tanggal_start == null && $tanggal_end == null)||($tanggal_start == '' && $tanggal_end == '')){
            if ($filter == 'all'){
                if ($perusahaan[0] == 'all') {
                    $query = Piutang::with(relasi_piutang);
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array);
                }
            }
            else if($filter == 'paid'){
                if ($perusahaan[0] == 'all') {
                    $query = Piutang::with(relasi_piutang)->whereRaw('total = total_paid');
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array)->whereRaw('total = total_paid');
                }
            }
            else if($filter == 'unpaid'){
                if ($perusahaan[0] == 'all') {
                    $query = Piutang::with(relasi_piutang)->where('total', '>', 0)->whereNotIn('id', function($query2){
                        $query2->select('id')
                        ->from(with(new Piutang)->getTable())
                        ->whereRaw('total <= total_paid');
                    });
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array)->where('total', '>', 0)->whereNotIn('id', function($query2){
                        $query2->select('id')
                        ->from(with(new Piutang)->getTable())
                        ->whereRaw('total <= total_paid');
                    });
                }
            }
        }
        else {
            if($tanggal_start == '')
                $tanggal_start = '00 January 0000';
            else if($tanggal_end == '')
                $tanggal_end = Carbon::today()->format('d F Y');
            $tanggal_min = Carbon::createFromFormat('d M Y H', $tanggal_start.' 0')->toDateTimeString();
            $tanggal_max = Carbon::createFromFormat('d M Y H', $tanggal_end.' 24')->toDateTimeString();
            if ($filter == 'all'){
                if ($perusahaan[0] == 'all') {
                    $query = Piutang::with(relasi_piutang)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max);
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max);
                }
            }
            else if($filter == 'paid'){
                if ($perusahaan[0] = 'all') {
                    $query = Piutang::with(relasi_piutang)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->whereRaw('total = total_paid');
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->whereRaw('total = total_paid');
                }
            }
            else if($filter == 'unpaid'){
                if ($perusahaan[0] == 'all') {
                    $query = Piutang::with(relasi_piutang)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->where('total', '>', 0)->whereNotIn('id', function($query2){
                        $query2->select('id')
                        ->from(with(new Piutang)->getTable())
                        ->whereRaw('total <= total_paid');
                    });
                } else {
                    $query = Piutang::with(relasi_piutang)->whereIn('perusahaan_id',$pt_array)->where('tanggal_transaksi','>',$tanggal_min)->where('tanggal_transaksi','<',$tanggal_max)->where('total', '>', 0)->whereNotIn('id', function($query2){
                        $query2->select('id')
                        ->from(with(new Piutang)->getTable())
                        ->whereRaw('total <= total_paid');
                    });
                }
            }
        }
        $query = $query->whereNull('paket_penagihan_id');


        if($asal_layanan == 'all-rj')
        {
            $departemen_rj = LokasiDepartemen::whereIn('slug',['igd','rawat-jalan'])->pluck('id')->toArray();
            $lokasi_rj = Lokasi::whereIn('lokasi_departemen_id',$departemen_rj)->pluck('id')->toArray();
            $query = $query->AsalFilter($lokasi_rj);
        }
        elseif($asal_layanan == 'all-ri')
        {
            $departemen_ri = LokasiDepartemen::whereIn('slug',['rawat-inap'])->pluck('id')->toArray();
            $lokasi_ri = Lokasi::whereIn('lokasi_departemen_id',$departemen_ri)->pluck('id')->toArray();
            $query = $query->AsalFilter($lokasi_ri);
        }
        elseif($asal_layanan == 'all')
        {
            //donothing
        }
        else{
            $array = explode(",", $asal_layanan);
            $query = $query->AsalFilter($array);
        }
        
        return DataTables::of($query)
        ->addColumn('pasien', function(Piutang $piutang){
            if(empty($piutang->pasien))
                return 'none-none-'.$piutang->pihak_ketiga;
            else
                return $piutang->pasien->name.'-'.$piutang->pasien->no_rm.'-none';
        })
        ->addColumn('perusahaan', function(Piutang $piutang){
            return $piutang->perusahaan ? $piutang->perusahaan->nama : '';
        })
        ->addColumn('kategori', function (Piutang $piutang) {
            return $piutang->kategori ? str_limit($piutang->kategori->name) : '';
        })
        ->addColumn('bayar', function(Piutang $piutang){
            if($piutang->total == $piutang->total_paid)
                return 'paid-'.$piutang->id;
            else
                return 'unpaid-'.$piutang->id;
        })
        ->addColumn('total_id', function(Piutang $piutang){
            return $piutang->total.'-'.$piutang->id;
        })
        ->addColumn('total_paid_id', function(Piutang $piutang){
            return $piutang->total_paid.'-'.$piutang->id;
        })
        ->addColumn('lokasi', function(Piutang $piutang){
            $bangsal_nama = $piutang->lokasi->ruangan->bangsal->nama ?? null;
            if(!empty($bangsal_nama)){
                return $piutang->lokasi->ruangan->bangsal->nama;
            }
            else
                return $piutang->lokasi->nama;
        })
        ->toJson();
    }

    public  function getPiutangByKategoriInacbg($piutang)
    {
        $query = '
            SELECT tki.nama as kategori, SUM(ti.harga*d.jumlah) AS subtotal
            FROM piutang  p
            JOIN piutang_detail d ON p.id = d.piutang_id
            JOIN tarif t ON d.tarif_id = t.id
            JOIN tarif_inacbg ti ON t.id = ti.tarif_id 
            RIGHT JOIN tarif_kategori_inacbg tki ON ti.tarif_kategori_inacbg_id = tki.id
            WHERE p.id = '.$piutang->id.'
            AND d.deleted_at IS NULL
            AND t.deleted_at IS NULL
            AND ti.deleted_at IS NULL
            AND tki.deleted_at IS NULL
            GROUP BY tki.id
        ';
        $results = DB::connection('keuangan')->select($query);
        $obat = $this->getPiutangObat($piutang);
        $new_data= [];

        if(empty($results)){
            $results = $this->getDefaultKategoriInacbg();
        }

        foreach($results as $item)
        {
            $object = new \stdClass();
            $object->kategori = $item->kategori;
            if($item->kategori == 'Obat')
            $object->subtotal = $item->subtotal + $obat;
            else
            $object->subtotal = $item->subtotal;
            $new_data[] = $object;
        }
        return $new_data;
    }

    private function getPiutangObat($piutang)
    {
        $query = '
            SELECT IFNULL(SUM(d.subtotal),0) AS subtotal
            FROM piutang  p
            JOIN piutang_detail d ON p.id = d.piutang_id
            WHERE p.id = '.$piutang->id.'
            AND d.deleted_at IS NULL
            AND (d.tarif_id IS NUll
            OR d.tarif_id = 0
            )
            GROUP BY p.id
        ';
        $obat = DB::connection('keuangan')->select($query);
        if(!empty($obat)) return $obat[0]->subtotal;
        else return 0;
    }

    private function getDefaultKategoriInacbg()
    {
        $kategori_inacbg=TarifKategoriINACBG::select('nama as kategori',DB::raw('0 as subtotal'))->get();
        return $kategori_inacbg;
    }

    public function getTunaiStatus($piutang_id)
    {
        $piutang = Piutang::find($piutang_id);
        if (!empty($piutang)) {
            if ($piutang->total_paid >= $piutang->jumlah) {
                $return['status'] = 1;
            } else {
                $return['status'] = 0;
            }
        } else {
            // Get split piutang
            $piutang_split = Piutang::select('id','total','total_paid')->where('piutang_parent_id', $piutang_id)->get();
            $count_piutang_split = count($piutang_split);
            if ($count_piutang_split > 0) {
                $count_paid = 0;
                foreach ($piutang_split as $split) {
                    if ($split->total_paid >= $split->total) {
                        $count_paid++;
                    }
                }
                if ($count_paid == $count_piutang_split) {
                    $return['status'] = 1;
                } else {
                    $return['status'] = 0;
                }
            } else {
                $return['status'] = 0;
            }
        }
        return json_encode($return);
    }
}
