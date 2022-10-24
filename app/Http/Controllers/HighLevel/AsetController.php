<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Carbon\Carbon;
use DB;
use Session;

use App\Models\Aset\Transaction;
use App\Models\Aset\Items;
use App\Models\Aset\ItemsTemplate;
use App\Models\Aset\Category;

class AsetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if(!is_dir('attachment')){
            File::makeDirectory('attachment');
            File::makeDirectory('attachment/DataTransaction/');
            File::makeDirectory('attachment/DataTransaction/original');
            File::makeDirectory('attachment/DataTransaction/thumbnail');
            File::makeDirectory('attachment/DataItems/');
            File::makeDirectory('attachment/DataItems/original');
            File::makeDirectory('attachment/DataItems/thumbnail');
            File::makeDirectory('attachment/DataItemsTemplate/');
            File::makeDirectory('attachment/DataItemsTemplate/original');
            File::makeDirectory('attachment/DataItemsTemplate/thumbnail');
            File::makeDirectory('attachment/DataSupplier/');
            File::makeDirectory('attachment/DataSupplier/original');
            File::makeDirectory('attachment/DataSupplier/thumbnail');
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $bulan_ini = $now->month;
        $tahun_ini=$now->year;
        $transaction=Transaction::get();
        $pengadaan_tetap_bulan_ini=0;
        $pengadaan_habis_pakai_bulan_ini=0;
        $total_harga_tetap=0;
        $total_harga_habis_pakai=0;
        $total_harga_tetap_bulan_ini=0;
        $total_harga_habis_pakai_bulan_ini=0;
        foreach ($transaction as $index => $row){
            $transaction[$index]->json=json_decode($row->json);
            $transaction[$index]->bulan=explode('-',$transaction[$index]->date);
            if($transaction[$index]->bulan[1] ==$bulan_ini && $transaction[$index]->bulan[0]==$tahun_ini){
                $transaction[$index]->mark_bulan_ini=1;
            }
            else{
                $transaction[$index]->mark_bulan_ini=0;
            }
            $pengadaan_tetap=0;
            $pengadaan_habis_pakai=0;
            foreach ($transaction[$index]->json as $key=> $list){
                if($list->jenis==1){
                    $total_harga_habis_pakai+=$list->subtotal;
                    if($transaction[$index]->mark_bulan_ini==1){
                        $total_harga_habis_pakai_bulan_ini+=$list->subtotal;
                        if($pengadaan_habis_pakai==0){
                            $pengadaan_habis_pakai_bulan_ini+=1;
                            $pengadaan_habis_pakai=1;
                        }
                    }
                }
                if($list->jenis==0){
                    $total_harga_tetap+=$list->subtotal;
                    if($transaction[$index]->mark_bulan_ini==1){
                        $total_harga_tetap_bulan_ini+=$list->subtotal;
                        if($pengadaan_tetap==0){
                            $pengadaan_tetap_bulan_ini+=1;
                            $pengadaan_tetap=1;
                        }
                    }
                }
            }
        }
        $data['pengadaan_tetap_bulan_ini']=$pengadaan_tetap_bulan_ini;
        $data['pengadaan_habis_pakai_bulan_ini']=$pengadaan_habis_pakai_bulan_ini;
        $data['total_harga_tetap']=$total_harga_tetap;
        $data['total_harga_habis_pakai']=$total_harga_habis_pakai;
        $data['total_harga_tetap_bulan_ini']=$total_harga_tetap_bulan_ini;
        $data['total_harga_habis_pakai_bulan_ini']=$total_harga_habis_pakai_bulan_ini;

        $startDate = $now->subMonths(11)->startOfMonth();
        $statistik_pengadaan = Transaction::where('date', '>=', $startDate)->get();
        foreach (range(1, 12) as $month) {
            $result_habis_pakai[$month] = [
                'month' => $month,
                'pengadaan_habis_pakai' => 0
            ];
            $result_tetap[$month] = [
                'month' => $month,
                'pengadaan_tetap' => 0,
            ];
        }
        //dd($result_habis_pakai[1]['pengadaan_tetap']);
        foreach ($statistik_pengadaan as $index => $row){
            $statistik_pengadaan[$index]->json=json_decode($row->json);
            $statistik_pengadaan[$index]->bulan=explode('-',$transaction[$index]->date);
            $statistik_pengadaan_tetap=0;
            $statistik_pengadaan_habis_pakai=0;
            foreach ($statistik_pengadaan[$index]->json as $key=> $list){
                if($list->jenis==1){
                    if($statistik_pengadaan_habis_pakai==0) {
                        $result_habis_pakai[$statistik_pengadaan[$index]->bulan[1]]['month'] = $statistik_pengadaan[$index]->bulan[1];
                        $result_habis_pakai[$statistik_pengadaan[$index]->bulan[1]]['pengadaan_habis_pakai'] += 1;
                        $statistik_pengadaan_habis_pakai = 1;
                    }
                }
                if($list->jenis==0){
                    if($statistik_pengadaan_tetap==0) {
                        $result_tetap[$statistik_pengadaan[$index]->bulan[1]]['month'] = $statistik_pengadaan[$index]->bulan[1];
                        $result_tetap[$statistik_pengadaan[$index]->bulan[1]]['pengadaan_tetap'] += 1;
                        $statistik_pengadaan_tetap=1;
                    }
                }
            }
        }
        $data['statistik_pengadaan_habis_pakai']=$result_habis_pakai;
        $data['statistik_pengadaan_tetap']=$result_tetap;
        $persebaran_kategori = Category::with('ItemsTemplate')->get();
        $persebaran = [];
        foreach ($persebaran_kategori as $list_kategori){
            foreach ($list_kategori->itemstemplate as $list_itemstemplate){
                if(!isset($persebaran[$list_kategori->name]))
                    $persebaran[$list_kategori->name] =$list_itemstemplate->items->count();
                $persebaran[$list_kategori->name] = $persebaran[$list_kategori->name]+$list_itemstemplate->items->count();
            }
        }
        return view('highlevel.aset',compact(
            'persebaran'),$data);
    }
}
