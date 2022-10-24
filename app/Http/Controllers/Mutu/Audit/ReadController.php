<?php

namespace App\Http\Controllers\Mutu\Audit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatHandHygiene;
use App\Models\Kasus\MutuEvaluasiKegiatanPengendalian;
use App\Models\Kasus\MutuIdentifikasiResiko;
use App\Models\Kasus\MutuKegiatanPengendalian;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function get($id)
	{
		$alat = AlatHandHygiene::find($id);
		$tgl_format = Carbon::parse($alat->tanggal)->format('d/m/Y');
		$alat->tanggal_format = $tgl_format;
		return json_encode($alat);
	}

	public function identifikasiResikoLaporan($start, $end, $req)
	{
		$result = MutuIdentifikasiResiko::with('indikator')->whereBetween('created_at', [$start, $end])->where('penanggung_jawab', $req->penanggung_jawab)->get();
		$result = $result->groupBy('indikator_id');
		return $result;
	}

	public function kegiatanPengendalianLaporan($start, $end, $req)
	{
		$result = MutuKegiatanPengendalian::whereBetween('created_at', [$start, $end])->where('penanggung_jawab', $req->penanggung_jawab)->get();
		return $result;
	}

	public function evaluasiKegiatanPengendalianLaporan($start, $end, $req)
	{
		$result = MutuEvaluasiKegiatanPengendalian::whereBetween('created_at', [$start, $end])->get();
		return $result;
	}
}
