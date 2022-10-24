<?php

namespace App\Http\Controllers\BPJS\RencanaKontrol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ThirdParty\RencanaKontrol;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ReadController extends Controller
{
    public function getListDataRencanaKontrol(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->date_start)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->date_end)->endOfDay();

		if($request->source == "rs"){
			$query = RencanaKontrol::with('pasien');

			if($request->format == 1){ #tanggal entry
				$query->whereBetween('created_at',[$start, $end]);
			}else if($request->format == 2){  #tanggal rencana kontrol
				$query->whereBetween('tgl_rk',[$start, $end]);
			}
			
			$query->where('jenis_kontrol',$request->jenis);
			
		}else if($request->source == "bpjs"){
			$json_response = app(\App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController::class)->getDataNoSK(request()->merge([
				'tgl_awal' => $start->format('d-m-Y'),
				'tgl_akhir' => $end->format('d-m-Y'),
				'format_filter' => $request->format,
			]));

			$response = json_decode($json_response);

			$query = collect();
			if($response->metaData->code == 200){
				$data = $response->response->list;

				foreach($data as $key => $item){
					if ($item->jnsKontrol == $request->jenis) {
						$query->push((object)[
							'id' => $key+1,
							'no_sk' => $item->noSuratKontrol,
							'no_sep' => $item->noSepAsalKontrol ?? '',
							'tgl_rk' => $item->tglRencanaKontrol,
							'pasien' => (object)[
								'name' => $item->nama,
							],
							'no_kartu' => $item->noKartu,
							'created_at' => $item->tglTerbitKontrol,
							'nama_poli' => $item->namaPoliTujuan,
						]);
					}
				}
			}else{
				return response()->json([
					'data' => [],
					'message' => $response->metaData->message,
				]);
			}
		}


		return DataTables::of($query)
				->addColumn('pasien', function($row) {
					$pasien_name = $row->pasien->name ?? null;
					if($pasien_name == null) $pasien_name = $row->nama_pasien ?? 'Nama Pasien Kosong';
					return $pasien_name;
				})
				->addColumn('tgl_rk', function($row) {
					return date('d F Y', strtotime($row->tgl_rk));
				})
				->editColumn('created_at', function($row){
					return date('d F Y', strtotime($row->created_at));
				})
				->editColumn('detail', function($row) {
					return '<button class="btn btn-info btn-sm" onclick="detail(`'.$row->no_sk.'`);"><i class="fa fa-eye"></i></button>';
				})
				->addIndexColumn()->escapeColumns([])
				->make(true);
	}

	public function detail(Request $request)
	{
		$rk_bpjs = app('App\Http\Controllers\BPJS\API\RencanaKontrol\ReadController')->rencanaKontrolByNoSk($request->no_sk);

		return $rk_bpjs;
	}

    public function paramsInsertRencanaKontrol($dataArr)
	{
		$data = (object) $dataArr;
		$tgl = $this->tanggal($data->tgl_rk);
		if($data->jenis_kontrol == 2){
			$params = [
				"request" => [
					"noSEP" => $data->no_sep,
					"kodeDokter" => $data->kode_dokter,
					"poliKontrol" => $data->kode_poli,
					"tglRencanaKontrol" => $tgl,
					"user" => $data->user
				]
			];
		}else{
			$params = [
				"request" => [
					"noKartu" => $data->no_sep,
					"kodeDokter" => $data->kode_dokter,
					"poliKontrol" => $data->kode_poli,
					"tglRencanaKontrol" => $tgl,
					"user" => $data->user
				]
			];
		}

		return $params;
	}

	public function paramsUpdateRencanaKontrol($dataArr)
	{
		$data = (object) $dataArr;
		$tgl = $this->tanggal($data->tgl_rk);
		if($data->jenis_kontrol == '2'){
			$params = [
				'request' => [
					'noSuratKontrol' => $data->no_sk,
					'noSep' => $data->no_sep,
					'kodeDokter' => $data->kode_dokter,
					'poliKontrol' => $data->kode_poli,
					'tglRencanaKontrol' => $tgl,
					'user' => $data->user
				]
			];
		}else{
			$params = [
				'request' => [
					'noSPRI' => $data->no_sk,
					'kodeDokter' => $data->kode_dokter,
					'poliKontrol' => $data->kode_poli,
					'tglRencanaKontrol' => $tgl,
					'user' => $data->user
				]
			];
		}

		return $params;
	}

    public function paramsHapusRencanaKontrol($dataArr)
    {
		$data = (object) $dataArr;
        $params = [
            'request' => [
                't_suratkontrol' => [
                    'noSuratKontrol' => $data->no_sk,
                    'user' => $data->user
                ]
            ]
        ];

        return $params;
    }

	private function tanggal($tgl)
	{
		if($tgl != ""){
			$tgl = explode("-", $tgl);
			$tgl = implode("-", array_reverse($tgl));
		} else {
			$tgl = \Carbon\Carbon::now()->toDateString();
		}

		return $tgl;
	}

	public function getNoSk($no_sk, $eager = []){

		$rencana_kontrol = RencanaKontrol::with($eager)
							->where('no_sk', $no_sk);

		return $rencana_kontrol->first();
	}
}
