<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Http\Controllers\Kasus\Penunjang\ReadController as PenunjangRead;
use App\Http\Controllers\Kasus\PenunjangPermintaan\ReadController as PenunjangPermintaanRead;
use App\Http\Controllers\Keuangan\Tarif\ReadController as KeuanganTarif;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use MPDF;
use DNS1D;
use DNS2D;
use Auth;

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