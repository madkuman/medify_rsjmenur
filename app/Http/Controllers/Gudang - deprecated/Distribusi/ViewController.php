<?php

namespace App\Http\Controllers\Gudang\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

        $distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getAll();
		$pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
        $data['pharmacy'] = $pharmacy;
		$data['sidebar_active'] = "distribusi";
		$data['distribusi'] = $distribusi;
        
        $data['unit_tujuan'] = $request->cari_unit;
        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_akhir;
        $data['kategori'] = $request->kategori;
        $data['status_selesai'] = ($request->selesai) ? $request->status_selesai : "on";
        $data['status_konfirmasi'] = ($request->konfirmasi) ? $request->status_konfirmasi : "on";
        //dd($data);

		return view('warehouse.distribusi.index',$data);
	}

	public function loadData(Request $request)
	{
		$limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;
        $first = null;
        $data = array();

        $distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getAll();
        $totalData = intval(count($distribusi));

        if(empty($searchKey)){
        	$unit_tujuan = $request->unit_tujuan;
        	if($unit_tujuan == "Semua Unit") $unit_tujuan = null;
            $tanggal_awal = $request->tanggal_awal;
            $tanggal_akhir = $request->tanggal_akhir;
            $kategori = $request->kategori;
            if($kategori == "Semua Kategori") $kategori = null;
            $status = $request->status;
            //dd($unit_tujuan);

            if ($unit_tujuan==null && $tanggal_awal==null && $tanggal_akhir==null && $status==2 && $kategori==null) {
                $getDistribusiPerPage = app('App\Http\Controllers\Gudang\Distribusi\ReadController')
                                    ->getPerPage($limit, $start);
                $totalFiltered = $totalData;
            } else {
                $getDistribusiPerPage = app('App\Http\Controllers\Gudang\Distribusi\ReadController')
                                ->filteredData($limit, $start, $unit_tujuan, $tanggal_awal, $tanggal_akhir, $status, $kategori);
                $totalFiltered = $getDistribusiPerPage->count;
            }
        }

        foreach($getDistribusiPerPage as $row) {
        	$no++;
        	if($row->status == 0){
                $status = '<span class="p-2 badge badge-info">Konfirmasi</span>';
        	}
            else if($row->status == 1){
                if($row->tipe==1) $status = '<span class="p-2 badge badge-info">Konfirmasi</span>';
                else $status = '<span class="p-2 badge badge-primary">Terkirim</span>';
            }
            else if($row->status == 2){
                $status = '<span class="p-2 badge badge-success">Selesai</span>';
            }
            else if($row->status == -1){
                $status = '<span class="p-2 badge badge-danger">Ditolak</span>';
            }
            else if($row->status == -2){
                $status = '<span class="p-2 badge badge-danger">Dibatalkan</span>';
            }

        	$data[] = [
		        $no.'<input type="hidden" value="'.$row->slug.'">',
		        $row->farmasi_id ? $row->farmasi_detail->nama : "Gudang",
		        $row->kategori,
		        date('d F Y, H:i', strtotime($row->verified_at ? $row->verified_at : $row->created_at)),
		        $status,
		        $row->deskripsi ? $row->deskripsi : "-",
                '<a href="'.url('gudang/distribusi/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
		     ];
        }

        $json_data = array(
	      	"draw"            => $draw,
	      	"recordsTotal"    => $totalData,  
	      	"recordsFiltered" => $totalFiltered, 
	      	"data"            => $data
	    );

	    return json_encode($json_data);
	}

	public function addItems()
	{
		return view('warehouse.distribusi.components.add-items');
	}

	public function single($slug)
	{
		$distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getSingle($slug);
		$pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
        $data['pharmacy'] = $pharmacy;
		$data['sidebar_active'] = "";
		$data['distribusi'] = $distribusi;
		return view('warehouse.distribusi.detail', $data);
	}

    public function print($slug)
    {
        $distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getSingle($slug);
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
        $data['pharmacy'] = $pharmacy;
        $data['distribusi'] = $distribusi;
        $barang = array();
        $i=1;
        if($distribusi->kategori == 'Permintaan')
        {
            foreach ($distribusi->transaksi_detail->draft as $draft) 
            {
                $barang[$i]['nama'] = $draft->detail_draft->nama;
                $barang[$i]['satuan'] = $draft->detail_draft->satuan;
                $barang[$i]['dikasih'] = '-';
                $barang[$i]['minta'] = $draft->jumlah;
                $i++;
            }
            foreach ($distribusi->log as $log) 
            {
                $flag=0;
                for($j=1;$j<$i;$j++)
                {
                    if($barang[$j]['nama'] == $log->detail_item->detail_item->nama)
                    {
                        $barang[$j]['dikasih'] = $log->jumlah;
                        $flag++;
                        break;
                    }
                }
                if(!$flag)
                {
                    $barang[$i]['nama'] = $log->detail_item->detail_item->nama;
                    $barang[$i]['satuan'] = $log->detail_item->detail_item->satuan;
                    $barang[$i]['dikasih'] = $log->jumlah;
                    $barang[$i]['minta'] = '-';
                    $i++;
                }
            }
        }
        else
        {
            if($distribusi->tipe == 1)
            {
                foreach ($distribusi->log as $log) 
                {
                    $barang[$i]['nama'] = $log->detail_item->detail_item->nama;
                    $barang[$i]['satuan'] = $log->detail_item->detail_item->satuan;
                    $barang[$i]['dikasih'] = $log->jumlah;
                    $barang[$i]['minta'] = '-';
                    $i++;
                }
            }
            else
            {
                foreach ($distribusi->log as $log) 
                {
                    $barang[$i]['nama'] = $log->detail_item->detail_item->nama;
                    $barang[$i]['satuan'] = $log->detail_item->detail_item->satuan;
                    $barang[$i]['dikasih'] = '-';
                    $barang[$i]['minta'] = $log->jumlah;
                    $i++;
                }
            }
        }
        $data['barang'] = $barang;
        // dd($data, $distribusi->log);
        $pdf = DOMPDF::loadView('warehouse.distribusi.print',$data);
        return $pdf->stream('DistribusiPermintaan.pdf');
    }
}
