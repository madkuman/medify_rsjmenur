<?php

namespace App\Http\Controllers\Hospital\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Laporan;

class CreateController extends Controller
{
	public function create($data)
	{
		$this->deletePreviousLaporan($data);

		$laporan = new Laporan;
		$laporan->slug = $data['slug'];
		$laporan->start_date = $data['start_date'];
		$laporan->end_date = $data['end_date'];
		$laporan->file_name = $data['file_name'];
		$laporan->file_path = $data['file_path'];
		$laporan->param = $data['param'] ?? null;
		$laporan->save();
	}

	public function deletePreviousLaporan($data)
	{
		$laporan = Laporan::where('slug',$data['slug'])->where('file_name',$data['file_name'])->first();
		if(!empty($laporan)) $laporan->delete();
	}

}
