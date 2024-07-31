<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use App\Models\Farmasi\Resep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\AturanHarga;
use App\Models\Farmasi\ItemJenisInteraksi;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\LoketAntrian;
use App\Models\Farmasi\TipeObat;
use App\Models\Farmasi\SatuanPenggunaan;
use App\Models\Hospital\Lokasi;
use App\Models\Kasus\Kasus;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Hospital\LokasiDepartemen;
use Carbon\Carbon;
use DOMPDF;
use Yajra\DataTables\DataTables;

class ViewController extends Controller
{
	public function index(Request $request, $farmasi)
	{
		$farm = session('farmasi');
		$tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();

		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$satuan_penggunaan = TipeObat::all();
		if($request->pasien) $data['nama_pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($request->pasien)->name;
		else $data['nama_pasien'] = null;
		$data['satuan_penggunaan'] = $satuan_penggunaan;
		$data['aturan'] = $aturan;
		$data['farmasi'] = $farm;
		$data['tipe'] = $tipe;
		$data['lokasi'] = Lokasi::all();
		$data['jenis_pembayaran'] = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getAllTipe();
		$data['sidebar_active'] = "transaksi";
		
		$data['tanggal_awal'] = (!empty($request->tanggal_awal)) ? $request->tanggal_awal : Carbon::today()->format('d/m/Y') ;
		$data['tanggal_akhir'] = (!empty($request->tanggal_akhir)) ? $request->tanggal_akhir : Carbon::today()->format('d/m/Y') ;

		$data['tanggal_awal'] = ($request->is_reset) ? NULL : $data['tanggal_awal'] ;
		$data['tanggal_akhir'] = ($request->is_reset) ? NULL : $data['tanggal_akhir'] ;

		$data['harga_minimal'] = $request->harga_minimal;
		$data['harga_maksimal'] = $request->harga_maksimal;
		$data['no_resep'] = $request->no_resep;
		$data['no_rm'] = $request->no_rm;
		$data['pasien'] = $request->pasien;
		$data['status_selesai'] = ($request->selesai) ? $request->status_selesai : "";        
		$data['status_dikerjakan'] = ($request->dikerjakan) ? $request->status_dikerjakan : "";
		$data['status_menunggu'] = ($request->menunggu) ? $request->status_menunggu : "on";
		$data['sudah_ditelaah'] = ($request->sudah_ditelaah) ? $request->sudah_ditelaah : "on";
		$data['belum_ditelaah'] = ($request->belum_ditelaah) ? $request->belum_ditelaah : "on";
		$data['asal_pelayanan_igd'] = ($request->asal_pelayanan_igd) ? $request->asal_pelayanan_igd : "on";
		$data['asal_pelayanan_rawat_inap'] = ($request->asal_pelayanan_rawat_inap) ? $request->asal_pelayanan_rawat_inap : "on";
		$data['asal_pelayanan_rawat_jalan'] = ($request->asal_pelayanan_rawat_jalan) ? $request->asal_pelayanan_rawat_jalan : "on";
		$data['asal_pelayanan_lainnya'] = ($request->asal_pelayanan_lainnya) ? $request->asal_pelayanan_lainnya : "on";

		return view('farmasi.transaksi.index', $data);
	}

	public function analisaResep($farmasi, $slug){
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$transaksi = $transaksi->load('kasus.sep', 'final_detail.resep_detail.obat_detail.item_template.kategori_item');

		$duplikasi_terapi = false; # bernilai true apabila dalam 1 resep ada obat yang memiliki kelas terapi yang sama
		$check_duplikasi_terapi = [];
		if (!empty($transaksi->final_detail->resep_detail)) {
			foreach ($transaksi->final_detail->resep_detail as $detail) {
				if (!empty($detail->obat_detail->item_template->kelas_terapi_id)) {
					$check_duplikasi_terapi[] = $detail->obat_detail->item_template->kelas_terapi_id;
				}
			}
	  	}

		if (count($check_duplikasi_terapi) !== count(array_unique($check_duplikasi_terapi))) {
			$duplikasi_terapi = true;
		}
		$data['has_not_alergi_obat'] = !empty($transaksi->kasus->identitas->riwayat_sakit) ? false : true;

		$data['transaksi'] = $transaksi;
		$data['duplikasi_terapi'] = $duplikasi_terapi;
		$day = Carbon::now();
		$data['dadas'] = $slug;
		$data['sidebar_active'] = "transaksi";
		return view('farmasi.transaksi.analisa-resep', $data);
	}

	public function loadDataIndex(Request $request)
	{
		$slug = $request->slug;
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->bydate($request);

		$lokasi_departemen_igd_id = LokasiDepartemen::where('slug', 'igd')->first()->value('id');
		$lokasi_igd_ids = Lokasi::where('lokasi_departemen_id', $lokasi_departemen_igd_id)->get()->pluck('id')->toArray();
		$lokasi_igd_ids_text = implode(",", $lokasi_igd_ids);

		$transaksi = $transaksi->orderByRaw('CASE WHEN cito = 1 THEN 3 WHEN lokasi_id IN ('. $lokasi_igd_ids_text .') THEN 2 WHEN eksekutif = 1 THEN 1 END DESC')
		->orderBy('created_at', 'ASC');

		try {
            return DataTables::of($transaksi)
            ->addColumn('rownum', function($transaksi) use (&$rowNum) {
                return ++$rowNum;
            })
            ->addColumn('pasien', function($transaksi){
				$content = $transaksi->pasien_detail->name ?? $transaksi->nama_pasien;
				$norm = $transaksi->pasien_detail->no_rm ?? '-';
				$notrans = $transaksi->pembayaran_detail->no_asuransi ?? '-';
				$content .= '<br>No RM :'.$norm;
				$content .=	'<br>No Asuransi :'.$notrans;
                return $content;
            })
            ->editColumn('no_resep', function($transaksi){
                $content = $transaksi->final_detail->nomor_resep ?? '-';
                if($transaksi->cito == 1){
                    $content.='<br><span class="p-2 badge badge-danger" style="display: inline-block">Cito</span>';
                }
		if($transaksi->eksekutif == 1){
			$content.='<br><span class="p-2 badge badge-warning" style="display: inline-block">Eksekutif</span>';
		}
                if($transaksi->is_video == 1){
                    $content.='<br><span class="p-2 badge badge-warning" style="display: inline-block">Telekonsultasi</span>';
                }
                return $content;
            })
            ->editColumn('tanggal', function($transaksi){
	            return $transaksi->created_at->format('d F Y H:i');
            })
            ->editColumn('status', function($transaksi){

				if ($transaksi->status_ditelaah == 0) {
					$extend = '<br><span class="p-2 badge badge-danger" style="margin-top: 5px;">Belum ditelaah</span>';
				} else {
					$extend = '<br><span class="p-2 badge badge-success" style="margin-top: 5px;">Sudah ditelaah</span>';
				}

                if($transaksi->status == 0 && !empty($transaksi->dikerjakan_at)) {
					$content = '<span class="p-2 badge badge-warning">Dikerjakan</span>'.$extend;
				}
				else if($transaksi->status == 0) {
					$content = '<span class="p-2 badge badge-primary">Menunggu</span>'.$extend;
				}
				else if($transaksi->status == 1) {
					$content = '<span class="p-2 badge badge-success">Selesai</span>'.$extend;
				}
				else {
					$content = '<span class="p-2 badge badge-info">Rencana</span>'.$extend;
				}
				return $content;
			})
			->editColumn('lokasi_text', function($transaksi){
			    if(!empty($transaksi->lokasi_text)){
			        $content = $transaksi->lokasi_text;
                }else{
                    $content = $transaksi->lokasi->nama ?? '(Pasien Bebas)';
                }
				if ($transaksi->jenis_resep == 'pulang') $content .= '<span class="badge badge-info">Resep Pulang</span>';
				return $content;
            })
            ->addColumn('action', function($transaksi) use ($slug){
				$param_print = '\''.$transaksi->slug.'\','.$transaksi->id.','.($transaksi->ori_detail->nomor_resep ?? '').",'".($transaksi->dokter_nama ?? '')."',".($transaksi->dokter_id ?? '').','.($transaksi->dokter ? '\'exist\'' : '');
                $content = '<button type="button" class="btn btn-alt-primary btn-square dropdown-toggle" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Menu
							</button>
							<div class="dropdown-menu" aria-labelledby="page-header-options-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a href="'.url('farmasi/'.$slug.'/transaksi/'.$transaksi->slug).'" class="btn dropdown-item btn-alt-primary">
								<i class="fa fa-search-plus"></i> Detail
							</a>
							<button class="btn dropdown-item btn-analisa btn-alt-success" data-slug="'.$transaksi->slug.'">
							<i class="fa fa-file-text" aria-hidden="true"></i> Analisa Resep';
				if(!empty($transaksi->final_detail->analisa_resep)) $content .= '<i class="fa fa-check" aria-hidden="true"></i>';
				
				$content .= '</button>
							<button class="btn btn-print-resep dropdown-item btn-alt-warning" onclick="printResepModal(\'resep\','.$param_print.')">
								<i class="fa fa-print" aria-hidden="true"></i> Cetak
							</button>
							<button class="btn btn-print-resep dropdown-item btn-alt-warning" onclick="printResepModal(\'resep-ori\','.$param_print.')">
								<i class="fa fa-print" aria-hidden="true"></i> Cetak Original
							</button>
							</div>
							<button class="btn btn-call-antrian btn-alt-danger" data-slug="'.$transaksi->slug.'" title="Panggil Antrian">
								<i class="fa fa-bullhorn" aria-hidden="true"></i> 
							</button>';
				// $content .= '<button type="button" class="btn btn-alt-warning btn-square btn-penunjang d-none" data-slug="'.$transaksi->slug.'" data-farmasi="'.session("farmasi").'">
				// 			<i class="fa fa-flask" aria-hidden="true"></i>&nbsp;&nbsp;Daftar Penunjang
				// 			</button>';
				return $content;
            })
            ->filterColumn('pasien', function ($query, $keyword) {
                $query->whereHas('pasien_detail', function ($subquery) use ($keyword) {
                    $subquery->from(config('app.db_name') . '_patients.pasien')->where('name', 'LIKE', "%$keyword%")
                            ->orWhere('no_rm', 'LIKE', "%$keyword%");
                })->orwherehas('pembayaran_detail', function ($subquery) use ($keyword){
                        $subquery->from(config('app.db_name') . '_patients.pasien_pembayaran')->where('no_asuransi', 'LIKE', "%$keyword%");
                    });
            })
            ->filterColumn('lokasi_text', function ($query, $keyword) {
                $query->where('lokasi_text','LIKE',"%$keyword%")->orwherehas('lokasi', function ($query) use ($keyword){
                    $query->from(config('app.db_name') . '.lokasi')->where('nama', 'LIKE', "%$keyword%");
                });
            })
            ->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
	}

	public function loadData(Request $request, $farmasi)
	{
		$limit = intval($request->length);
		$start = intval($request->start);
		$draw = intval($request->draw);
		$searchKey = $request->search['value'];
		$no = $start;
		$first = null;
		$data = array();
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getAll($farm->id);
		$totalData = intval(count($transaksi));

		if(empty($searchKey)){
			$tanggal_awal = $request->tanggal_awal;
			$tanggal_akhir = $request->tanggal_akhir;
			/*$harga_minimal = $request->harga_minimal;
			$harga_maksimal = $request->harga_maksimal;*/
			$no_resep = $request->no_resep;
			$no_rm = $request->no_rm;
			$status = $request->status;
			$pasien = $request->pasien;
			$status_ditelaah = $request->status_ditelaah;

			if ($tanggal_awal==null && $tanggal_akhir==null && $status==2 && $no_resep==null && $no_rm==null && $pasien==null) {      		
				$getTransaksiPerPage = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')
				->getPerPage($farm->id, $limit, $start);
				$totalFiltered = $totalData;
			} else {
				$getTransaksiPerPage = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')
				->filteredData($limit, $start, $tanggal_awal, $tanggal_akhir, $no_resep, $no_rm, $status, $pasien, $farm->id, $status_ditelaah);
				$totalFiltered = $getTransaksiPerPage->count;
			}
		}

		foreach($getTransaksiPerPage as $row) {
			$no++;
			if($row->status == 0){
				$status = '<span class="p-2 badge badge-primary">Menunggu</span>';
			}
			else if($row->status == 1){
				$status = '<span class="p-2 badge badge-success">Selesai</span>';
			}
			else if($transaksi->status == 2) {
				$content = '<span class="p-2 badge badge-info">Sudah ditelaah</span>';
			}
			else if($row->status == -1){
				$status = '<span class="p-2 badge badge-info">Rencana</span>';
			}
            //dd($row);

			if($row->status_retur ) {
				if($row->deskripsi) {
					if($row->status_retur == 1) $deskripsi = '(Retur) '.$row->deskripsi;
					else $deskripsi = '(Dibatalkan) '.$row->deskripsi;
				}
				else {
					if($row->status_retur == 1) $deskripsi = 'Retur';
					else $deskripsi = 'Dibatalkan';
				}
			}
			else {
				if($row->deskripsi) $deskripsi = $row->deskripsi;
				else $deskripsi = '-';
			}

			$printCheck = "";
			$printLabelCheck = "";
			$analisaCheck = "";
			if(!empty($row->printed))
				$printCheck='&nbsp;&nbsp;<i class="fa fa-check" aria-hidden="true"></i>';
			if(!empty($row->printed_label))
				$printLabelCheck='&nbsp;&nbsp;<i class="fa fa-check" aria-hidden="true"></i>';
			if(!empty($row->final_detail->analisa_resep))
				$analisaCheck='&nbsp;&nbsp;<i class="fa fa-check" aria-hidden="true"></i>';

			$data[] = [
				$no.'<input type="hidden" value="'.$row->slug.'">',
				$row->pasien_detail ? $row->pasien_detail->name.'<br>#'.$row->pasien_detail->no_rm : $row->nama_pasien,
				$row->final_detail->nomor_resep ? $row->final_detail->nomor_resep : "-",
				date('d F Y, H:i', strtotime($row->paid_at ? $row->paid_at : $row->created_at)),
				$status,
				$row->lokasi->nama ??  '(Pasien Bebas)',
				'<button type="button" class="btn btn-alt-primary btn-square dropdown-toggle" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Menu
				</button>
				<div class="dropdown-menu" aria-labelledby="page-header-options-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 34px, 0px); top: 0px; left: 0px; will-change: transform;">
				<a href="'.url('farmasi/'.$farmasi.'/transaksi/'.$row->slug).'" class="btn dropdown-item btn-alt-primary"><i class="fa fa-search-plus"></i> Detail</a>
				<button class="btn dropdown-item btn-analisa btn-alt-success" data-slug="'.$row->slug.'"><i class="fa fa-file-o" aria-hidden="true"></i> Analisa Resep'.$analisaCheck.'</button>
				<a href="'.url('farmasi/'.$farmasi.'/resep/print/'.$row->slug).'" class="btn btn-print-resep dropdown-item btn-alt-warning" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Cetak '.$printCheck.'</a>
				<button type="button" class="btn btn-alt-warning btn-square btn-penunjang" data-slug="'.$row->slug.'" data-farmasi="'.$farmasi.'">
				<i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;&nbsp;Daftar Penunjang
				</button>                        
				</div>',
			];
		}

		$json_data = array(
			"draw"            => $draw,
			"recordsTotal"    => $totalData,  
			"recordsFiltered" => $totalFiltered, 
			"data"            => $data
		);

		return json_encode($json_data);

	}

	public function loadPenunjang($farmasi,$slug)
	{
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		// dd($transaksi);
		$data['lokasi'] = Lokasi::all();
		$data['penunjang'] = app('App\Http\Controllers\Kasus\PenunjangPermintaan\ReadController')->get($transaksi->kasus_id);
		// dd($penunjang);
		return view('farmasi.transaksi.modals.modal-penunjang-home',$data);
	}

	public function single(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');
		$add_eager = [
			'final_detail.resep_detail.tipe_racikan',
			'final_detail.resep_detail.detail_copy',
			'final_detail.resep_detail.detail_copy.resep_detail',
			'final_detail.resep_detail.detail_copy.resep_detail.transaksi',
		];
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug, $add_eager);
	    $this->checkToAbort($transaksi);
		$tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();
		$penunjang = app('App\Http\Controllers\Kasus\PenunjangPermintaan\ReadController')->get($transaksi->kasus_id);
		$allFarm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
		//GET ACTIVE SHIFT
		$now = Carbon::now();
		$active_shift = 0;
		foreach ($farm->aturan_shift as $key => $value) {
			if(!$value->waktu_min || !$value->waktu_max)
				continue;
			$mulai = Carbon::createFromFormat('H:i:s', $value->waktu_min);
			$selesai = Carbon::createFromFormat('H:i:s', $value->waktu_max);
			if ($now > $mulai && $now < $selesai)
			{
				$active_shift = $value->id;
				break;
			}
		}

		$data['penunjang'] = $penunjang;
		$data['aturan'] = $aturan;
		$data['tipe'] = $tipe;
		$data['farmasi'] = $farm;
		$satuan_penggunaan = TipeObat::all();
		$data['satuan_penggunaan'] = $satuan_penggunaan;
		$data['transaksi'] = $transaksi;
		$data['fyi'] = $transaksi->fyi;
		$data['allFarm'] = $allFarm;
		$data['sidebar_active'] = "";
		$data['active_shift'] = $active_shift;
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$data['lokasi'] = Lokasi::all();
		$data['kasus'] = Kasus::find($transaksi->kasus_id);
		$data['metode_pembayaran'] = empty($transaksi->pembayaran_detail->perusahaan->nama) ? 'Tunai' : $transaksi->pembayaran_detail->perusahaan->nama;
		$data['loket'] = LoketAntrian::all();
		
		if($transaksi->status) return view('farmasi.transaksi.detail', $data);
		if($transaksi->pembayaran_detail && $transaksi->pembayaran_detail->perusahaan->tipe->slug == 'bpjs'  && $farm->perharian) {
			# bypass always ke transaksi detail karena edit 7 23 hari udah di detail
			return view('farmasi.transaksi.detail', $data);
			$flag = 0;
			foreach ($transaksi->final_detail->resep_detail as $detail)	if($detail->jumlah != $detail->hari7 + $detail->hari23 + $detail->dukunganrs) $flag++;
			if(!$flag) return view('farmasi.transaksi.detail', $data);
			else return view('farmasi.transaksi.edit-resep.edit', $data);
		}
		else return view('farmasi.transaksi.detail', $data);
	}

	public function singleKemoterapi(Request $request, $farmasi)
	{
		$farm = session('farmasi');
		
		$data['farmasi'] = $farm;
		$data['sidebar_active'] = "";
		$data['lokasi'] = Lokasi::all();

		return view('farmasi.transaksi.detail-kemoterapi', $data);
	}

	public function edit(Request $request, $farmasi, $tipe_request, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
	    $this->checkToAbort($transaksi);
	    // $prescribed_meds = app('App\Http\Controllers\Farmasi\Resep\ReadController')->getPrescribedMeds($transaksi->pasien_id, $transaksi->id);
		$tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();
		$satuan_penggunaan = SatuanPenggunaan::all();

		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$data['satuan_penggunaan'] = $satuan_penggunaan;
		$data['aturan'] = $aturan;
		$data['tipe'] = $tipe;
		$data['transaksi'] = $transaksi;
		// $data['prescribed_meds'] = $prescribed_meds;
		$data['sidebar_active'] = "";
		$data['lokasi'] = Lokasi::all();
		
		if($tipe_request == 'copy')
			return view('farmasi.transaksi.copy-resep.copy', $data);

		elseif(!($transaksi->final_detail->is_kemo ?? false))
			return view('farmasi.transaksi.edit-resep.edit', $data);

		else
			return view('farmasi.transaksi.edit-kemoterapi', $data);
	}

	public function editKemoterapi(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();
		$satuan_penggunaan = TipeObat::all();
		$data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
		$data['satuan_penggunaan'] = $satuan_penggunaan;
		$data['aturan'] = $aturan;
		$data['tipe'] = $tipe;
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['sidebar_active'] = "";
		$data['lokasi'] = Lokasi::all();
		return view('farmasi.transaksi.edit-kemoterapi', $data);
	}

	public function copy(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();

		$data['aturan'] = $aturan;
		$data['tipe'] = $tipe;
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['sidebar_active'] = "";
		$data['lokasi'] = Lokasi::all();
		return view('farmasi.transaksi.copy', $data);	
	}

	public function printNota(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');

		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		$dokter_jenis = $request['dokter-jenis'];
		$dokter_rsal = $request['dokter-rsal'];
		$dokter_luar = $request['dokter-luar'];
		if($dokter_jenis == 'rsal'){
			$transaksi->dokter_id = $dokter_rsal;
			$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
			$transaksi->dokter_nama = $dokter->name;
		}
		else{
			$transaksi->dokter_id = 0;
			$transaksi->dokter_nama = $dokter_luar;
		}

		$total_biaya=$transaksi->embalase ?? 0;
        foreach($transaksi->final_detail->resep_detail as $detail){
            $jumlah = ($transaksi->status_retur) ? ($detail->jumlah - $detail->logLast->jumlah_retur) : $detail->jumlah;
            $total_biaya += $jumlah*$detail->harga;
        }
		$terbilang = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($total_biaya);
        $data['total_biaya'] = $total_biaya;
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['terbilang'] = $terbilang;
		$data['pj'] = $request->input('pj');
		$data['dokter'] = $transaksi->dokter_nama;
		$customPaper = array(0,0,595,421);
		$pdf = DOMPDF::loadView('farmasi.transaksi.print-nota',$data)->setPaper($customPaper);
		return $pdf->stream('nota.pdf');
	}

	public function printNotaRetur(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');

		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		$dokter_jenis = $request['dokter-jenis'];
		$dokter_rsal = $request['dokter-rsal'];
		$dokter_luar = $request['dokter-luar'];
		$resep=Resep::find($request['resep_id']);
		if($dokter_jenis == 'rsal'){
			$transaksi->dokter_id = $dokter_rsal;
			$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
			$transaksi->dokter_nama = $dokter->name;
		}
		else{
			$transaksi->dokter_id = 0;
			$transaksi->dokter_nama = $dokter_luar;
		}
		$total_retur = 0;
		foreach ($resep->resep_detail as $resep_detail){
		    foreach ($resep_detail->log as $log){
		        $total_retur += $log->subtotal_retur;
            }
        }

		$terbilang = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($total_retur);
		
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['terbilang'] = $terbilang;
		$data['pj'] = $request->input('pj');
		$data['dokter'] = $transaksi->dokter_nama;
		$data['resep'] = $resep;
		$data['total_retur'] = $total_retur;
		$customPaper = array(0,0,595,421);
		$pdf = DOMPDF::loadView('farmasi.transaksi.print-nota-retur',$data)->setPaper($customPaper);
		return $pdf->stream('nota.pdf');
	}

	public function printKwitansi(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');

		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		$dokter_jenis = $request['dokter-jenis'];
		$dokter_rsal = $request['dokter-rsal'];
		$dokter_luar = $request['dokter-luar'];
		if($dokter_jenis == 'rsal'){
			$transaksi->dokter_id = $dokter_rsal;
			$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
			$transaksi->dokter_nama = $dokter->name;;
		}
		else{
			$transaksi->dokter_id = 0;
			$transaksi->dokter_nama = $dokter_luar;
		}


		$terbilang = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($transaksi->total_biaya_obat);
		$data['terbilang'] = $terbilang;
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['pj'] = $request->input('pj');
		$data['dokter'] = $transaksi->dokter_nama;

		$customPaper = array(0,0,595,210);
		$pdf = DOMPDF::loadView('farmasi.transaksi.print-kwitansi',$data)->setPaper($customPaper);
		return $pdf->stream('kwitansi.pdf');
	}

	public function printResepOri(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		app('App\Http\Controllers\Farmasi\Transaksi\EditController')->printed($transaksi);

		if(!empty($request->dokter_jenis)){
			$dokter_jenis = $request->dokter_jenis;
			$dokter_rsal = $request->dokter_rsal;
			$dokter_luar = $request->dokter_luar;
			if($dokter_jenis == 'rsal'){
				// dd($slug);
				$transaksi->dokter_id = $dokter_rsal;
				$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
				$transaksi->dokter_nama = $dokter->name;
				$dokter_ttd = $dokter->ttd;
			}
			else{
				$transaksi->dokter_id = 0;
				$transaksi->dokter_nama = $dokter_luar;
				$dokter_ttd = null;
			}

		}
		else
		{
			$dokter_ttd = null;
		}


		//dd($transaksi->sep_detail);
		$data['transaksi'] = $transaksi;
		$detail = array();
		$i=1;
		$data['jumlah_generik'] = 0;
		$data['jumlah_racikan'] = 0;
		foreach ($transaksi->ori_detail->resep_detail as $row) {
			$detail[$i]['nama_obat'] = $row->nama_obat;
			$detail[$i]['satuan'] = $row->satuan_penggunaan ? $row->satuan_penggunaan : $row->satuan;
			$detail[$i]['roman'] = $row->roman;
			$detail[$i]['aturan'] = $row->aturan;
			$detail[$i]['tipe'] = $row->tipe;
			if(count($row->racikan)!=0 || $row->tipe)
			{
				$data['jumlah_racikan']++;
			}
			else
			{
				$data['jumlah_generik']++;
			}
			$detail[$i]['racikan'] = $row->racikan;
			$i++;
		}
		$data['total_page_generik'] = ceil($data['jumlah_generik']/4.0);
		$data['total_page_racikan'] = $data['jumlah_racikan'];
		$data['total_page'] = $data['total_page_generik'] + $data['total_page_racikan'];
		$data['detail'] = $detail;
		$data['farmasi'] = $farm;
		$data['dokter'] = $transaksi->dokter_nama;
		$data['dokter_ttd'] = $dokter_ttd;
		$data['nomor_resep'] = $request->input('nomor_resep');
		\Blade::setEchoFormat('nl2br(e(%s))');
		$customPaper = array(0,0,403,585);
		$pdf = DOMPDF::loadView('farmasi.transaksi.print-resep-ori',$data)->setPaper($customPaper);
		return $pdf->stream('nota.pdf');
	}

	public function printResep(Request $request, $farmasi, $slug, $param_download = [])
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		app('App\Http\Controllers\Farmasi\Transaksi\EditController')->printed($transaksi);

        $sip_dokter = null;
		if(!is_null($request['dokter-jenis'])){
			$dokter_jenis = $request['dokter-jenis'];
			$dokter_rsal = $request['dokter-rsal'];
			$dokter_luar = $request['dokter-luar'];
			if($dokter_jenis == 'rsal'){
				$transaksi->dokter_id = $dokter_rsal;
				$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
				$transaksi->dokter_nama = $dokter->name;
                $sip_dokter = $dokter->sip;
				$dokter_ttd = $dokter->ttd;
			}
			else{
				$transaksi->dokter_id = 0;
				$transaksi->dokter_nama = $dokter_luar;
				$dokter_ttd = null;
			}

		}
		else
		{
			$dokter_ttd = null;
		}

		$data['transaksi'] = $transaksi;
		$detail = array();
		$data['jumlah_generik'] = 0;
		$data['jumlah_racikan'] = 0;
		$baris = 0;
		$page = 1;
		$max_row_per_page = 24;
		$max_character_per_row = 34;
		$count_obat = 0;
		foreach ($transaksi->final_detail->resep_detail as $index => $row) {
			$current_increment_baris = 0;
			if($row->tipe == 0)
			{
				$current_obat_baris = ceil(strlen($row->nama_obat)/$max_character_per_row);
				$current_increment_baris += $current_obat_baris;
			}
			else
			{
				$racikan_per_baris = explode("\n", $row->nama_obat);
				foreach($racikan_per_baris as $racikan)
				{
					$current_obat_baris = ceil(strlen($racikan)/$max_character_per_row);
					$current_increment_baris += $current_obat_baris;
				}
				$current_increment_baris++;//penambahan baris karena aturan tidak sebaris
			}

			foreach($row->racikan as $racikan)
			{
				$current_obat_baris = ceil(strlen($racikan->nama_obat)/$max_character_per_row);
				$current_increment_baris += $current_obat_baris;
			}


			if($baris + $current_increment_baris > $page*$max_row_per_page)
			{
				$baris = $page*$max_row_per_page;
				$page++;
				$count_obat = 0;
			}

			$aturan_per_baris = explode("\n", $row->aturan);
			foreach($aturan_per_baris as $aturan)
			{
				$current_aturan = ceil(strlen($aturan)/$max_character_per_row);
				$current_increment_baris += $current_aturan;
			}
			$current_increment_baris++;//garis
			$baris += $current_increment_baris;


			$detail[$page][$count_obat]['nama_obat'] = $row->nama_obat;
			$detail[$page][$count_obat]['satuan'] = $row->satuan_penggunaan ? $row->satuan_penggunaan : $row->satuan;
			$detail[$page][$count_obat]['roman'] = $row->roman;
			$detail[$page][$count_obat]['aturan'] = explode("\n", $row->aturan);
			$detail[$page][$count_obat]['tipe'] = $row->tipe;
			$detail[$page][$count_obat]['racikan'] = $row->racikan;
			$detail[$page][$count_obat]['jumlah'] = $row->jumlah;

			# kategori obat
			$item_template_id = $row->obat_detail->item_template_id ?? '';
			if (!empty($item_template_id)) {
				$item_kategori = ItemsKategori::with('detail_kategori')->where('item_template_id', $item_template_id)->first();
				$detail[$page][$count_obat]['kategori_slug'] = $item_kategori->detail_kategori->slug ?? '';
			}

			$count_obat++;
		}
		
		$data['detail'] = $detail;
		$data['farmasi'] = $farm ?? $farmasi;
		$data['dokter'] = $transaksi->dokter_nama;
		$data['sip_dokter'] = $sip_dokter;
		$data['dokter_ttd'] = $dokter_ttd;
		$data['nomor_resep'] = $request->input('nomor_resep');
		\Blade::setEchoFormat('nl2br(e(%s))');
		$customPaper = array(0,0,403,585);
			(isset($transaksi->final_detail->is_kemo) && $transaksi->final_detail->is_kemo);
		if(isset($transaksi->final_detail->is_kemo) && $transaksi->final_detail->is_kemo){
			$pdf = DOMPDF::loadView('farmasi.laporan.laporan-obat-kanker', $data)->setPaper('a4', 'landscape');
			if (($param_download['is_download'] ?? null) != null) {
				$filename = $param_download['filename'] ?? 'Print_Resep_'.$transaksi->id.'.pdf';
				if (file_exists($param_download['path'] . $filename)) 
					unlink($param_download['path'] . $filename);
				$pdf->save($param_download['path'] . $filename);
				return $filename;
			}
	   		return $pdf->stream('print-kemo.pdf');
   		}else{
			$pdf = DOMPDF::loadView('farmasi.transaksi.print-resep.index',$data)->setPaper($customPaper);
			if (($param_download['is_download'] ?? null) != null) {
				$filename = $param_download['filename'] ?? 'Print_Resep_'.$transaksi->id.'.pdf';
				if (file_exists($param_download['path'] . $filename)) 
					unlink($param_download['path'] . $filename);
				$pdf->save($param_download['path'] . $filename);
				return $filename;
			}
			return $pdf->stream('nota.pdf');
		}
	}

