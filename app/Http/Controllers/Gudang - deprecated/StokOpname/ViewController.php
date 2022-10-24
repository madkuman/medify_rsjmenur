<?php

namespace App\Http\Controllers\Gudang\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DOMPDF;
use MPDF;
use App\Exports\Gudang\StokOpnameDetail;

class ViewController extends Controller
{
   public function index(Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }
        ini_set('max_execution_time', 300);

		$data['sidebar_active'] = "stokopname";
		$data['tanggal_awal'] = $request->tanggal_awal;
		$data['tanggal_akhir'] = $request->tanggal_akhir;

		$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getAllItems();
		$data['items'] = $items;
		/*$data['cari_penyedia'] = $request->cari_penyedia;
		$data['harga_minimal'] = $request->harga_minimal;
		$data['harga_maksimal'] = $request->harga_maksimal;*/

		return view('warehouse.stokopname.index', $data);
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

        $stokopname = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getAll();
        $totalData = intval(count($stokopname));

        if(empty($searchKey)){
        	$tgl_awal = $request->tanggal_awal;
        	$tgl_akhir = $request->tanggal_akhir;

        	if ($tgl_awal==null && $tgl_akhir==null) {
        		$getStokOpnamePerPage = app('App\Http\Controllers\Gudang\StokOpname\ReadController')
        							->getPerPage($limit, $start);
        		$totalFiltered = $totalData;
        	} else {
        		$getStokOpnamePerPage = app('App\Http\Controllers\Gudang\StokOpname\ReadController')
        						->filteredData($limit, $start, $tgl_awal, $tgl_akhir);
        		$totalFiltered = $getStokOpnamePerPage->count;
        	}
        }
        
        foreach($getStokOpnamePerPage as $row) {
        	$no++;
        	if(is_null($row->keterangan)) $str = '-';
        	else $str = $row->keterangan;
        	if($row->status == 0){
                $status = '<span class="p-2 badge badge-info">Menunggu</span>';
        	}
            else{
                $status = '<span class="p-2 badge badge-success">Selesai</span>';
            }
        	$data[] = [
		        $no.'<input type="hidden" value="'.$row->slug.'">',
		        date('d F Y', strtotime($row->created_at)),
		        $str,
		        $row->created_by_detail->name,
		        $status,
		        '<a href="'.url('gudang/stokopname/'.$row->slug.'/'.$row->flag).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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

	public function single($slug, $flag)
	{
		$transaction = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->get($slug);
		
		$data['sidebar_active'] = "";
		$data['stokopname'] = $transaction;
		$data['flag'] = $flag;
		//dd($transaction->distribusi, $transaction->penghapusan);
		// dd($transaction->distribusi->log);
		return view('warehouse.stokopname.detail', $data);
	}

	public function new(Request $request)
	{	
		// dd($request);
		$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getAllItems();
		$data['items'] = $items;
		$data['sidebar_active'] = "";
		return view('warehouse.stokopname.new', $data);
	}

	public function review($slug)
    {
        $stokopname = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->get($slug);
        $barang = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getPerbedaan($slug);

        $data['stokopname'] = $stokopname;
        $data['barang'] = $barang;

        return view('warehouse.stokopname.review', $data);  
    }

    public function print($slug)
	{
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$stokopname = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->get($slug);
        $barang = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getPerbedaan($slug);

        $data['stokopname'] = $stokopname;
        $data['barang'] = $barang;

        // dd($data);

		$pdf = MPDF::loadView('warehouse.stokopname.print-gudang',$data, [], [
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);
		return $pdf->stream('print.pdf');
	}

	public function download($slug)
	{
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$stokopname = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->get($slug);
        $barang = app('App\Http\Controllers\Gudang\StokOpname\ReadController')->getPerbedaan($slug);

        $data['stokopname'] = $stokopname;
		$data['barang'] = $barang;
		$filename = 'Laporan Stok Opname';
		return (new StokOpnameDetail($data))->download($filename.'.xlsx');
	}
}
