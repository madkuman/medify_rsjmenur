<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pemasukan;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\PengeluaranDetail;
use App\Models\Keuangan\Kategori;
use Carbon\Carbon;
use DB;

class TerimaKeluarController extends Controller
{
    public function getBulanan($data)
	{
		$bulan_start = $data['bulan_start'];
		$bulan_end = $data['bulan_end'];

        $penerimaan_total['total'] = 0;
        $pengeluaran_total['total'] = 0;
        
        $kategori = Kategori::where('type',1)->with('child')->get();
        $penerimaan = $kategori;
        $count1 = count($kategori);
        foreach($penerimaan as $kat){
            $total = Pemasukan::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('total');
            $kat['total'] = $total;
            $penerimaan_total['total'] = $penerimaan_total['total'] + $kat['total'];
        }
        
        // update parent total
        foreach($kategori as $kat){
            if(count($kat->child) > 0){
                $total = 0;
                foreach($kat->child as $child){
                    $kat2 = $penerimaan->where('id',$child->id)->first();
                    $total = $total + $kat2['total'];
                }
                foreach($penerimaan as $item){
                    if($item->id == $kat->id){
                        $item['total'] = $item['total'] + $total;
                        if($item->parent_id > 0){
                            foreach($penerimaan as $item2){
                                if($item2->id == $item->parent_id){
                                    $item2['total'] = $item2['total'] + $total;
                                    break;
                                }
                            }
                        }
                        break;
                    }
                }
            }
        }

        $kategori = Kategori::where('type',2)->with('child')->get();
        $kategori_pajak = Kategori::where('type',2)->where('parent_id', 42)->pluck('id');
        $kategori_pajak = json_decode(json_encode($kategori_pajak));
        $pengeluaran = $kategori;
        $count2 = count($kategori);
        foreach($pengeluaran as $kat){
            if (in_array($kat->id, $kategori_pajak)) {
                $total = PengeluaranDetail::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('jumlah');
                $kat['total'] = $total;
                $pengeluaran_total['total'] = $pengeluaran_total['total'] + $kat['total'];
            } else {
                $total = Pengeluaran::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('dibayarkan');
                $kat['total'] = $total;
                $pengeluaran_total['total'] = $pengeluaran_total['total'] + $kat['total'];
            }
        }
        
        // update parent total
        foreach($kategori as $kat){
            if(count($kat->child) > 0){
                $total = 0;
                foreach($kat->child as $child){
                    $kat2 = $pengeluaran->where('id',$child->id)->first();
                    $total = $total + $kat2['total'];
                }
                foreach($pengeluaran as $item){
                    if($item->id == $kat->id){
                        $item['total'] = $item['total'] + $total;
                        if($item->parent_id > 0){
                            foreach($pengeluaran as $item2){
                                if($item2->id == $item->parent_id){
                                    $item2['total'] = $item2['total'] + $total;
                                    break;
                                }
                            }
                        }
                        break;
                    }
                }
            }
        }
        // dd($pengeluaran);
        $total_all['total'] = 0;
        $total_sisa['total'] = 0;
        
        $pemasukan_prev = Pemasukan::where('created_at','<',$bulan_start)->sum('total');
        $pengeluaran_prev = Pengeluaran::where('created_at','<',$bulan_start)->sum('total');
        $total_sisa_lalu['total'] = $pemasukan_prev - $pengeluaran_prev;
        $pemasukan_prev = Pemasukan::where('created_at','<=',$bulan_end)->sum('total');
        $pengeluaran_prev = Pengeluaran::where('created_at','<=',$bulan_end)->sum('total');
        $total_sisa['total'] = $pemasukan_prev - $pengeluaran_prev;
        $total_all['total'] = $pengeluaran_total['total'] + $total_sisa['total'];

        // total penerimaan + sisa bulan lalu
        $penerimaan_total['total'] = $penerimaan_total['total'] + $total_sisa_lalu['total'];

        $data_return['penerimaan'] = $penerimaan;
        $data_return['pengeluaran'] = $pengeluaran;
        $data_return['count'] = $count1 + $count2;
        $data_return['count1'] = $count1;
        $data_return['count2'] = $count2;
        $data_return['penerimaan_total'] = $penerimaan_total;
        $data_return['pengeluaran_total'] = $pengeluaran_total;
        $data_return['sisa_lalu'] = $total_sisa_lalu;
        $data_return['sisa'] = $total_sisa;
        $data_return['total'] = $total_all;
        $data_return['bulan'] = $bulan_start->format('F Y'); 
        // dd($data_return);
		return $data_return;
    }
    
