<?php

namespace App\Http\Controllers\Farmasi\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use Yajra\DataTables\Facades\DataTables;

class ViewController extends Controller
{
	public function index($farmasi)
	{
        ini_set('max_execution_time', 300);

        $farm = session('farmasi');
		$supplier = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
		$data['lokasi'] = Lokasi::all();
		$data['sidebar_active'] = "pengadaan";
		$data['farmasi'] = $farm;
		$data['supplier'] = $supplier;
		$data['sumber_dana'] = app('App\Http\Controllers\Farmasi\SumberDana\ReadController')->getAll();
		$data['katalog'] = app('App\Http\Controllers\Farmasi\Katalog\ReadController')->getAll();
		$data['po_available'] = app('App\Http\Controllers\Keuangan\PO\ReadController')->getActivePO('Farmasi');

		return view('farmasi.pengadaan.index', $data);
	}

	public function loadDataIndex($farmasi, Request $request)
	{
		$farmid = $request->farmid;
		$pengadaan = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->getDataIndex($farmid, $request);
		try {
            return DataTables::of($pengadaan)
            ->addColumn('rownum', function($pengadaan) use (&$rowNum) {
                return ++$rowNum.'<input type="hidden" value="'.$pengadaan->slug.'">';
			})
            ->addColumn('penyedia', function($pengadaan){
				$content = !is_null($pengadaan->supplier_id) ? $pengadaan->supplier_detail->nama : '-';
                return $content;
            })
            ->editColumn('tanggal', function($pengadaan){
                $content = indonesian_date($pengadaan->tanggal);
                return $content;
            })
            ->editColumn('nilai', function($pengadaan){
                $content = 'Rp. '.number_format($pengadaan->total_harga);
                return $content;
            })
            ->editColumn('no_faktur', function($pengadaan){
                $content = $pengadaan->nomor_referensi ? $pengadaan->nomor_referensi : "-";
				return $content;
			})
			->editColumn('no_surat', function($pengadaan){
                $content = $pengadaan->nomor_surat_jalan; 
				return $content;
			})
			->editColumn('keterangan', function($pengadaan){
				if(is_null($pengadaan->keterangan)) $content = '-';
        		else $content = $pengadaan->keterangan;
				return $content;
            })
            ->addColumn('detail', function($pengadaan) use ($farmasi){
				$content = '<a href="'.url('farmasi/'.$farmasi.'/pengadaan/'.$pengadaan->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>';
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
		$temp = app('App\Http\Controllers\Farmasi\Farmasi\ViewController')->templateView($farmasi,$farm,"");
		$data['po_available'] = app('App\Http\Controllers\Keuangan\PO\ReadController')->getActivePO('Farmasi');
		$transaction = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->get($slug);
		$items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getByPengadaan($transaction->id);
		$data['supplier'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        $data['sumber_dana'] = app('App\Http\Controllers\Farmasi\SumberDana\ReadController')->getAll();
        $data['katalog'] = app('App\Http\Controllers\Farmasi\Katalog\ReadController')->getAll();
		$data['items'] = $items;
		$data['pengadaan'] = $transaction;
		$data = $data + $temp;
		$data['pengadaan'] = $transaction;
		// if(isset($transaction->po_id))
		// 	$data['po_selected'] = json_decode(app('App\Http\Controllers\Keuangan\PO\ReadController')->getSingle($transaction->po_id));
		// else
		// 	$data['po_selected'] = null;
		
		$obj = [];
		foreach ($transaction->log as $key => $value) {
			$obj[$value->detail_item->item_template_id] = $value;
		}
		$data['mapped_detail'] = (object) $obj;
		$data = $data + $temp;
		return view('farmasi.pengadaan.detail', $data);
	}

	public function printNota($farmasi,$slug)
	{
		$transaction = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->get($slug);
		$items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getByPengadaan($transaction->id);
		$farm = session('farmasi');
		$data['pengadaan'] = $transaction;
		$data['items'] = $items;
		$data['farmasi'] = $farm;
		$pdf = DOMPDF::loadView('farmasi.pengadaan.print-nota',$data);
        return $pdf->stream('nota.pdf');
	}
}