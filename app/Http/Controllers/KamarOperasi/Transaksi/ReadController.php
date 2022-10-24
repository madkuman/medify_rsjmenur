<?php

namespace App\Http\Controllers\KamarOperasi\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\ICD9;
use App\User as Dokter;
use App\Models\KamarOperasi\Ruangan;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use DB;
use DataTables;

define('relasi_read', ['pasien_detail','dokter','kasus.pembayaran.perusahaan','kasus.pembayaran.perusahaan.tipe','kasus.lokasi.lokasi','jenis_spesialis','ruangan','pembuat_jadwal','kasus']);

class ReadController extends Controller
{
	public function getAsuransi()
	{
		$asuransi = PembayaranPerusahaan::all();
		return $asuransi;
	}

	public function getPerusahaan()
	{
		$company = PembayaranPerusahaan::all();
		return $company;
	}

	public function getList($ruangan_id)
	{
		$items = Transaksi::with(relasi_read)->where('ruangan_id',$ruangan_id)->whereDate('created_at', '=', Carbon::today()->toDateString())->orderBy('nomor_ronde','asc')->get();
		return json_encode(['data'=>$items]);
	}

	public function ajaxGetTransaksi(Request $request)
	{	
		$ruangan_id = $request->get('ruangan_id');
		$dokter_id = $request->get('dokter_id');
		$jenis_spesialis = $request->get('jenis_spesialis');
		$tanggal_min = $request->get('tanggal_min');
		$tanggal_max = $request->get('tanggal_max');
		// dd($ruangan_id,$dokter_id);

		$tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

		$items = Transaksi::with(relasi_read);
		if($ruangan_id != 'all') $items = $items->where('ruangan_id', $ruangan_id);
		if($dokter_id != 'all') $items = $items->where('doctor_id', $dokter_id);
		if($jenis_spesialis != 'all') $items = $items->where('jenis_spesialis_id', $jenis_spesialis);
		$items = $items->whereBetween('jadwal_operasi', [$tanggal_min,$tanggal_max]);

		$items = $items->orderBy('ruangan_id', 'asc')->get();
		$data = [];
		$no = 1;	
		$status_selesai = '<span class="badge badge-success">Terlaksana</span>';
		$status_belum = '<span class="badge badge-info">Perencanaan</span>';

		foreach($items as $item)
		{
			$detail_btn = '<a href="'.url('/kamaroperasi/pelaksanaan/'.$item->id).'" class="btn btn-primary dropdown-item">Detail</a>';
			$item->pasien_detail->gender == 1 ? $jk = 'Laki laki' : $jk = 'Perempuan';
			$tgl_operasi = $item->jadwal_operasi->format('d F Y');

			if(!empty($item->kasus) && !empty($item->kasus->pembayaran)) $type = $item->kasus->pembayaran->perusahaan->tipe->nama.' - '.$item->kasus->pembayaran->perusahaan->nama;
			else $type = '-';

			if(!empty($item->kasus->lokasi->lokasi->nama)) $lokasi = $item->kasus->lokasi->lokasi->nama;
			else $lokasi = '-';

			if(!empty($item->jenis_spesialis->nama)) $jenis_spesialis = $item->jenis_spesialis->nama;
			else $jenis_spesialis = '-';

			$temp = [
				'no' => $no++,
				'name' => $item->pasien_detail->name.'<br><small>'.$jk.'<br> '.$item->pasien_detail->age.' tahun<br>'.$tgl_operasi.'</small>',
				'lokasi' => $lokasi,
				'type' => $type,
				'ruangan' => $item->ruangan->name,
				'nomor_ronde' => $item->nomor_ronde,
				'doctor' => $item->dokter->name,
				'diagnosis' => $item->diagnosis,
				'jenis_spesialis' => $jenis_spesialis,
				'status' => $item->status == 1 ? $status_selesai : $status_belum,
				'by' => !empty($item->dijadwalkan_oleh) ? $item->pembuat_jadwal->name : "-",
				'aksi' => '<button type="button" class="btn btn-secondary dropdown-toggle" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>

						<div class="dropdown-menu" aria-labelledby="toolbarDrop">
							'.$detail_btn.'
							<a href="'.url('kamaroperasi/pendaftaran/').'/'.$item->id.'`" class="btn btn-warning dropdown-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ubah Jadwal">
								Ubah Jadwal
							</a>
						</div>'
			];
			$data[] = $temp;
		}
		return response()->json($data);
	}


