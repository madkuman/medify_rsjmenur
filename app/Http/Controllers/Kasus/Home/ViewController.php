<?php

namespace App\Http\Controllers\Kasus\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Log;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\ToDo;
use App\Models\Kasus\OperasiPermintaan;
use App\Models\RawatJalan\Transaksi as TransaksiRJ;
use App\Models\RawatJalan\PermintaanRujuk;
use Carbon\Carbon;
use DateTime;
use DB;

class ViewController extends Controller
{
	public function index($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$data['operasi'] = $this->getEventOperasi($kasus->id);
		$data['data_baru'] = $this->getDataBaru($kasus->id);
		//$data['todos'] = $this->getToDo($kasus->id);
		$data['activities'] = $this->getActivities($kasus->id);
		$data['sidebar_active'] = '';
		$data['kasus'] = $kasus;
		$transaksi_rj = TransaksiRJ::where('kasus_id',$kasus->id)->first();
		if(!empty($transaksi_rj->permintaan_rujuk_id))
			$data['rujuk'] = PermintaanRujuk::where('id',$transaksi_rj->permintaan_rujuk_id)->with('poli_asal','kasus')->first();
		return view('kasus.home.home',$data);
	}

	public function timeline($nomor_kasus)
	{
		$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
		$data['operasi'] = $this->getEventOperasi($kasus->id);
		$data['data_baru'] = $this->getDataBaru($kasus->id, true);
		$data['activities'] = $this->getActivities($kasus->id, true);
		$data['sidebar_active'] = 'timeline';
		$data['kasus'] = $kasus;
		$transaksi_rj = TransaksiRJ::where('kasus_id',$kasus->id)->first();
		if(!empty($transaksi_rj->permintaan_rujuk_id))
			$data['rujuk'] = PermintaanRujuk::where('id',$transaksi_rj->permintaan_rujuk_id)->first();

		return view('kasus.home.timeline',$data);
	}

	private function getEventOperasi($kasus_id)
	{
		$today = Carbon::today();
		$operasi = OperasiPermintaan::where('kasus_id',$kasus_id)->with('transaksi.ruangan')->get();

		foreach($operasi as $item)
		{	
			// dd($item->transaksi->status);
			if ($item->transaksi->status==0) 
			{	
				if(!empty($item->transaksi->jadwal_operasi))
				{
					$date = $item->transaksi->jadwal_operasi;
					$date_format = $date;

					if($date_format >= $today)
					{
						$first_operasi = $item->transaksi;

						$diff = $date_format->diffInDays($today);

						$first_operasi->diff = $diff;
						return $first_operasi;
					}
				}
			}
		}
		return null;
	}

	private function getDataBaru($kasus_id, $all = false)
	{
		$today = Carbon::today();
		/*
		$data['cppt'] = CPPT::where('type','create')
		->where('tab','cppt')
		->where('kasus_id',$kasus_id)
		->where('created_at','>',$today)
		->count();
		*/
		$data['cppt'] = CPPT::where('kasus_id',$kasus_id);

		if($all)
			$data['cppt'] = $data['cppt']->select(DB::raw('count(1) as total'))->first()->total;
		else
			$data['cppt'] = $data['cppt']->where('created_at','>',$today)->select(DB::raw('count(1) as total'))->first()->total;
		

		$data['penunjang'] = Log::where('type','create')
		->where('tab','like','penunjang%')
		->where('kasus_id',$kasus_id);

		if($all)
			$data['penunjang'] = $data['penunjang']->select(DB::raw('count(1) as total'))->first()->total;
		else
			$data['penunjang'] = $data['penunjang']->where('created_at','>',$today)
						->select(DB::raw('count(1) as total'))->first()->total;

		$tagihan = Tagihan::where('kasus_id',$kasus_id)->first();
		$data['tagihan'] = TagihanDetail::where('kasus_tagihan_id',$tagihan->id);

		if($all)
			$data['tagihan'] = $data['tagihan']->select(DB::raw('count(1) as total'))->first()->total;
		else
			$data['tagihan'] = $data['tagihan']->where('created_at','>',$today)
						->select(DB::raw('count(1) as total'))->first()->total;

		$all_log = Log::where('type','create')
			->where('kasus_id',$kasus_id);

		if($all)
			$all_log = $all_log->select(DB::raw('count(1) as total'))->first()->total;
		else
			$all_log = $all_log->where('created_at','>',$today)
						->select(DB::raw('count(1) as total'))->first()->total;

		$data['lain'] = $all_log - $data['cppt'] - $data['penunjang'] - $data['tagihan'];
		return $data;
	}

	private function getToDo($kasus_id)
	{
		$todos = ToDo::where('kasus_id',$kasus_id)->where('status',0)->get();
		return $todos;
	}

