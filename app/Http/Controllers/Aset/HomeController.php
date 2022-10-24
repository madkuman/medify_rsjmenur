<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use File;
use Carbon\Carbon;
use DB;
use Session;

use App\Models\Aset\Transaction;
use App\Models\Aset\Items;
use App\Models\Aset\ItemsTemplate;
use App\Models\Aset\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $pengadaan_bulan_ini = Transaction::whereMonth('date',$bulan_ini)->count();
        $total_barang = Items::count();
        $barang_baru = Items::whereHas('transaction', function($q)use($bulan_ini){
            $q->whereMonth('date',$bulan_ini);
        })->count();
        $transaksi = Transaction::with('supplier')->with('user')->orderBy('transaction.date','desc')->limit(10)->get();

        $statistik_pengadaan = Transaction::select(DB::raw('COUNT(*) as sums, MONTH(date) as month, YEAR(date) as year'))
            ->groupBy(DB::raw('YEAR(date) ASC, MONTH(date) ASC'))->get();
        $persebaran_kategori = Category::with('ItemsTemplate')->get();
        $persebaran = [];
        foreach ($persebaran_kategori as $list_kategori){
            foreach ($list_kategori->itemstemplate as $list_itemstemplate){
                if(!isset($persebaran[$list_kategori->name]))
                    $persebaran[$list_kategori->name] =$list_itemstemplate->items->count();
                $persebaran[$list_kategori->name] = $persebaran[$list_kategori->name]+$list_itemstemplate->items->count();
            }
        }
        $sidebar_active = 'dashboard';

        return view('aset.dashboard.index',compact('sidebar_active',
            'persebaran',
            'statistik_pengadaan',
            'transaksi',
            'pengadaan_bulan_ini',
            'total_barang',
            'barang_baru'));
    }
}