    public function getTahunan($data)
	{
        $tahun = $data['tahun'];
        for($i=1;$i<=12;$i++){
            $pengeluaran_total[$i] = 0;
            $penerimaan_total[$i] = 0;
        }
        $penerimaan_total['total'] = 0;
        $pengeluaran_total['total'] = 0;
        
        $kategori = Kategori::where('type',1)->with('child')->get();
        $penerimaan = $kategori;
        $count1 = count($kategori);
        foreach($penerimaan as $kat){
            $kat['total'] = 0;
            for($i=1;$i<=12;$i++){
                $bulan = $tahun.'-'.($i);
                $bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
                $bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();
                $total = Pemasukan::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('total');
                $kat[$i] = $total; 
                $kat['total'] = $kat['total'] + $kat[$i];

                $penerimaan_total[$i] = $penerimaan_total[$i] + $kat[$i];
                $penerimaan_total['total'] = $penerimaan_total['total'] + $kat[$i];
            }
        }
        // dd($penerimaan);
        // update parent total
        foreach($kategori as $kat){
            if(count($kat->child) > 0){
                for($i=1;$i<=12;$i++){
                    $total = 0;
                    foreach($kat->child as $child){
                        $kat2 = $penerimaan->where('id',$child->id)->first();
                        $total = $total + $kat2[$i];
                    }
                    foreach($penerimaan as $item){
                        if($item->id == $kat->id){
                            $item[$i] = $item[$i] + $total;
                            $item['total'] = $item['total'] + $total;
                            if($item->parent_id > 0){
                                foreach($penerimaan as $item2){
                                    if($item2->id == $item->parent_id){
                                        $item2[$i] = $item2[$i] + $total;
                                        $item2['total'] = $item2['total'] + $total;
                                        break;
                                    }
                                }
                            }
                            break;
                        }
                    }
                }
            }
        }

        $kategori = Kategori::where('type',2)->with('child')->get();
        $pengeluaran = $kategori; 
        $count2 = count($kategori);
        foreach($pengeluaran as $kat){
            $kat['total'] = 0;
            for($i=1;$i<=12;$i++){
                $bulan = $tahun.'-'.($i);
                $bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
                $bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();
                if (in_array($kat->id, $kategori_pajak)) {
                    $total = PengeluaranDetail::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('jumlah');
                } else {
                    $total = Pengeluaran::where('kategori_id',$kat->id)->whereBetween('created_at',array($bulan_start,$bulan_end))->sum('dibayarkan');
                }
                $kat[$i] = $total; 
                $kat['total'] = $kat['total'] + $kat[$i];

                $pengeluaran_total[$i] = $pengeluaran_total[$i] + $kat[$i];
                $pengeluaran_total['total'] = $pengeluaran_total['total'] + $kat[$i];
            }
        }
        // update parent total
        foreach($kategori as $kat){
            if(count($kat->child) > 0){
                for($i=1;$i<=12;$i++){
                    $total = 0;
                    foreach($kat->child as $child){
                        $kat2 = $pengeluaran->where('id',$child->id)->first();
                        $total = $total + $kat2[$i];
                    }
                    foreach($pengeluaran as $item){
                        if($item->id == $kat->id){
                            $item[$i] = $item[$i] + $total;
                            $item['total'] = $item['total'] + $total;
                            if($item->parent_id > 0){
                                foreach($pengeluaran as $item2){
                                    if($item2->id == $item->parent_id){
                                        $item2[$i] = $item2[$i] + $total;
                                        $item2['total'] = $item2['total'] + $total;
                                        break;
                                    }
                                }
                            }
                            break;
                        }
                    }
                }
            }
        }

        $total_all['total'] = 0;
        $total_sisa['total'] = 0;
        for($i=1;$i<=12;$i++){
            $bulan = $tahun.'-'.($i);
            $bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();
            $pemasukan_prev = Pemasukan::where('created_at','<=',$bulan_end)->sum('total');
            $pengeluaran_prev = Pengeluaran::where('created_at','<=',$bulan_end)->sum('total');
            $total_sisa[$i] = $pemasukan_prev - $pengeluaran_prev;
            $total_all[$i] = $pengeluaran_total[$i] + $total_sisa[$i];
            $total_sisa['total'] = $total_sisa['total'] + $total_sisa[$i];
            $total_all['total'] = $total_all['total'] + $total_sisa[$i];
        }
        $total_all['total'] = $pengeluaran_total['total'] + $total_all['total'];

        // total penerimaan + sisa bulan lalu
        for($i=2;$i<=12;$i++){
            $penerimaan_total[$i] = $penerimaan_total[$i] + $total_sisa[$i-1];
            $penerimaan_total['total'] = $penerimaan_total['total'] + $total_sisa[$i-1];
        }

        $data_return['penerimaan'] = $penerimaan;
        $data_return['pengeluaran'] = $pengeluaran;
        $data_return['count'] = $count1 + $count2;
        $data_return['count1'] = $count1;
        $data_return['count2'] = $count2;
        $data_return['penerimaan_total'] = $penerimaan_total;
        $data_return['pengeluaran_total'] = $pengeluaran_total;
        $data_return['sisa'] = $total_sisa;
        $data_return['total'] = $total_all;
        $data_return['tahun'] = $tahun;
        // dd($data_return);
		return $data_return;
    }
    
    
}
