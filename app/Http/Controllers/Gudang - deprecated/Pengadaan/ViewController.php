<?php

namespace App\Http\Controllers\Gudang\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Gudang\Pengadaan;
use DOMPDF;
use MPDF;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }
        ini_set('max_execution_time', 300);

		// $supplier = app('App\Http\Controllers\Gudang\Supplier\ReadController')->getAll();
		$supplier = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
		//$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getAll();
		//$pengadaan = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->getAll();
		$data['sidebar_active'] = "pengadaan";
		$data['supplier'] = $supplier;
		//$data['item'] = $items;
		//$data['pengadaan'] = $pengadaan;

		$data['cari_penyedia'] = $request->cari_penyedia;
		$data['tanggal_awal'] = $request->tanggal_awal;
		$data['tanggal_akhir'] = $request->tanggal_akhir;
		$data['harga_minimal'] = $request->harga_minimal;
		$data['harga_maksimal'] = $request->harga_maksimal;
		$data['no_faktur'] = $request->no_faktur;
		$data['no_surat'] = $request->no_surat;
		$data['po_available'] = app('App\Http\Controllers\Keuangan\PO\ReadController')->getActivePO('Farmasi');
		return view('warehouse.pengadaan.index2', $data);
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

        $pengadaan = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->getAll();
        $totalData = intval(count($pengadaan));

        if(empty($searchKey)){
        	$penyedia = $request->penyedia;
        	$tgl_awal = $request->tanggal_awal;
        	$tgl_akhir = $request->tanggal_akhir;
        	$harga_min = $request->harga_minimal;
        	$harga_max = $request->harga_maksimal;
        	$no_faktur = $request->no_faktur;
        	$no_surat = $request->no_surat;

        	if ($penyedia==null && $tgl_awal==null && $tgl_akhir==null && $harga_min==null && $harga_max==null && $no_faktur==null && $no_surat==null) {
        		$getPengadaanPerPage = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')
        							->getPerPage($limit, $start);
        		$totalFiltered = $totalData;
        	} else {
        		$getPengadaanPerPage = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')
        						->filteredData($limit, $start, $penyedia, $tgl_awal, $tgl_akhir, $harga_min, $harga_max, $no_faktur, $no_surat);
        		$totalFiltered = $getPengadaanPerPage->count;
        	}
        }
        
        foreach($getPengadaanPerPage as $row) {
        	$no++;
        	if(is_null($row->keterangan)) $str = '-';
        	else $str = $row->keterangan;
        	$data[] = [
		        $no.'<input type="hidden" value="'.$row->slug.'">',
		        !is_null($row->supplier_id) ? $row->supplier_detail->nama : '-',
		        date('d F Y', strtotime($row->tanggal)),
		        'Rp. '.number_format($row->total_harga),
		        $row->nomor_referensi ? $row->nomor_referensi : "-",
		        $row->nomor_surat_jalan,
		        $str,
                '<a href="'.url('/gudang/pengadaan/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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

	public function addItems()
	{
		return view('warehouse.pengadaan.components.add-items');
	}

	//Moved
	public function single($slug)
	{
		$transaction = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->get($slug);
		//$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getByPengadaan($transaction->id);
		$supplier = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
		//$item = app('App\Http\Controllers\Gudang\Items\ReadController')->getAll();
		//dd($transaction->log);
		$data['sidebar_active'] = "";
		$data['pengadaan'] = $transaction;
		//$data['items'] = $items;
		$data['supplier'] = $supplier;
		$data['po_available'] = app('App\Http\Controllers\Keuangan\PO\ReadController')->getActivePO('Farmasi');
		if(isset($transaction->po_id))
			$data['po_selected'] = json_decode(app('App\Http\Controllers\Keuangan\PO\ReadController')->getSingle($transaction->po_id));
		else
			$data['po_selected'] = null;

		$obj = [];
		foreach ($transaction->log as $key => $value) {
			$obj[$value->detail_item->item_template_id] = $value;
		}
		$data['mapped_detail'] = (object) $obj;
		return view('warehouse.pengadaan.detail2', $data);
	}

	//Moved
	public function printNota($slug)
	{
		$transaction = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->get($slug);
		$items = app('App\Http\Controllers\Gudang\Items\ReadController')->getByPengadaan($transaction->id);
		$data['pengadaan'] = $transaction;
		$data['items'] = $items;
		$pdf = DOMPDF::loadView('warehouse.pengadaan.print-nota',$data);
        return $pdf->stream('nota.pdf');
	}

	public function printFaktur(Request $request)
	{
		
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        if($request->tgl_awal) {
            $tgl_awal = str_replace("/", "-", $request->tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($request->tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $request->tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        $pengadaan = Pengadaan::with(['log', 'supplier_detail'])->orderBy('tanggal_faktur','asc')->whereBetween('tanggal_faktur', [$min_date, $max_date])->get();
        // dd($pengadaan, $min_date, $max_date);
        $data['min_date'] = $min_date;
        $data['max_date'] = $max_date;
		$data['pengadaans'] = $pengadaan;
		// $pdf = DOMPDF::loadView('warehouse.pengadaan.print-faktur',$data)->setPaper('a4', 'landscape');
		$pdf = MPDF::loadView('warehouse.pengadaan.print-faktur',$data, [], ['format' => 'a4-L']);
        return $pdf->stream('faktur-masuk.pdf');
        // return view('warehouse.pengadaan.print-faktur',$data);
	}

	public function today()
	{
		$transactions = app('App\Http\Controllers\Warehouse\Pengadaan\ReadController')->getToday();
		$transactions = json_decode($transactions);
		//$data['transactions'] = array_merge($transactions->black, $transactions->white);
		//dd($data);
		$data['transactions'] = $transactions->data;
		$data['routeFlag'] = 4;
		return view('warehouse.pengadaan.today',$data);
	}
}