	public function ajaxGetJadwalKosong(Request $request)
	{
		$ruangan_id = $request->get('id');
		$ruangan = Ruangan::find($ruangan_id);
		$jadwal = $request->get('tanggal');
		/*$items = Transaksi::with('pasien_detail','dokter')->where('ruangan_id',$ruangan_id)->whereDate('jadwal_operasi', '=', $jadwal)->orderBy('nomor_ronde','asc')->get();

		foreach($items as $item)
		{
			$item->pasien_detail->age = $item->pasien_detail->age;
			$item->pasien_detail->jenis_kelamin = $item->pasien_detail->jenis_kelamin;
		}*/

		$item_set = array();
		for($i=1;$i<=$ruangan->ronde;$i++)
		{
			$item = Transaksi::with(relasi_read)->where('ruangan_id',$ruangan_id)->where('nomor_ronde',$i)->whereDate('jadwal_operasi', '=', $jadwal)->orderBy('nomor_ronde','asc')->first();

			if(!empty($item))
			{
				$item->pasien_detail->age = $item->pasien_detail->age;
				$item->pasien_detail->jenis_kelamin = $item->pasien_detail->jenis_kelamin;
			}

			array_push($item_set, $item);
		}


		return json_encode($item_set);
	}


	public function listDokter()
	{
		$items = Dokter::where('profesi','1')->get();
		return $items;
	}

	public function getdokter(Request $request){

		$search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
		if(!empty($search))
			$dokter = Dokter::search($search)->where('profesi','1')->paginate(10);
		else
			$dokter = Dokter::where('profesi','1')->orderBy('id', 'asc')->paginate(10);

		return json_encode($dokter);
	}

	public function listKamar()
	{
		$items = Ruangan::all();
		return $items;
	}

	public function rondeTerbooking($ruangan_id,$date)
	{
		//
		$ronde = Transaksi::select('nomor_ronde')->where('ruangan_id',$ruangan_id)->whereDate('jadwal_operasi', '=', $date)->pluck('nomor_ronde')->toArray();
		return $ronde;
	}

	public function singleDokter($dokter_id)
	{
		$items = Dokter::find($dokter_id);
		return $items;
	}

	public function singlePasien($pasien_id)
	{
		$items = Pasien::find($pasien_id);
		return $items;
	}

	public function singleKamar($kamar_id)
	{
		$items = Ruangan::find($kamar_id);
		return $items;
	}

	public function ajaxRondeSisa(Request $request)
	{
		$ruangan_id = $request->get('ruangan');
		$jadwal = $request->get('tanggal');
		if(is_null($jadwal) || empty($jadwal))
			return json_encode([]);

		if(count(explode('/', $jadwal)) < 3) return json_encode([]);

		$jadwal = Carbon::createFromFormat('d/m/Y', $jadwal)->format('Y-m-d');
		$jumlah_ronde = Ruangan::find($ruangan_id)->ronde;
		$all_ronde = [];
		for ($i=1; $i <= $jumlah_ronde ; $i++) {
			$all_ronde[] = $i;
		}
		$ronde_unavailable = $this->rondeTerbooking($ruangan_id, $jadwal);

		$sisa = array_diff($all_ronde, $ronde_unavailable);

		return json_encode($sisa);
	}

	public function ajaxGetJadwalRekap(Request $request)
	{
		$date = $request->get('date');
		if(empty($date))
		{
			$date = Carbon::today();
			$date = $date->format('Y-m-d');
		}

		$transaksi = Transaksi::where('jadwal_operasi',$date)->with(relasi)->orderBy('ruangan_id','asc')->get();

		foreach($transaksi as $item)
		{
			$item->pasien_detail->age = $item->pasien_detail->age;
			$item->pasien_detail->jenis_kelamin = $item->pasien_detail->jenis_kelamin;
		}


		return json_encode($transaksi);
	}

	public function ajaxSearchPasien(Request $request)
	{
		$search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('search'));
		if (empty($search))
		{
				return response()->json([]);
		}

