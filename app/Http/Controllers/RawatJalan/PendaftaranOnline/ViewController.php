<?php

namespace App\Http\Controllers\RawatJalan\PendaftaranOnline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;
use App\Models\Pasien\Pasien;
use DNS1D;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index()
	{
		$data['poli'] = Poliklinik::all();
		return view('rawatjalan.pendaftaran-online.check-in',$data);
	}

	public function checkIn(Request $request)
	{	
		$pasien = Pasien::where('no_rm',$request->no_rm)->first();

		//cek apakah pasien ditemukan
		if(empty($pasien->id)){
			$return['status'] = 0;
			$return['message'] = 'Kode pasien atau nomor RM tidak sesuai';
			return json_encode($return);
		}
		$transaksi = Transaksi::with(['poliklinik', 'pasien', 'pasien_pembayaran', 'pasien_pembayaran.perusahaan.tipe'])->where('pasien_id',$pasien->id)->where('id',$request->kode_booking)->first();
		
		//cek apakah transaksi ditemukan
		if(!empty($transaksi->id)){
			$today_start = Carbon::today();
			$today_end = Carbon::today()->endOfDay();

			//cek apakah kode boking berlaku untuk hari ini
			if($transaksi->ordered_at >= $today_start && $transaksi->ordered_at <= $today_end)
			{
				$data['ordered_at'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($transaksi->ordered_at,'%d %B %Y, %H:%M');
				$data['barcode'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($transaksi->pasien->no_rm, "C128",3,30) . '" alt="barcode"  style="width:900px;" />';
				$data['transaksi'] = $transaksi;
				$return['status'] = 1;
				$return['data'] = $data;
			}
			else{
				$return['status'] = 0;
				$return['message'] = 'Booking ini tidak berlaku untuk hari ini. Silahkan cek lagi jadwal Anda.';
			}

		}
		else{
			$return['status'] = 0;
			$return['message'] = 'Kode pasien atau nomor RM tidak sesuai';
		}
		return json_encode($return);
		



	}	
}
