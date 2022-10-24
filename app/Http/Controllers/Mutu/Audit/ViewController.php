<?php

namespace App\Http\Controllers\Mutu\Audit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatHandHygiene;
use App\User;
use DataTables;

class ViewController extends Controller
{
	public function index()
	{
		return view('mutu.audit.index');
	}

	public function hh(Request $request)
	{
		$data = [];
		if(!empty($request->user_id)) {
			$data['user'] = User::find($request->user_id);
			$data['hh'] = AlatHandHygiene::where('user_id',$request->user_id)->orderBy('tanggal','desc')->get();
		}
		return view('mutu.audit.hh.index',$data);
	}

	public function iad()
	{
		return view('mutu.audit.iad.index');
	}

	public function isk()
	{
		return view('mutu.audit.isk.index');
	}

	public function ido()
	{
		return view('mutu.audit.ido.index');
	}

	public function vap()
	{
		return view('mutu.audit.vap.index');
	}

	public function dekubitus()
	{
		return view('mutu.audit.dekubitus.index');
	}

	public function minmed()
	{
		return view('mutu.audit.minmed.index');
	}

	public function identifikasiResiko()
	{
		$data['penanggung_jawab'] = \App\Models\Kasus\MutuIdentifikasiResiko::pluck('penanggung_jawab')->unique();
		$data['indikator_mutu'] = \App\Models\Kasus\MutuIndikator::get()->keyBy('id');
		return view('mutu.audit.identifikasi-resiko.index', $data);
	}

	public function identifikasiResikoGetData(Request $request)
	{
		$query = \App\Models\Kasus\MutuIdentifikasiResiko::with('indikator')->orderBy('id', 'desc');
		return DataTables::of($query)
				->addIndexColumn()
				->editColumn('created_at', function ($item) {
					$content = \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
					return $content;
				})
				->addColumn('opsi', function ($item) {
					$content = '<a href="javascript:void(0)" class="btn btn-info btn-edit mr-5" data-id="'.$item->id.'"><i class="fa fa-pencil"></i></a>
								<a href="javascript:void(0)" class="btn btn-danger btn-delete" data-id="'.$item->id.'"><i class="fa fa-trash"></i></a>';
					return $content;
				})
				->escapeColumns([])
				->make(true);
	}

	public function kegiatanPengendalian()
	{
		$data['penanggung_jawab'] = \App\Models\Kasus\MutuKegiatanPengendalian::pluck('penanggung_jawab')->unique();;
		return view('mutu.audit.kegiatan-pengendalian.index', $data);
	}

	public function kegiatanPengendalianGetData(Request $request)
	{
		$query = \App\Models\Kasus\MutuKegiatanPengendalian::orderBy('id', 'desc');
		return DataTables::of($query)
			->addIndexColumn()
			->editColumn('created_at', function ($item) {
				$content = \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
				return $content;
			})
			->addColumn('opsi', function ($item) {
				$content = '<a href="javascript:void(0)" class="btn btn-info btn-edit mr-5" data-id="' . $item->id . '"><i class="fa fa-pencil"></i></a>
								<a href="javascript:void(0)" class="btn btn-danger btn-delete" data-id="' . $item->id . '"><i class="fa fa-trash"></i></a>';
				return $content;
			})
			->escapeColumns([])
			->make(true);
	}

	public function evaluasiKegiatanPengendalian()
	{
		return view('mutu.audit.evaluasi-kegiatan-pengendalian.index');
	}

	public function evaluasiKegiatanPengendalianGetData(Request $request)
	{
		$query = \App\Models\Kasus\MutuEvaluasiKegiatanPengendalian::orderBy('id', 'desc');
		return DataTables::of($query)
			->addIndexColumn()
			->editColumn('created_at', function ($item) {
				$content = \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
				return $content;
			})
			->addColumn('opsi', function ($item) {
				$content = '<a href="javascript:void(0)" class="btn btn-info btn-edit mr-5" data-id="' . $item->id . '"><i class="fa fa-pencil"></i></a>
								<a href="javascript:void(0)" class="btn btn-danger btn-delete" data-id="' . $item->id . '"><i class="fa fa-trash"></i></a>';
				return $content;
			})
			->escapeColumns([])
			->make(true);
	}
}
