<?php

namespace App\Http\Controllers\Kasus\Farmasi;

use App\Models\Kasus\Resep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\Kasus\CatatanPengobatanPasien;
use App\Models\Kasus\CatatanPengobatanPasienDetail;
use Carbon\Carbon;
use DOMPDF;
use MPDF;
use DB;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		return redirect('kasus/'.$nomor_kasus.'/farmasi/pengobatan-pasien');
	}
	public function pengobatanPasien($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$pengobatan = CatatanPengobatanPasien::with(['item_master','details.verifikator_1','details.verifikator_2'])->where('kasus_id',$kasus->id)->orderBy('selesai_at','asc')->orderBy('id','desc')->get();
		
		$pengobatan_id = $pengobatan->pluck('id')->toArray();

		$riwayat = CatatanPengobatanPasienDetail::whereIn('catatan_pengobatan_pasien_id',$pengobatan_id)->orderBy('pemberian_at','asc')->get();
		
		$riwayat_date = [];
		$riwayat_date_count = [];

		if(count($riwayat) > 0){
			$start = Carbon::parse($riwayat[0]->pemberian_at);
			$end = Carbon::parse($riwayat[count($riwayat)-1]->pemberian_at);
			$current = Carbon::parse($riwayat[0]->pemberian_at);

			while($current <= $end)
			{
				$riwayat_date[] = $current->startOfDay()->copy();
				$current->addDay();
			}
		}
		$riwayat_date = array_unique($riwayat_date);

		foreach($riwayat_date as $item)
		{
			$start = $item->copy()->startOfDay();
			$end = $item->copy()->endOfDay();

			$count = CatatanPengobatanPasienDetail::select(DB::raw('count(1) as total'))->whereIn('catatan_pengobatan_pasien_id',$pengobatan_id)->whereBetween('pemberian_at',[$start,$end])->groupBy('catatan_pengobatan_pasien_id')->orderBy('total','desc')->first();
			if(!empty($count)) $total = $count->total;
			else $total = 0;

			if($total < 6) $total = 6;

			$riwayat_date_count[$item->format('d F Y')] = $total;
		}

		$kolaborator = Kolaborator::where('kasus_id',$kasus->id)->with('user')->get();

		$data['kasus'] = $kasus;
		$data['kolaborator'] = $kolaborator;
		$data['pengobatan'] = $pengobatan;
		$data['riwayat'] = $riwayat;
		$data['riwayat_date'] = $riwayat_date;
		$data['riwayat_date_count'] = $riwayat_date_count;
		$data['sidebar_active'] = 'farmasi';
		$data['active_nav'] = 'pengobatan';
		return view('kasus.farmasi.pengobatan-pasien',$data);
	}

	public function print($nomor_kasus)
	{
		ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "2500000");
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$pengobatan = CatatanPengobatanPasien::with(['item_master','details.verifikator_1','details.verifikator_2'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();
		
		$pengobatan_id = $pengobatan->pluck('id')->toArray();

		$riwayat = CatatanPengobatanPasienDetail::whereIn('catatan_pengobatan_pasien_id',$pengobatan_id)->orderBy('pemberian_at','asc')->get();
		$obat = Resep::select(DB::Raw('IFNULL(obat_name,racikan) as nama_obat, aturan,sum(jumlah) as jumlah'))->join('resep_detail','resep.id','=','resep_detail.kasus_resep_id')->where('kasus_id',$kasus->id)->whereHas('transaksi_farmasi',function ($query){
		    $query->from(config('app.db_name').'_farmasi.transaksi_obat');
		    $query->where('status',1);
        })->groupby('nama_obat','aturan')->get();
		$new_obat=[];
		foreach ($obat as $item){
            $new_obat[$item->nama_obat][$item->aturan] = $item->jumlah;
        }
		$riwayat_date = [];


		if(count($riwayat) > 0){
			$start = Carbon::parse($riwayat[0]->pemberian_at);
			$end = Carbon::parse($riwayat[count($riwayat)-1]->pemberian_at);
			$current = Carbon::parse($riwayat[0]->pemberian_at);

			while($current <= $end)
			{
				$riwayat_date[] = $current->startOfDay()->copy();
				$current->addDay();
			}
		}
		$riwayat_date = array_unique($riwayat_date);

		if($riwayat_date){
			$awal = $riwayat_date[0];
			$akhir = $riwayat_date[count($riwayat_date)-1];
			$jml_halaman = ceil((count($riwayat_date)/3));
		}
		else{
			$awal = '';
			$akhir = '';
			$jml_halaman = 1;	
		}
		$kolaborator = Kolaborator::where('kasus_id',$kasus->id)->with('user')->get();

		$data['kasus'] = $kasus;
		$data['kolaborator'] = $kolaborator;
		$data['pengobatan'] = $pengobatan;
		$data['riwayat'] = $riwayat;
		$data['riwayat_date'] = $riwayat_date;
		$data['jml_halaman'] = $jml_halaman;
		$data['awal'] = $awal;
		$data['akhir'] = $akhir;
		$data['obat_resep'] = $new_obat;
		
		$pdf = MPDF::loadView('kasus.farmasi.print-pemberian-obat',$data, [], ['format' => 'a4-L']);
		return $pdf->stream('print.pdf');
	}

	public function obatLuar($nomor_kasus)
	{
		$data['kasus'] = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$pdf = DOMPDF::loadView('kasus.farmasi.print-obat-luar',$data);
		return $pdf->stream('print.pdf');
	}

	public function obatPerOral($nomor_kasus)
	{
		$data['kasus'] = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$pdf = DOMPDF::loadView('kasus.farmasi.print-obat-per-oral',$data);
		return $pdf->stream('print.pdf');
	}
}
