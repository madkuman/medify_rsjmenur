<?php

namespace App\Http\Controllers\Gudang\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DOMPDF;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }
        ini_set('max_execution_time', 300);

		$data['sidebar_active'] = "penghapusan";
		$data['tanggal_awal'] = $request->tanggal_awal;
		$data['tanggal_akhir'] = $request->tanggal_akhir;
		

		/*$data['cari_penyedia'] = $request->cari_penyedia;
		$data['harga_minimal'] = $request->harga_minimal;
		$data['harga_maksimal'] = $request->harga_maksimal;*/

		return view('warehouse.penghapusan.index', $data);
	}

	public function loadData(Request $request)
	{
		//dd($request);
		$limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;
        $first = null;
        $data = array();

        $penghapusan = app('App\Http\Controllers\Gudang\Penghapusan\ReadController')->getAll();
        $totalData = intval(count($penghapusan));

        if(empty($searchKey)){
        	$tgl_awal = $request->tanggal_awal;
        	$tgl_akhir = $request->tanggal_akhir;

        	if ($tgl_awal==null && $tgl_akhir==null) {
        		$getPenghapusanPerPage = app('App\Http\Controllers\Gudang\Penghapusan\ReadController')
        							->getPerPage($limit, $start);
        		$totalFiltered = $totalData;
        	} else {
        		$getPenghapusanPerPage = app('App\Http\Controllers\Gudang\Penghapusan\ReadController')
        						->filteredData($limit, $start, $tgl_awal, $tgl_akhir);
        		$totalFiltered = $getPenghapusanPerPage->count;
        	}
        }
        
        foreach($getPenghapusanPerPage as $row) {
        	$no++;
        	if(is_null($row->keterangan)) $str = '-';
        	else $str = $row->keterangan;
        	$data[] = [
		        $no.'<input type="hidden" value="'.$row->slug.'">',
		        date('d F Y', strtotime($row->created_at)),
		        $str,
                '<a href="'.url('gudang/penghapusan/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
		     ];
        }

        $json_data = array(
	      	"draw"            => $draw,
	      	"recordsTotal"    => $totalData,  
	      	"recordsFiltered" => $totalFiltered, 
	      	"data"            => $data
	    );
	    //dd($json_data);

	    return json_encode($json_data);
	}

	public function single($slug)
	{
		$transaction = app('App\Http\Controllers\Gudang\Penghapusan\ReadController')->get($slug);
		
		$data['sidebar_active'] = "";
		$data['penghapusan'] = $transaction;
		
		return view('warehouse.penghapusan.detail', $data);
	}

	public function printNota($slug)
	{
		$transaction = app('App\Http\Controllers\Gudang\Penghapusan\ReadController')->get($slug);
		$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getByPenghapusan($transaction->id);
		$data['penghapusan'] = $transaction;
		$data['items'] = $items;
		$pdf = DOMPDF::loadView('warehouse.penghapusan.print-nota',$data);
        return $pdf->stream('nota.pdf');
	}

	public function today()
	{
		$transactions = app('App\Http\Controllers\Warehouse\Penghapusan\ReadController')->getToday();
		$transactions = json_decode($transactions);
		//$data['transactions'] = array_merge($transactions->black, $transactions->white);
		//dd($data);
		$data['transactions'] = $transactions->data;
		$data['routeFlag'] = 4;
		return view('warehouse.pengadaan.today',$data);
	}
}