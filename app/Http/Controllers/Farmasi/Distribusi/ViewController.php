<?php

namespace App\Http\Controllers\Farmasi\Distribusi;

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
        $farm = session('farmasi');
		$pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
        $data['lokasi'] = Lokasi::all();
        $data['pharmacy'] = $pharmacy;
        $data['farmasi'] = $farm;
		$data['sidebar_active'] = "distribusi";

		$data['unit_tujuan'] = $request->cari_unit;
        $data['tanggal_awal'] = $request->tanggal_awal ?? Carbon::now()->format('d/m/Y');
        $data['tanggal_akhir'] = $request->tanggal_akhir ?? Carbon::now()->format('d/m/Y');
        $data['jenis'] = $request->jenis;
        $data['status_selesai'] = ($request->selesai) ? $request->status_selesai : "on";
        $data['status_konfirmasi'] = ($request->konfirmasi) ? $request->status_konfirmasi : "on";
        $data['status_menunggu'] = ($request->menunggu) ? $request->status_menunggu : "on";
        $data['tipe_masuk'] = ($request->masuk) ? $request->tipe_masuk : "on";
        $data['tipe_keluar'] = ($request->keluar) ? $request->tipe_keluar : "on";

        $auto_fill_farmasi_id = $request['auto-request-farmasi-id'];

        /*AUTO FILL DARI BARANG EXPIRED PAKE ITEMS*/
        $auto_items_ids = $request['auto-request-items'];
        if(!empty($auto_items_ids)) $auto_items_ids = explode(",", $auto_items_ids);
        if($data['jenis'] == 'Permintaan'){
            $data['auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillFromItems($auto_fill_farmasi_id,$auto_items_ids);
            $data['source_auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillFromItemsFarmasi($farm->id,$auto_items_ids);
        }
        else{
            $data['auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillItems($auto_items_ids);
            $data['source_auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillFromItemsFarmasi($auto_fill_farmasi_id,$auto_items_ids);
        }

        /*AUTO FILL DARI BARANG LOW STOCK PAKE ITEMS FARMASI*/
        if(empty($data['auto_fill_items']))
        {
            $auto_items_farmasi_ids = $request['auto-request-items-farmasi'];
            if(!empty($auto_items_farmasi_ids)) $auto_items_farmasi_ids = explode(",", $auto_items_farmasi_ids);
            $data['auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillFromItemsFarmasi($auto_fill_farmasi_id,$auto_items_farmasi_ids);
            $data['source_auto_fill_items'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getAutoFillFromItemsFarmasi($farm->id,$auto_items_farmasi_ids);
        }


        $data['auto_fill_farmasi_id'] = $auto_fill_farmasi_id;

		return view('farmasi.distribusi.index', $data);
	}

    public function loadDataIndex($farmasi, Request $request)
    {
        $farmid = $request->farmid;
		$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->all($farmid, $request);
        try {
            return DataTables::of($distribusi)
            ->addColumn('rownum', function($distribusi) use (&$rowNum) {
                return ++$rowNum.'<input type="hidden" value="'.$distribusi->slug.'">';
            })
            ->addColumn('tujuan', function($distribusi){
				$content = $distribusi->unit_tujuan ? $distribusi->detail_tujuan->nama : 'Gudang';
                return $content;
            })
            ->editColumn('kategori', function($distribusi){
                $content = '-';
                if($distribusi->kategori == 'Kiriman' && $distribusi->tipe == '-1') $content = 'Keluar';
                else if($distribusi->kategori == 'Kiriman' && $distribusi->tipe == '1') $content = 'Masuk';
                else if($distribusi->kategori == 'Permintaan' && $distribusi->tipe == '1') $content = 'Masuk';
                else if($distribusi->kategori == 'Permintaan' && $distribusi->tipe == '-1') $content = 'Keluar';
                else if($distribusi->kategori == 'Retur' && $distribusi->tipe == '1') $content = 'Masuk';
                else if($distribusi->kategori == 'Retur' && $distribusi->tipe == '-1') $content = 'Keluar';
                else if($distribusi->kategori == 'Pengembalian' && $distribusi->tipe == '1') $content = 'Masuk';
                else if($distribusi->kategori == 'Pengembalian' && $distribusi->tipe == '-1') $content = 'Keluar';
                return $content;
            })
            ->editColumn('waktu', function($distribusi){
                $content = indonesian_date($distribusi->verified_at ? $distribusi->verified_at : $distribusi->created_at);
                return $content;
            })
            ->editColumn('status', function($distribusi){
                if($distribusi->status == 0){
                    if($distribusi->tipe == 1) $content = '<span class="p-2 badge badge-warning">Menunggu</span>';
                    else $content = '<span class="p-2 badge badge-info">Konfirmasi</span>';
                }
                else if($distribusi->status == 1){
                    if($distribusi->tipe == 1) $content = '<span class="p-2 badge badge-info">Konfirmasi</span>';
                    else $content = '<span class="p-2 badge badge-primary">Terkirim</span>';
                }
                else if($distribusi->status == 2){
                    $content = '<span class="p-2 badge badge-success">Selesai</span>';
                }
                else if($distribusi->status == -1){
                    $content = '<span class="p-2 badge badge-danger">Ditolak</span>';
                }
                else if($distribusi->status == -2){
                    $content = '<span class="p-2 badge badge-danger">Dibatalkan</span>';
                }
				return $content;
			})
			->editColumn('keterangan', function($distribusi){
                $content = $distribusi->deskripsi ? $distribusi->deskripsi : "-"; 
				return $content;
            })
            ->addColumn('detail', function($distribusi) use ($farmasi){
				$content = '<a href="'.url('farmasi/'.$farmasi.'/distribusi/'.$distribusi->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>';
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
        $distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($slug);
        // dd($distribusi);
		$pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
		$stok = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemsFarmasiStokFormDistribusi($distribusi);
        $data['lokasi'] = Lokasi::all();
        $data['pharmacy'] = $pharmacy;
		$data['sidebar_active'] = "";
        $data['farmasi'] = $farm;
		$data['distribusi'] = $distribusi;
		$data['stok'] = $stok;
		return view('farmasi.distribusi.detail', $data);
	}

    public function print($farmasi, $slug)
    {
        $farm = session('farmasi');
        $distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getSingle($slug);
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();
        $data['lokasi'] = Lokasi::all();
        $data['pharmacy'] = $pharmacy;
        $data['farm'] = $farmasi;
        $data['farmasi'] = $farm;
        $data['farmer'] = $farm->nama;
        $data['distribusi'] = $distribusi;
        if($distribusi->tipe == 1)
        {
            $distribusi_penerima = $distribusi;
            $distribusi_pengirim = $distribusi->distribusi_detail;
            $penerima = $distribusi->verified_by_detail;
            $pengirim = $distribusi->distribusi_detail->verified_by_detail;
        }
        else
        {
            $distribusi_penerima = $distribusi->distribusi_detail;
            $distribusi_pengirim = $distribusi;
            $penerima = $distribusi->distribusi_detail->verified_by_detail;
            $pengirim = $distribusi->verified_by_detail;
        }

        $data['distribusi_penerima'] = $distribusi_penerima;
        $data['distribusi_pengirim'] = $distribusi_pengirim;
        $data['penerima'] = $penerima;
        $data['pengirim'] = $pengirim;


        $library_barang = [];
        $barang = array();
        $i=1;
        if($distribusi->kategori == 'Permintaan')
        {
            if($distribusi->tipe == 1)
            {
                //nge get yang diminta
                foreach ($distribusi->draft as $draft) 
                {
                    $barang[$i]['nama'] = $draft->item_farmasi->item_template->nama;
                    $barang[$i]['satuan'] = $draft->item_farmasi->item_template->satuan;
                    $barang[$i]['dikasih'] = null;
                    $barang[$i]['minta'] = $draft->jumlah;
                    $library_barang[$barang[$i]['nama']] = $i;
                    $i++;
                }
                /*
                    nge get yang dikirim, ini terjadi jika daftar item yang diminta != dikirim
                    Misal minta obat omeprazole, dikirim obat paracetamol
                    jadi nge iterate obat kiriman, kalo sudah ada, maka dikasih di daftar dikasih
                */ $k=0;
                foreach ($distribusi->distribusi_detail->log as $log)
                {
                    $nama = $log->detail_item->item_farmasi->item_template->nama;
                    if(isset($library_barang[$nama]))
                    {
                        $source_index = $library_barang[$nama];
                        if(empty($log->alasan_ditolak))
                        $barang[$source_index]['dikasih'][$k] = $log->jumlah;
                        else
                        $barang[$source_index]['dikasih'][$k] = null;

                        $barang[$source_index]['kadaluarsa'][$k] = $log->detail_item->kadaluarsa;
                        $k++;
                    }
                    else
                    {
                        $barang[$i]['nama'] = $nama;
                        $barang[$i]['satuan'] = $log->detail_item->item_farmasi->item_template->satuan;
                        if(empty($log->alasan_ditolak))
                        $barang[$i]['dikasih'] = $log->jumlah;
                        else
                        $barang[$i]['dikasih'] = null;

                        $barang[$i]['kadaluarsa'] = $log->detail_item->kadaluarsa;
                        $barang[$i]['minta'] = '-';
                        $i++;
                    }
                }
                foreach ($distribusi->items as $item) 
                {
                    $flag=0;
                    for($j=1;$j<$i;$j++)
                    {
                        if($barang[$j]['nama'] == $item->detail_item->item_detail->nama)
                        {
                            $barang[$j]['dikasih'] = $item->jumlah_total;
                            $barang[$j]['kadaluarsa'] = $item->kadaluarsa;
                            $flag++;
                            break;
                        }
                    }
                    if(!$flag)
                    {
                        $barang[$i]['nama'] = $item->detail_item->item_detail->nama;
                        $barang[$i]['satuan'] = $item->detail_item->item_detail->satuan;
                        $barang[$i]['dikasih'] = $item->jumlah_total;
                        $barang[$i]['kadaluarsa'] = $item->kadaluarsa;
                        $barang[$i]['minta'] = '-';
                        $i++;
                    }
                }
            }
            else
            {
                foreach ($distribusi->distribusi_detail->draft as $draft) 
                {
                    if($draft->item_farmasi)
                    {
                        if($draft->item_farmasi->farmasi_id == $farm->id) {
                            $barang[$i]['nama'] = $draft->item_farmasi->item_detail->nama;
                            $barang[$i]['satuan'] = $draft->item_farmasi->item_detail->satuan;
                        }
                        else 
                        {
                            $barang[$i]['nama'] = $draft->detail_draft->nama;
                            $barang[$i]['satuan'] = $draft->detail_draft->satuan;
                        } 
                    }
                    else
                    {
                        $barang[$i]['nama'] = $draft->detail_draft->item_detail->nama;
                        $barang[$i]['satuan'] = $draft->detail_draft->item_detail->satuan;
                    }
                    $barang[$i]['dikasih'] = null;
                    $barang[$i]['minta'] = $draft->jumlah;
                    $i++;
                }
                $k=0;
                foreach ($distribusi->log as $record)
                {
                    $flag=0;
                    for($j=1;$j<$i;$j++)
                    {
                        if($barang[$j]['nama'] == $record->detail_item->detail_item->item_detail->nama)
                        {
                            if(empty($record->alasan_ditolak))
                            $barang[$j]['dikasih'][$k] = $record->jumlah;
                            else
                            $barang[$j]['dikasih'][$k] = null;

                            $barang[$j]['kadaluarsa'][$k] = $record->detail_item->kadaluarsa;
                            $flag++;
                            $k++;
                            break;
                        }
                    }
                    if(!$flag)
                    {
                        $barang[$i]['nama'] = $record->detail_item->detail_item->item_detail->nama;
                        $barang[$i]['satuan'] = $record->detail_item->detail_item->item_detail->satuan;
                        if(empty($record->alasan_ditolak))
                        $barang[$i]['dikasih'] = $record->jumlah;
                        else
                        $barang[$i]['dikasih'] =null;

                        $barang[$i]['kadaluarsa'] = $record->detail_item->kadaluarsa;
                        $barang[$i]['minta'] = '-';
                        $i++;
                    }
                }
            }   
        }
        else
        {
            if($distribusi->tipe == 1)
            {
                foreach ($distribusi->distribusi_detail->log as $record)
                {
                    $barang[$i]['nama'] = $record->detail_item->detail_item->item_detail->nama;
                    $barang[$i]['satuan'] = $record->detail_item->detail_item->item_detail->satuan;
                    if(empty($record->alasan_ditolak))
                    $barang[$i]['dikasih'] = $record->jumlah;
                    else
                    $barang[$i]['dikasih'] = null;

                    $barang[$i]['kadaluarsa'] = $record->detail_item->kadaluarsa;
                    $barang[$i]['minta'] = '-';
                    $i++;
                }
            }
            else
            {
                foreach ($distribusi->log as $record)
                {
                    $barang[$i]['nama'] = $record->detail_item->detail_item->item_detail->nama;
                    $barang[$i]['satuan'] = $record->detail_item->detail_item->item_detail->satuan;
                    if(empty($record->alasan_ditolak))
                    $barang[$i]['dikasih'] = $record->jumlah;
                    else
                    $barang[$i]['dikasih'] = null;

                    $barang[$i]['kadaluarsa'] = $record->detail_item->kadaluarsa;
                    $barang[$i]['minta'] = '-';
                    $i++;
                }
            }
        }
        $data['barang'] = $barang;
        // dd($data);
        $pdf = DOMPDF::loadView('farmasi.distribusi.print',$data);
        return $pdf->stream('DistribusiPermintaan.pdf');
    }

	public function printNota(Request $request)
	{
		$pdf = DOMPDF::loadView('farmasi.item.print-nota');
        return $pdf->stream('nota.pdf');
	}
}