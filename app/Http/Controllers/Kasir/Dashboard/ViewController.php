<?php

namespace App\Http\Controllers\Kasir\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Transaksi;
use App\Models\Kasir\Tagihan;
use App\Models\Kasir\TagihanDetail;
use Carbon\Carbon;

class ViewController extends Controller
{
		public function index($id)
		{
			return redirect('kasir/'.$id.'/transaksi');/*
			$today = Carbon::today();
			$kasir = app('App\Http\Controllers\Kasir\Manajemen\ReadController')->getSingle($id);
			$data['sidebar_active'] = "dashboard";
			$data['kasir'] = $kasir;
			$data['num_belum_bayar'] = Tagihan::where('kasir_id',$id)->where('created_at','>',$today)->where('total_paid',null)->count();
			$data['num_bayar'] = Tagihan::where('kasir_id',$id)->where('created_at','>',$today)->where('total_paid','!=',null)->count();
			$data['total'] = Tagihan::where('created_at','>',$today)->sum('total_bill');
			$data['tagihan_belum_bayar'] = Tagihan::where('kasir_id',$id)->where('created_at','>',$today)->where('total_paid',null)->orderBy('created_at', 'desc')->take(10)->get();
			$data['tagihan_bayar'] = Tagihan::where('kasir_id',$id)->where('created_at','>',$today)->where('total_paid','!=',null)->orderBy('created_at', 'desc')->take(10)->get();
			return view('kasir.dashboard.index',$data);*/
		}
}
