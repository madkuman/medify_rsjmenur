<?php

namespace App\Http\Controllers\Farmasi\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use Yajra\DataTables\DataTables;

class ViewController extends Controller
{
	public function index(Request $request, $farmasi)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }
        ini_set('max_execution_time', 300);

		$data['sidebar_active'] = "penghapusan";
		$data['tanggal_awal'] = $request->tanggal_awal;
		$data['tanggal_akhir'] = $request->tanggal_akhir;

		$farm = session('farmasi');
		$data['lokasi'] = Lokasi::all();
		$data['farmasi'] = $farm;
		/*$data['cari_penyedia'] = $request->cari_penyedia;
		$data['harga_minimal'] = $request->harga_minimal;
		$data['harga_maksimal'] = $request->harga_maksimal;*/

		return view('farmasi.penghapusan.index', $data);
	}

	public function loadDataIndex(Request $request, $farmasi)
	{
		$farmid = $request->farmid;
        $penghapusan = app('App\Http\Controllers\Farmasi\Penghapusan\ReadController')->getDataIndex($farmid, $request);
		try {
            return DataTables::of($penghapusan)
            ->addColumn('rownum', function($penghapusan) use (&$rowNum) {
                return ++$rowNum.'<input type="hidden" value="'.$penghapusan->slug.'">';
			})
            ->editColumn('tanggal', function($penghapusan){
                $content = indonesian_date($penghapusan->created_at);
                return $content;
            })
			->editColumn('keterangan', function($penghapusan){
				$content = $penghapusan->keterangan ?? '-';
				return $content;
            })
            ->addColumn('detail', function($penghapusan) use ($farmasi){
				$content = '<a href="'.url('farmasi/'.$farmasi.'/penghapusan/'.$penghapusan->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>';
				return $content;
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return FALSE;
        }
        
	}

	public function single($farmasi, $slug)
	{
		$farm = session('farmasi');
		$transaction = app('App\Http\Controllers\Farmasi\Penghapusan\ReadController')->get($slug);
		
		$data['lokasi'] = Lokasi::all();
		$data['sidebar_active'] = "";
		$data['penghapusan'] = $transaction;
		$data['farmasi'] = $farm;
		
		return view('farmasi.penghapusan.detail', $data);
	}

	public function printNota($farmasi, $slug)
	{
		$transaction = app('App\Http\Controllers\Farmasi\Penghapusan\ReadController')->get($slug);
		$items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getByPenghapusan($transaction->id);
		$data['penghapusan'] = $transaction;
		$data['items'] = $items;
		$pdf = DOMPDF::loadView('farmasi.penghapusan.print-nota',$data);
        return $pdf->stream('nota.pdf');
	}
}