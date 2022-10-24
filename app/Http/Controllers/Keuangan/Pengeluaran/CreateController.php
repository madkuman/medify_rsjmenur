<?php

namespace App\Http\Controllers\Keuangan\Pengeluaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Pengeluaran;
use App\Models\Keuangan\PengeluaranDetail;
use Auth;

class CreateController extends Controller
{
    	public function create($no_spp,$kategori_id,$judul,$tanggal,$jumlah,$pengadaan_barang,$bebas_ppn,$kena_ppn,$jasa,$pph23nonppn,$ppn_barang,$pph_21_barang,$pph_22_barang,$pph_23_barang,$pph_23_ac_barang,$pph_23_bb_barang,$pph_4,$ppn_jasa,$pph_21_jasa,$pph_22_jasa,$pph_23_jasa,$pph_23_ac_jasa,$pph_23_bb_jasa)
    	{
    		$user_id = Auth::user()->id;

    		$pengeluaran = new Pengeluaran;
			$pengeluaran->utang_id = $no_spp;
            $pengeluaran->kategori_id = $kategori_id;
            $pengeluaran->judul = $judul;
			$pengeluaran->tanggal_transaksi = $tanggal;
			$pengeluaran->total = $jumlah;
    		$pengeluaran->pengadaan_barang = $pengadaan_barang;
    		$pengeluaran->bebas_ppn = $bebas_ppn;
    		$pengeluaran->kena_ppn = $kena_ppn;
			$pengeluaran->jasa = $jasa;
            $pengeluaran->pph23nonppn = $pph23nonppn;
            if ($ppn_barang != NULL) {
                $pengeluaran->ppn = $ppn_barang;
            } else {
                $pengeluaran->ppn = $ppn_jasa;
            }
            if ($pph_21_barang != NULL) {
                if($pph_21_barang == 5){
                    $pengeluaran->pph_21_5 = $pph_21_barang;
                }
                else{
                    $pengeluaran->pph_21_15 = $pph_21_barang;
                }
            } else {
                if($pph_21_jasa == 5){
                    $pengeluaran->pph_21_5 = $pph_21_jasa;
                }
                else{
                    $pengeluaran->pph_21_15 = $pph_21_jasa;
                }
            }
            if ($pph_22_barang != NULL) {
                $pengeluaran->pph_22 = $pph_22_barang;
            } else {
                $pengeluaran->pph_22 = $pph_22_jasa;
            }
			if ($pph_23_barang != NULL) {
                $pengeluaran->pph_23 = $pph_23_barang;
            } else {
                $pengeluaran->pph_23 = $pph_23_jasa;
            }
            if ($pph_23_ac_barang != NULL) {
                $pengeluaran->pph_23_ac = $pph_23_ac_barang;
            } else {
                $pengeluaran->pph_23_ac = $pph_23_ac_jasa;
            }
            if ($pph_23_bb_barang != NULL) {
                $pengeluaran->pph_23_bb = $pph_23_bb_barang;
            } else {
                $pengeluaran->pph_23_bb = $pph_23_bb_jasa;
            }
            $pengeluaran->pph_4 = $pph_4;

            $dpp_barang = $pengadaan_barang - (floor(floor($kena_ppn * (100/110)) * ($ppn_barang/100)));
            $dpp_jasa = $jasa - (floor(floor($jasa * (100/110)) * ($ppn_jasa/100)));
            
    		$pengeluaran->created_by = $user_id;
            $pengeluaran->dibayarkan = $jumlah - (floor(floor($kena_ppn * (100/110)) * ($ppn_barang/100)) + floor(floor($jasa * (100/110)) * ($ppn_jasa/100)) + floor($dpp_barang * ($pph_21_barang/100)) + floor($dpp_jasa * ($pph_21_jasa/100)) + floor($dpp_barang * ($pph_22_barang/100)) + floor($dpp_jasa * ($pph_22_jasa/100)) + floor((floor($dpp_barang * (($pph_23_barang+$pph_23_ac_barang+$pph_23_bb_barang)/100)) + floor($dpp_jasa * (($pph_23_jasa+$pph_23_ac_jasa+$pph_23_bb_jasa)/100))) + ($pph23nonppn * (($pph_23_barang+$pph_23_ac_barang+$pph_23_bb_barang)/100))) + floor($bebas_ppn * ($pph_4/100)));
    		$pengeluaran->save();

            for ($i=0; $i < 6; $i++) {     
                $detail = new PengeluaranDetail;
                $detail->utang_id = $no_spp;    
                $detail->pengeluaran_id = $pengeluaran->id;
                $detail->created_by = $user_id;
                if ($i == 0) {
                    $detail->kategori_id = $kategori_id;
                    $detail->jumlah = $jumlah;
                } else if ($i == 1) {
                    if ($ppn_barang != NULL || $ppn_jasa != NULL) {
                        $detail->kategori_id = 47;
                        $detail->jumlah = floor(floor($kena_ppn * (100/110)) * ($ppn_barang/100)) + floor(floor($jasa * (100/110)) * ($ppn_jasa/100));
                    } else {
                        $detail->kategori_id = 47;
                        $detail->jumlah = 0;
                    }    
                } else if ($i == 2) {
                    if ($pph_21_barang != NULL || $pph_21_jasa != NULL) {
                        $detail->kategori_id = 43;
                        $detail->jumlah = floor($dpp_barang * ($pph_21_barang/100)) + floor($dpp_jasa * ($pph_21_jasa/100));
                    } else {
                        $detail->kategori_id = 43;
                        $detail->jumlah = 0;
                    }    
                } else if ($i == 3) {
                    if ($pph_22_barang != NULL || $pph_22_jasa != NULL) {
                        $detail->kategori_id = 44;
                        $detail->jumlah = floor($dpp_barang * ($pph_22_barang/100)) + floor($dpp_jasa * ($pph_22_jasa/100));
                    } else {
                        $detail->kategori_id = 44;
                        $detail->jumlah = 0;
                    }    
                } else if ($i == 4) {
                    if ($pph_23_barang != NULL || $pph_23_ac_barang != NULL || $pph_23_bb_barang != NULL || $pph_23_jasa != NULL || $pph_23_ac_jasa != NULL || $pph_23_bb_jasa != NULL) {
                        $detail->kategori_id = 45;
                        $detail->jumlah = floor((floor($dpp_barang * (($pph_23_barang+$pph_23_ac_barang+$pph_23_bb_barang)/100)) + floor($dpp_jasa * (($pph_23_jasa+$pph_23_ac_jasa+$pph_23_bb_jasa)/100))) + ($pph23nonppn * (($pph_23_barang+$pph_23_ac_barang+$pph_23_bb_barang)/100)));
                    } else {
                        $detail->kategori_id = 45;
                        $detail->jumlah = 0;
                    }    
                } else if ($i == 5) {
                    if ($pph_4 != NULL) {
                        $detail->kategori_id = 46;
                        $detail->jumlah = floor($bebas_ppn * ($pph_4/100));
                    } else {
                        $detail->kategori_id = 46;
                        $detail->jumlah = 0;
                    }    
                }
                
                $detail->save();
            }

    		return $pengeluaran;
    	}
}
