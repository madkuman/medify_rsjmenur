<?php

namespace App\Http\Controllers\Farmasi\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use Yajra\DataTables\DataTables;
use App\Models\Farmasi\PenghapusanJenis;

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

		$data['penghapusan_jenis'] = PenghapusanJenis::get();
		$farm = session('farmasi');
		$data['lokasi'] = Lokasi::all();
		$data['farmasi'] = $farm;
		$data['supplier'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
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
				if(!empty($penghapusan->tgl_pengeluaran)) return indonesian_date($penghapusan->tgl_pengeluaran);
				else return indonesian_date($penghapusan->created_at);
            })
            ->editColumn('jenis', function($penghapusan){
                return $penghapusan->penghapusan_jenis->nama ?? '';
            })
            ->editColumn('penyedia', function($penghapusan){
                return $penghapusan->penyedia->nama ?? '';
            })
            ->editColumn('no_pengeluaran', function($penghapusan){
                return $penghapusan->no_pengeluaran;
            })
            ->editColumn('surat_perintah', function($penghapusan){
                return $penghapusan->surat_perintah;
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

		
		$data['penghapusan_jenis'] = PenghapusanJenis::get();
		$data['supplier'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
		
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