	public function printResepFormatDokter(Request $request, $farmasi, $slug, $param_download = [])
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingleOnly($slug);
		$dokter_jenis = $request['dokter-jenis'];
		$dokter_rsal = $request['dokter-rsal'];
		$dokter_luar = $request['dokter-luar'];
		if($dokter_jenis == 'rsal'){
			$transaksi->dokter_id = $dokter_rsal;
			$dokter = app('App\Http\Controllers\Users\ReadController')->getSingle($dokter_rsal);
			$transaksi->dokter_nama = $dokter->name;;
		}
		else{
			$transaksi->dokter_id = 0;
			$transaksi->dokter_nama = $dokter_luar;
		}

		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['dokter'] = $transaksi->dokter_nama;
		$data['nomor_resep'] = $request->input('nomor_resep');
		$customPaper = array(0,0,453,604);
		$pdf = DOMPDF::loadView('farmasi.transaksi.print-resep-format-dokter',$data)->setPaper($customPaper);
		return $pdf->stream('nota.pdf');
	}

	/* Transaksi Racikan */
	public function createRacikan(Request $request, $farmasi)
	{
		//dd($request);
		$farm = session('farmasi');
		$data['farmasi'] = $farm;
		$data['sidebar_active'] = "transaksi";
		$data['lokasi'] = Lokasi::all();

		return view('farmasi.transaksi.racikan-obat', $data);
	}

	public function labelObat(Request $request, $farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		app('App\Http\Controllers\Farmasi\Transaksi\EditController')->labelPrinted($transaksi);
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$data['dokter'] = $request->input('dokter');
		$data['nomor_resep'] = $request->input('nomor_resep');

		if(isset($transaksi->final_detail->is_kemo) && $transaksi->final_detail->is_kemo){
			$pdf = DOMPDF::loadView('farmasi.transaksi.print-label-obat-kanker', $data)->setPaper([0, 0, 150, 212.4], 'landscape');
			return $pdf->stream('nota.pdf');
		}else{
			$pdf = DOMPDF::loadView('farmasi.transaksi.print-label-obat',$data)->setPaper([0, 0, 150, 212.4], 'landscape');
			return $pdf->stream('nota.pdf');
		}
	}

	public function cetakanalisa($farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		//dd($data);
		$customPaper = array(0,0,453,604);
		$pdf = DOMPDF::loadView('farmasi.transaksi.cetak-analisa',$data)->setPaper($customPaper);
		// $pdf = DOMPDF::loadView('farmasi.transaksi.cetak-analisa',$data)->setPaper('a7');
		return $pdf->stream('cetak-analisa.pdf');
	}

	public function formulirPermintaanDispensingAseptik($farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$pdf = DOMPDF::loadView('farmasi.transaksi.printout.formulir-permintaan-dispensing-aseptik',$data);
		return $pdf->stream('cetak-analisa.pdf');
	}

	public function formulirPermintaanTpn($farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		$pdf = DOMPDF::loadView('farmasi.transaksi.printout.formulir-permintaan-tpn',$data);
		return $pdf->stream('cetak-analisa.pdf');
	}

	public function cetakcopy($farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getSingle($slug);
		//dd($transaksi->sep_detail);
		$data['transaksi'] = $transaksi;
		$data['farmasi'] = $farm;
		/*$data['dokter'] = $request->input('dokter');
		$data['nomor_resep'] = $request->input('nomor_resep');*/
        $customPaper = array(0,0,432,792);
		$pdf = DOMPDF::loadView('farmasi.transaksi.cetak-copy',$data)->setPaper($customPaper);
		return $pdf->stream('cetak-copy-resep.pdf');
	}

}
