<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Http\Controllers\Kasus\Penunjang\ReadController as PenunjangRead;
use App\Http\Controllers\Kasus\PenunjangPermintaan\ReadController as PenunjangPermintaanRead;
use App\Http\Controllers\Keuangan\Tarif\ReadController as KeuanganTarif;
use App\Models\Hospital\Kelas;
use App\Models\Kasus\PenunjangPermintaan;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifTipe;
use App\Models\LabPK\Transaksi as TransaksiLabPK;
use App\Models\Radiology\Transaction as TransaksiRadiologi;
use MPDF;
use DNS1D;
use DNS2D;
use Auth;
use Carbon\Carbon;

class ViewController extends Controller
{
	protected $readPenunjang;
	protected $readPermintaan;
	protected $keuanganTarif;

	public function __construct(PenunjangRead $readPenunjang, PenunjangPermintaanRead $readPermintaan, KeuanganTarif $keuanganTarif)
	{
		$this->readPenunjang = $readPenunjang;
		$this->readPermintaan = $readPermintaan;
		$this->keuanganTarif = $keuanganTarif;
	}


	public function index($nomor_kasus)
	{	
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['start'] = microtime(true);
		$data['kasus'] = $kasus;
		$data['penunjang'] = $this->readPenunjang->get($kasus->id);
		$data['permintaan'] = $this->readPermintaan->get($kasus->id);
		$data['kelas'] = Kelas::get();
		$data['sidebar_active'] = 'penunjang';
		$data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'view','penunjang',null);
		return view('kasus.penunjang.index',$data);
	}

	public function histori($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$kasus_id = Kasus::where('pasien_id',$kasus->pasien_id)->pluck('id')->toArray();
		$permintaan = $this->readPermintaan->getHistori($kasus_id);
		$data['permintaans'] = [];
		foreach ($permintaan as $value) 
		{	
			if(empty($data['permintaans'][$value->kasus_id]))
			{
				$data['permintaans'][$value->kasus_id] = [];
				array_push($data['permintaans'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['permintaans'][$value->kasus_id],$value);
			}
		}
		// dd($data);
		return view('kasus.penunjang.content.permintaan.histori-permintaan',$data);
	}

	public function hasilLab($nomor_kasus, Request $request)
	{
		$date_start = $request->daterange_start ?? null;
		$date_end = $request->daterange_end ?? null;
		$data['date_start'] = $date_start;
		$data['date_end'] = $date_end;
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$start = !empty( $request->daterange_start) ?  Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay() : null;
		$end = !empty( $request->daterange_end) ?  Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay() : null;
		
		$id_transksi_radiologi =  TransaksiRadiologi::where('patient_id', $kasus->pasien_id)->when($date_start != null && $date_end != null , function($ada_date_start) use ($start, $end) {
			$ada_date_start->whereBetween('result_created_at' , [$start, $end]);
		})->whereNotNull('result_created_at')->pluck('id')->toArray();
        $id_transaksi_labpk =  TransaksiLabPK::where('pasien_id', $kasus->pasien_id)->when($date_start != null , function($ada_date_start) use ($start, $end) {
			$ada_date_start->whereBetween('result_created_at', [$start, $end]);
		})->whereNotNull('result_created_at')->pluck('id')->toArray();

		$data_permintaan = PenunjangPermintaan::where(function ($where1) use ($kasus, $id_transksi_radiologi, $id_transaksi_labpk){
			$where1->where(function($where_radiologi) use ($kasus, $id_transksi_radiologi) {
				$where_radiologi->whereIn('transaksi_id', $id_transksi_radiologi)->where('modul_id', 6);
			})->orWhere(function($orWhere_labPK) use  ($kasus, $id_transaksi_labpk) {
				$orWhere_labPK->whereIn('transaksi_id', $id_transaksi_labpk)->where('modul_id', 10);
			});
		})->orderBy('kasus_id','desc')->get()->each->setAppends(['transaksi'])->filter(function($filter) use ($kasus) {
			$pasien_id = ($filter->modul_id == 6) ? $filter->transaksi->patient_id : $filter->transaksi->pasien_id;
			return $pasien_id == $kasus->pasien_id;
		});
		$hasil_pemeriksaaan = [];
		$tanggal_result_created_at = [];
		$data_param_radiologi = [
			(object) [
				'params' => 'Kali',
				'variabel' => 'qty',
			],
			(object) [
				'params' => 'Film dipakai',
				'variabel' => 'film_dipakai',
			],
			(object) [
				'params' => 'Film ditolak',
				'variabel' => 'film_ditolak',
			],
			(object) [
				'params' => 'Ukuran Film',
				'variabel' => 'ukuran_film',
			],
			(object) [
				'params' => 'Foto Ulang',
				'variabel' => 'alasan_foto_ulang',
			],
			(object) [
				'params' => 'Kontras dipakai',
				'variabel' => 'kontras_dipakai',
			],
			(object) [
				'params' => 'Kontras dikembalikan',
				'variabel' => 'kontras_dikembalikan',
			],
		];		
		foreach ($data_permintaan ?? [] as $index_kategori => $kategori) {
			$tanggal_result_created_at[$index_kategori] = date('d/m/Y', strtotime($kategori->transaksi->result_created_at));
			foreach ($kategori->transaksi->detail ?? [] as $key => $detail_transaksi) {
				if($kategori->modul_id == 10) { //Lab PK
					foreach ($detail_transaksi->hasil ?? [] as $key2 => $hasil_pemeriksaan) {
						//lab-pk, nama kategori tarif, nama tarif, parameter, index tanggal
						$hasil_pemeriksaaan['lab-pk'][$detail_transaksi->tarif->kategori->nama][$detail_transaksi->tarif->deskripsi][$hasil_pemeriksaan->parameter]['value'][$index_kategori] = $hasil_pemeriksaan->value;

						$referensi_text = '';
						if(isset($hasil_pemeriksaan->referensi_min) || isset($hasil_pemeriksaan->referensi_max)) {
							$referensi_text = ( $hasil_pemeriksaan->referensi_min ?? ' ( )' ) . ' - ' . ( $hasil_pemeriksaan->referensi_max ?? ' ( )' );
						} else {
							$referensi_text = ( $hasil_pemeriksaan->referensi_lainnya ?? ' - ' );  
						};
						$hasil_pemeriksaaan['lab-pk'][$detail_transaksi->tarif->kategori->nama][$detail_transaksi->tarif->deskripsi][$hasil_pemeriksaan->parameter]['referensi'] = $referensi_text;
					};
				} else if ($kategori->modul_id == 6) { //radiologi
					foreach ($data_param_radiologi as $key => $param_radiologi) {
						$var = $param_radiologi->variabel;
						$value = $detail_transaksi->$var;
						//radiologi, nama kategori tarif, nama tarif, parameter radiologi, index tanggal
						$hasil_pemeriksaaan['radiologi'][$detail_transaksi->tarif->kategori->nama][$detail_transaksi->tarif->deskripsi][$param_radiologi->params]['value'][$index_kategori] = $value ?? null;
					}
				}
			} ;
		};
		$data['hasil_pemeriksaaan'] = $hasil_pemeriksaaan;
		$data['tanggal_result_created_at'] = $tanggal_result_created_at;
		set_time_limit(500);
		return view('kasus.penunjang.content.galeri.hasil-lab',$data);
	}

	public function historiGaleri($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$kasus_id = Kasus::where('pasien_id',$kasus->pasien_id)->pluck('id')->toArray();
		$penunjang = $this->readPenunjang->getHistori($kasus_id);
		$data['nomor_kasus'] = $nomor_kasus;
		$data['penunjangs'] = [];
		foreach ($penunjang as $value) 
		{	
			if(empty($data['penunjangs'][$value->kasus_id]))
			{
				$data['penunjangs'][$value->kasus_id] = [];
				array_push($data['penunjangs'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['penunjangs'][$value->kasus_id],$value);
			}
		}
		// dd($data);
		return view('kasus.penunjang.content.galeri.histori-galeri',$data);
	}

	public function form($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->with('urikkes_penunjang_baru', 'urikkes_penunjang_baru.transaksi_detail')->first();
		if(!is_null($kasus->urikkes_penunjang_baru)){
			$urikkes = $kasus->urikkes_penunjang_baru->detail_tarif_id;
			$tarif_urikkes = '';			
			foreach($urikkes as $key => $u){
				$tarif_urikkes .= $u;
				if(isset($urikkes[$key+1]))
					$tarif_urikkes .= ',';
			}
			$data['tarif_urikkes'] = $tarif_urikkes;
		}
		$data['kasus'] = $kasus;
		$data['kelas'] = Kelas::get();
		$data['tipe'] = TarifTipe::get();
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$data['user'] = Auth::user();
		$data['is_dokter'] = $data['user']->profesi == config('const.profesi_dokter');
		$data['has_dpjp'] = !is_null($kasus->dpjp);
		return view('kasus.penunjang.content.permintaan.create', $data);
	}

	public function detailImg(Request $req, $nomor_kasus, $id)
	{
		$action = $req['action'] ? $req['action'] : 'current';
		$data['sidebar_active'] = 'penunjang';
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['kasus'] = $kasus;
		$data['kelas'] = Kelas::get();
		$data['item'] = $this->readPenunjang->getDetailItem($id, $action);
		if($data['item']->file_type == 'image'){
			$data['dimension'] = $this->getImageDimension($data['item']->file_primary);
		}
		return view('kasus.penunjang.content.galeri.detail-img', $data);
	}

	private function getImageDimension($url){
		$detail = getimagesize($url);
		return [
			'width' => $detail[0],
			'height' => $detail[1]
		];
	}

	public function printBarcode($nomor_kasus,$barcode,$slug)
	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		$data['detail'] = app('App\Http\Controllers\LabPK\Transaksi\ReadController')->getTransactionDetailBySlug($slug);
		$data['kasus'] = $kasus;
		$data['barcode'] = $barcode;
		$data['barcode_img'] = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($barcode, "C128",1,50) . '" alt="barcode"   />';
		
		//return view('kasus.penunjang.content.permintaan.print-barcode',$data);
		
		$pdf = MPDF::loadView('kasus.penunjang.content.permintaan.print-barcode', $data, [], [
			'mode' => 'utf-8',
			'format' => [50, 35]
		]);
		$filename = $barcode;
		return $pdf->stream($filename);
		
	}


}