	private function getActivities($kasus_id, $all = false)
	{
		//dd($kasus_id,$all);
		$today = Carbon::today();
		$all_log = Log::where('kasus_id',$kasus_id)
		->orderBy('created_at','desc');

		if(!$all){
			$all_log = $all_log->where('created_at','>',$today)->with('creator')->paginate(10);
		}
		else{
			//dd('false');
			$all_log = $all_log->with('creator')->get();
		}

		foreach($all_log as $log)
		{
			$log_string = $this->generateLogString($log);
			$log->tab_string = $log_string['tab'];
			$log->type_string = $log_string['type'];
			$log->icon = $log_string['icon'];
		}

		return $all_log;
	}

	public function generateLogString($log)
	{
		$tab = $log->tab;
		$type = $log->type;
		$icon = 'fa-stethoscope';

		if($type == 'create') $type_string = 'menambahkan';
		elseif($type == 'edit') $type_string = 'mengubah';
		elseif($type == 'delete') $type_string = 'menghapus';
		elseif($type == 'close') $type_string = 'menutup';
		elseif($type == 'view') {
			$type_string = 'melihat';
			$icon = 'fa-eye';
		}
		else $type_string = '';

		if($tab == 'cppt') $tab_string = 'CPPT';
		elseif($tab == 'vital') $tab_string = 'Vital Sign';
		elseif($tab == 'diagnosis') $tab_string = 'Diagnosis';
		elseif($tab == 'tindakan') $tab_string = 'Tindakan';
		elseif($tab == 'identitas') $tab_string = 'Identitas';
		elseif($tab == 'identitas-pembayaran') $tab_string = 'Metode Pembayaran Pasien';
		elseif($tab == 'lokasi') $tab_string = 'Lokasi';
		elseif($tab == 'resep') $tab_string = 'Resep';
		elseif($tab == 'gizi') $tab_string = 'Gizi';
		elseif($tab == 'penunjang-radiologi') $tab_string = 'Hasil Radiologi';
		elseif($tab == 'penunjang-labpk') $tab_string = 'Hasil Lab';
		elseif($tab == 'permintaan-operasi') $tab_string = 'Permintaan Operasi';
		elseif($tab == 'tagihan') $tab_string = 'Tagihan';
		elseif($tab == 'kasus') $tab_string = 'Kasus';
		elseif($tab == 'administrasi') $tab_string = 'Administrasi';
		elseif($tab == 'bpjs') $tab_string = 'BPJS';
		elseif($tab == 'histori') $tab_string = 'Histori';
		elseif($tab == 'datamedis') $tab_string = 'Data Medis';
		elseif($tab == 'keperawatan') $tab_string = 'Keperawatan';
		elseif($tab == 'kolaborator') $tab_string = 'Kolaborator';
		elseif($tab == 'operasi') $tab_string = 'Operasi';
		elseif($tab == 'pengaturan') $tab_string = 'Pengaturan';
		elseif($tab == 'penunjang') $tab_string = 'Penunjang';
		elseif($tab == 'kolab-admin') $tab_string = 'DPJP';
		elseif($tab == 'bpjs-sep') $tab_string = 'SEP untuk BPJS';
		elseif($tab == 'resume') $tab_string = 'Resume';
		elseif($tab == 'histori-bayar') $tab_string = 'Histori Pembayaran';


		elseif (strpos($tab, 'alat') !== false) {
			$tab_string = "asesmen ".substr($tab, 5);
			$icon = 'fa-calculator';
		}

		elseif($tab == 'krs')
		{
			$type_string = 'melakukan';
			$tab_string = 'KRS';
			$icon = 'fa-home';
		}
		
		elseif($tab == 'administrasi-rawatinap-daftar') 
		{
			$type_string = 'mendaftarkan ke';
			$tab_string = 'Rawat Inap';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-igd-pindah') 
		{
			$type_string = 'Pindah Ruang';
			$tab_string = 'IGD';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-rawatinap-pindah') 
		{
			$type_string = 'Pindah Ruang';
			$tab_string = 'Rawat Inap';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-rawatjalan-daftar') 
		{
			$type_string = 'mendaftarkan ke';
			$tab_string = 'Rawat Jalan';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-igd-daftar') 
		{
			$type_string = 'mendaftarkan ke';
			$tab_string = 'IGD';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-rawatinap-masuk') 
		{
			$type_string = 'memasuki kamar di';
			$tab_string = 'Rawat Inap';
			$icon = 'fa-file-text';
		}
		elseif($tab == 'administrasi-jenazah-daftar') 
		{
			$type_string = 'mendaftarkan permintaan jemput ke';
			$tab_string = 'Kamar Jenazah';
			$icon = 'fa-file-text';
		}
		else
		{
			$tab = '';
			$tab_string = '';
		}

		$data['type'] = $type_string;
		$data['tab'] = $tab_string;
		$data['icon'] = $icon;

		return $data;
	}
}