		$pasien = Pasien::search($search)->rule(\App\SearchRule\Pasien::class)
                ->pluck(['id', 'name as text'])->get();
		return response()->json($pasien);
	}

	public function ajaxSearchDiagnosis(Request $request)
	{
		$term = trim($request->search);
		if (empty($term))
		{
				return response()->json([]);
		}

		$diagnosis = ICD10::select(['id', DB::raw("CONCAT(code_icd, ' - ', long_desc) as text")])->where('long_desc', 'like', "%{$term}%")->orWhere('code_icd', 'like', "%{$term}%")->get()->toArray();
		return response()->json($diagnosis);
	}

	public function ajaxGetPasienSummary(Request $request)
	{
		$pasien = Pasien::where('id', $request->input('id'))->first();
		$pasien->age = $pasien->age;
		return response()->json($pasien);
	}

	public function ajaxGetPermintaanJadwal(Request $request)
	{
		$columns = array(
                    0 =>'no',
                    1=> 'identitas',
                    2=> 'jenis',
                    3=> 'diagnosis',
                    4=> 'keterangan',
                    5=> 'created_at',
                    6=> 'masa_tunggu',
                    7=> 'aksi'
                );


		$totalData = Transaksi::whereNull('parent_id')->where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)->count();
	    $totalFiltered = $totalData;
	    $limit = $request->input('length');
	    $start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');

    $permintaans = Transaksi::whereNull('parent_id')->with(relasi_read)->where([['status',0],['ruangan_id',NULL]])->orWhere('status', 2)
                   ->offset($start)
                   ->limit($limit)
                   ->orderBy($order, $dir)
                   ->get();
    $data = array();
    if (!empty($permintaans))
    {
      Carbon::setLocale('id');
      foreach ($permintaans as $i => $permintaan)
      {
        if ($permintaan->status == 2)
          $keterangan = 'Penjadwalan Ulang - '.$permintaan->getCurrentPergantianJadwal()->keterangan;
        else
        {
          $keterangan = $permintaan->keterangan;
        }

        $permintaan->pasien_detail->gender == 1 ? $jk = 'Laki laki' : $jk = 'Perempuan';

        if(!empty($permintaan->kasus->pembayaran->perusahaan->tipe->nama)) $type = $permintaan->kasus->pembayaran->perusahaan->tipe->nama.' - '.$permintaan->kasus->pembayaran->perusahaan->nama;
        else $type = '-';

        $dokter = $permintaan->dokter ? $permintaan->dokter->name : 'Belum ada dokter';

		if ($permintaan->masa_tunggu)
		{
			$masa_tunggu = Carbon::parse($permintaan->masa_tunggu);
			$ubah_masa_tunggu = 'change_id('.$permintaan->id.', \''.$masa_tunggu->format('d/m/Y').'\')';
			$now = Carbon::now();
			if ($now->diffInDays($masa_tunggu) < 1)
			{
				if ($masa_tunggu->isToday())
					$masa_tunggu = 'Hari ini';
				else
					$masa_tunggu = '1 hari dari sekarang';
			}
			else
				$masa_tunggu = $masa_tunggu->diffForHumans();
		}
		else
		{
			$ubah_masa_tunggu = 'change_id('.$permintaan->id.', \'\')';
			$masa_tunggu = '-';
		}

		if(!empty($permintaan->kasus->lokasi->lokasi->nama)) $lokasi = $permintaan->kasus->lokasi->lokasi->nama;
		else $lokasi = '-';


        $tempdata['no'] = $i+1;
        $tempdata['identitas'] = $permintaan->pasien_detail->name.'<br><small>'.$jk.', '.$permintaan->pasien_detail->age.' tahun</small>';
        $tempdata['lokasi'] = $lokasi;
        $tempdata['jenis'] = $type;
        $tempdata['diagnosis'] = $permintaan->diagnosis ? $permintaan->diagnosis : '-';
        $tempdata['keterangan'] = $keterangan;
        $tempdata['waktu_permintaan'] = $permintaan->getWaktuPermintaan()->diffForHumans().'<br><small>'.$dokter.'</small>';
        $tempdata['masa_tunggu'] = $masa_tunggu.'<br><button class="btn btn-default btn-sm" onclick="'.$ubah_masa_tunggu.'" id="'.$permintaan->id.'" data-toggle="modal" data-target="#masa_tunggu_modal">Ubah</button>';
        $tempdata['aksi'] = '
        					<button type="button" class="btn btn-outline-danger btn-fill tolak-pemesanan" onclick="tolakButton('.$permintaan->id.')" data-toggle="tooltip" data-placement="top" title="Tolak">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            	</button>
                            	<a href="'.url('kamaroperasi/pendaftaran/'.$permintaan->id).'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Daftarkan">
        						<i class="fa fa-check"></i>
        					</a>
                            ';
        $data[] = $tempdata;
      }
    }

    //<-- Gak Perlu Diubah -->
    $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
                );

		return response()->json($json_data);
	}

	public function printJadwal(Request $request)
	{
		$ruangan_id = $request->get('ruangan_id');
		$dokter_id = $request->get('dokter_id');
		$tanggal_min = $request->get('tanggal_min');
		$tanggal_max = $request->get('tanggal_max');
		$jenis_spesialis = $request->get('jenis_spesialis');
		//dd($ruangan_id,$dokter_id);

		$tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

		$items = Transaksi::whereNull('parent_id')->with('pasien_detail','dokter');
		if($ruangan_id != 'all') $items = $items->where('ruangan_id', $ruangan_id);
		if($dokter_id != 'all') $items = $items->where('doctor_id', $dokter_id);
		if($jenis_spesialis != 'all') $items = $items->where('jenis_spesialis_id', $jenis_spesialis);
		$items = $items->whereBetween('jadwal_operasi', [$tanggal_min,$tanggal_max]);

		$items = $items->orderBy('ruangan_id', 'asc')->get();

		return $items;
	}

	public function checkDuplicateTransaksi(Request $request)
	{
		if(empty($request->tanggal)) return json_encode([]);
		$tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal)->startOfDay();
		$transaksi = Transaksi::where('pasien_id',$request->pasien)->where('jadwal_operasi','>=',$tanggal)->get();
		
		$result = [];
		foreach($transaksi as $item)
		{
			$temp = new \stdClass();
			$temp->tanggal = $item->jadwal_operasi->format('d F Y');
			$temp->diagnosis = $item->diagnosis;
			array_push($result, $temp);
		}

		return $result;
	}
}
