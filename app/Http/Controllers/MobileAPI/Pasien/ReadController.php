<?php

namespace App\Http\Controllers\MobileAPI\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Keuangan\Departemen;
use App\Models\Urikkes\Paket;
use App\Models\Keuangan\Tarif;
use App\Models\Online\Transaksi;
use App\UserPasien;
use Auth;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getAllLayanan()
	{
		$poli = Poliklinik::all();
		$dep = Departemen::where('mobile_show', 1)->get();
		$dep->map(function ($q) {
		    $q['tipe'] = 'dep';
		    return $q;
		});

		$paket = Paket::all();
		$paket->map(function ($q) {
		    $q['tipe'] = 'paket';
		    return $q;
		});

		$checkup = $dep->merge($paket);
		return json_encode([
			'status' => 1,
			'poli' => $poli,
			'checkup' => $checkup
		]);
	}

	public function getSingleLayanan(Request $request)
	{
		$id = $request->id;

		if($request->tipe == 'dep'){
			$dep = Departemen::find($id);
			$tarif = Tarif::with('detail')->whereHas('detail', function($q){
                             $q->whereNotNull('biasa');
                    })->where('departemen_id', $id)->paginate(25);
			$tarif->map(function($q)
			{
				$q['biaya'] = $q->detail[0]->biasa;
				unset($q->detail);
				return $q;
			});
			return json_encode([
				'status' => 1,
				'departemen' => $dep,
				'tarif' => $tarif
			]);	
		}else{
			$paket = Paket::with(['tarifPaket.tarif.detail' => function($q)
                        {
                             $q->where('tarif_tipe_id', 5);
                    }, 'tarifPaket.tarif.tarif_kode' => function($q)
                        {
                             $q->get(['name']);
                    }, 'tarifPaket.tarif' => function($q)
                        {
                            $q->get(['deskripsi']);
                    }])->where('id', $id)->first();

			$paket->tarifPaket->map(function ($q) {
				$q['desc'] = $q->tarif->deskripsi;
			    $q['harga'] = $q->tarif->detail[0]->biasa;
			    unset($q->tarif);

			    return $q;
			});
			return json_encode([
				'status' => 1,
				'paket' => $paket,
			]);	
		}
	}

	public function getSinglePoliToday(Request $request)
	{
		$poli = Poliklinik::with(['jadwal.user' => function($query){
                      	return $query->get(['id', 'name', 'avatar_thumb']);
               }, 'transaksi' => function($query){
                      	return $query->whereIn('status',['1','2'])->whereDate('ordered_at', '=', Carbon::today()->toDateString())->orderBy('updated_at','desc')->get();
               },
               'last_antrian' => function($query2){
               		return $query2->orderBy('ordered_at','desc')->whereDate('ordered_at', '=', Carbon::today()->toDateString())->first();
               	}
               ])->find($request->poli_id);
		return json_encode([
			'poli' => $poli,
			'status' => 1
		]);		
	}

	public function getHistoriTransaksi(Request $request)
	{
		$user_id = Auth::guard('pasien')->id();
		$histori = Transaksi::with(['poli.poliklinik', 'urikkes.paket'])->where('users_pasien_id', $user_id)->orderBy('id', 'desc')->get();
		$histori->map(function ($q) {
			$q->layanan = $q->layanan;
		    return $q;
		});
		return json_encode([
			'status' => 1,
			'histori' => $histori
		]);			
	}

	public function etiket(Request $request)
	{
		$transaksi_id = $request->transaksi_id;
		$detail = Transaksi::with(['pasien'])->where('id', $transaksi_id)->first();
		$detail->pasien->age = $detail->pasien->age;
		$detail->pelayanan = $detail->layanan;
        unset($detail->poli);
        unset($detail->urikkes);
		return json_encode([
			'status' => 1,
			'data' => $detail
		]);
	}

	public function dataUser(Request $request)
	{
		$user = Auth::guard('pasien')->user();
		return json_encode([
			'status' => 1,
			'user' => $user
		]);
	}
}
