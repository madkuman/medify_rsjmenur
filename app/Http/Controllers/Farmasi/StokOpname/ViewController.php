<?php

namespace App\Http\Controllers\Farmasi\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use MPDF;
use App\Exports\Farmasi\StokOpnameDetail;
use Yajra\DataTables\DataTables;

class ViewController extends Controller
{
	public function index(Request $request, $farmasi)
	{
		if ($request->isMethod('post')) {
			session($request->except('_token'));
		}
		ini_set('max_execution_time', 300);

		$data['sidebar_active'] = "stokopname";
		// $data['tanggal_awal'] = $request->tanggal_awal;
		// $data['tanggal_akhir'] = $request->tanggal_akhir;
        $data['so_satuan'] = ($request->so_satuan) ? $request->so_satuan : "";
        $data['so_besar'] = ($request->so_besar) ? $request->so_besar : "on";

		$farm = session('farmasi');
		$items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllItems($farm->id);
		$data['lokasi'] = Lokasi::all();
		$data['farmasi'] = $farm;
		$data['items'] = $items;

		return view('farmasi.stokopname.index', $data);
	}

	public function loadDataIndex(Request $request, $farmasi)
	{
		$farmid = $request->farmid;
        $stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getDataIndex($farmid, $request);
		try {
            return DataTables::of($stokopname)
            ->addColumn('rownum', function($stokopname) use (&$rowNum) {
                return ++$rowNum.'<input type="hidden" value="'.$stokopname->slug.'">';
			})
            ->editColumn('tanggal', function($stokopname){
                $content = indonesian_date($stokopname->created_at);
                return $content;
            })
			->editColumn('keterangan', function($stokopname){
				$content = $stokopname->keterangan ?? '-';
				return $content;
			})
			->editColumn('dibuat', function($stokopname){
				$content = $stokopname->created_by_detail->name ?? '-';
				return $content;
			})
			->editColumn('status', function($stokopname){
				if($stokopname->status == 0){
					$status = '<span class="p-2 badge badge-info">Menunggu</span>';
				}
				else{
					$status = '<span class="p-2 badge badge-success">Selesai</span>';
				}
				return $status;
            })
            ->addColumn('detail', function($stokopname) use ($farmasi){
				$content = '<a href="'.url('farmasi/'.$farmasi.'/stokopname/'.$stokopname->slug.'/'.$stokopname->flag).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>';
				return $content;
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
	}

	public function single($farmasi, $slug, $flag)
	{
		$farm = session('farmasi');
		$transaction = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
		
		$data['lokasi'] = Lokasi::all();
		$data['sidebar_active'] = "";
		$data['stokopname'] = $transaction;
		$data['farmasi'] = $farm;
		$data['flag'] = $flag;
		return view('farmasi.stokopname.detail', $data);
	}

	public function new(Request $request, $farmasi)
	{	
		$farm = session('farmasi');
		$items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllItems($farm->id);
		$data['lokasi'] = Lokasi::all();
		$data['items'] = $items;
		$data['farmasi'] = $farm;
		$data['sidebar_active'] = "";
		return view('farmasi.stokopname.new', $data);
	}

	public function review($farmasi, $slug)
	{
		$farm = session('farmasi');
		$stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
		$barang = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaan($slug);

		$data['lokasi'] = Lokasi::all();
		$data['stokopname'] = $stokopname;
		$data['barang'] = $barang;

		return view('farmasi.stokopname.review', $data);  
	}

	public function reviewPrint($farmasi, $slug)
	{
		$farm = session('farmasi');
		$stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
		$barang = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaan($slug);

		$data['lokasi'] = Lokasi::all();
		$data['stokopname'] = $stokopname;
		$data['barang'] = $barang;

		$pdf = MPDF::loadView('farmasi.stokopname.review-print',$data, [], [
            'mode' => 'utf-8',
            'format' => 'A4-L'
        ]);
		return $pdf->stream('review-print.pdf');
	}

	public function print($farmasi, $slug)
	{
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$farm = session('farmasi');
		$stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
		$barang = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaan($slug);

		$data['stokopname'] = $stokopname;
		$data['barang'] = $barang;
		$pdf = MPDF::loadView('farmasi.stokopname.print',$data, [], [
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
		return $pdf->stream('print.pdf');
	}

	public function download($farmasi, $slug)
	{
		ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$farm = session('farmasi');
		$stokopname = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->get($slug);
		$barang = app('App\Http\Controllers\Farmasi\StokOpname\ReadController')->getPerbedaan($slug);

		$data['stokopname'] = $stokopname;
		$data['barang'] = $barang;
		$filename = 'Laporan Stok Opname';
		return (new StokOpnameDetail($data))->download($filename.'.xlsx');
	}
}