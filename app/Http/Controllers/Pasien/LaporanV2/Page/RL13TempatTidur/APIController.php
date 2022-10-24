<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL13TempatTidur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSTempatTidurJenis;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;
use App\Models\RawatInap\Ruangan;
use App\Models\RawatInap\TempatTidur;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSTempatTidurJenis::count('id');
		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
		$data_fetched = $request->datafetched;
		$limit = $request->limit;

		$all_jenis = MasterSIRSTempatTidurJenis::skip($data_fetched)->take($limit)->orderBy('id')->get();
		$all_kelas = MasterSIRSTempatTidurKelas::pluck('id');
		$ruangan = TempatTidur::select('ruangan.sirs_tempat_tidur_jenis_id','ruangan.sirs_tempat_tidur_kelas_id')
					->leftJoin('ruangan','ruangan.id','=','tempat_tidur.ruangan_id')
					->get();

		$array_data = [];
		foreach($all_jenis as $index => $jenis)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->jenis_pelayanan = $jenis->nama;
			foreach($all_kelas as $index2 => $kelas_id)
			{
				$kelas_string = "kelas_".$kelas_id;
				$new_item->$kelas_string = $ruangan->where('sirs_tempat_tidur_jenis_id','=',$jenis->id)->where('sirs_tempat_tidur_kelas_id','=',$kelas_id)->count();
			}
			
			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
