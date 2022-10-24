<?php

namespace App\Http\Controllers\Farmasi\Items;

use App\Exports\Farmasi\BarangLowStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use Yajra\DataTables\DataTables;

class ViewController extends Controller
{
	public function index($farmasi, Request $request)
	{
		if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

		$farm = session('farmasi');
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $satuan = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();

        $data['lokasi'] = Lokasi::all();
        $data['sidebar_active'] = "item";
        $data['gorilla'] = $kategori;
        $data['farmasi'] = $farm;

		// $data['nama_barang'] = $request->nama_barang;
        // $data['stok_minimal'] = $request->stok_minimal;
        // $data['stok_maksimal'] = $request->stok_maksimal;
        // $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        // $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        // $data['kategori'] = $request->kategori;
        $data['satuan'] = $satuan;

		return view('farmasi.item.index', $data);
	}

    public function loadDataIndex($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        $farmid = $request->farmid;
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getDataIndex($farmid, $request);
        
        try {
            return DataTables::of($items)
            ->addColumn('rownum', function($items) use (&$rowNum) {
                return ++$rowNum.'<input type="hidden" value="'.$items->slug.'">';
			})
            ->addColumn('nama', function($items){
                $flag=0;
                $stok_low = "";
                $inline = "";
                $expired_soon = "";
                if($items->min_stok >= $items->stok) {
                    $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>'; 
                    $flag=1;
                }
                if(!$items->expired_day) {}
                else if($items->min_kadaluarsa > $items->expired_day){
                    if($flag) {
                        $inline = '<p class="inline">-</p>';
                    }
                    $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
                }
				$content = '<p class="font-w600 mb-0">'.$items->item_detail->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'';
                return $content;
            })
            ->editColumn('stok', function($items){
                $content = $items->stok ?? '-';
                return $content;
            })
            ->editColumn('harga', function($items){
                $content = 'Rp. '.number_format($items->item_detail->harga);
                return $content;
            })
            ->editColumn('expired', function($items){
                $content = $items->expired ?? '-';
				return $content;
			})
			->editColumn('kategori', function($items){
                $kategori = [];
                foreach($items->item_detail->kategori_item as $gori) {
                    $kategori[] = '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span>';
                }
				return $kategori;
			})
            ->addColumn('detail', function($items) use ($farmasi){
				$content = '
				<a href="javascript:void(0)" onclick="popupwindow('."'".url('farmasi/item/stok/'.$items->id)."'".')" class="btn btn-warning">Stok Semua Farmasi</a>
				<a href="'.url('farmasi/'.$farmasi.'/item/'.$items->slug).'" class="btn btn-primary">Detail</a>            
                ';
				return $content;
            })->escapeColumns([])
            ->make(true);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function expired($farmasi, Request $request)
    {
        if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $kategori = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllKategori();
        $data['lokasi'] = Lokasi::all();
        $data['sidebar_active'] = "item_exp";
        $data['gorilla'] = $kategori;
        $data['farmasi'] = $farm;

        $data['nama_barang'] = $request->nama_barang;
        $data['stok_minimal'] = $request->stok_minimal;
        $data['stok_maksimal'] = $request->stok_maksimal;
        $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        $data['kategori'] = $request->kategori;
        //dd($data);

        return view('farmasi.item.expired', $data);
    }

    public function loadExp(Request $request)
    {
        ini_set('max_execution_time', 300);
        $limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;
        $first = null;
        $data = array();
        $farmasi = $request->farmasi;
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemWithWarningExp($farm->id);
        // dd($items);
        $totalData = intval(count($items));

        if(empty($searchKey)){
            $barang = $request->nama_barang;
            $stok_min = $request->stok_minimal;
            $stok_max = $request->stok_maksimal;
            $harga_min = $request->harga_barang_minimal;
            $harga_max = $request->harga_barang_maksimal;
            $kategori = $request->kategori;
            $warning_stok = "false";
            $warning_kadaluarsa = "true";

            $getItemsPerPage = app('App\Http\Controllers\Farmasi\Items\ReadController')
                            ->filteredData($farm->id, $limit, $start, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa);
            $totalFiltered = $getItemsPerPage->count;
        }
        $flag=0;
        //$totalFiltered = 0;
        //dd($getItemsPerPage);
        foreach($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = [];
            $stok_low = "";
            $inline = "";
            $expired_soon = "";
            
            foreach($row->item_detail->kategori_item as $gori) {
                $category[] = '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span>';
            }

            if($row->min_stok > $row->stok) {
                $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>'; 
                $flag=1;
            }
            
            if(!$row->expired_day) {}
            else if($row->min_kadaluarsa > $row->expired_day){
                if($flag) {
                    $inline = '<p class="inline">-</p>';
                }
                $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
            }

            $flag=0;

            $data[] = [
                $no.'<input type="hidden" value="'.$row->slug.'">',
                '<p class="font-w600 mb-0">'.$row->item_detail->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'',
                $row->stok,
                'Rp. '.number_format($row->item_detail->harga),
                $row->expired,
                $category,
                '<a href="'.url('farmasi/'.$farmasi.'/item/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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

    public function stokkosong($farmasi, Request $request)
    {
        if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $kategori = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllKategori();
        $data['lokasi'] = Lokasi::all();
        $data['sidebar_active'] = "item_stok";
        $data['gorilla'] = $kategori;
        $data['farmasi'] = $farm;

        $data['nama_barang'] = $request->nama_barang;
        $data['stok_minimal'] = $request->stok_minimal;
        $data['stok_maksimal'] = $request->stok_maksimal;
        $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        $data['kategori'] = $request->kategori;
        //dd($data);

        return view('farmasi.item.stokkosong', $data);
    }

    public function loadStok(Request $request)
    {
        ini_set('max_execution_time', 300);
        $limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;
        $first = null;
        $data = array();
        $farmasi = $request->farmasi;
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);

        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemWithWarningStok($farm->id);
        // dd($items);
        $totalData = intval(count($items));

        if(empty($searchKey)){
            $barang = $request->nama_barang;
            $stok_min = $request->stok_minimal;
            $stok_max = $request->stok_maksimal;
            $harga_min = $request->harga_barang_minimal;
            $harga_max = $request->harga_barang_maksimal;
            $kategori = $request->kategori;
            $warning_stok = "true";
            $warning_kadaluarsa = "false";

            $getItemsPerPage = app('App\Http\Controllers\Farmasi\Items\ReadController')
                            ->filteredData($farm->id, $limit, $start, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa);
            $totalFiltered = $getItemsPerPage->count;
        }
        $flag=0;
        //$totalFiltered = 0;
        //dd($getItemsPerPage);
        foreach($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = [];
            $stok_low = "";
            $inline = "";
            $expired_soon = "";
            
            foreach($row->item_detail->kategori_item as $gori) {
                $category[] = '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span>';
            }

            if($row->min_stok > $row->stok) {
                $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>'; 
                $flag=1;
            }
            
            if(!$row->expired_day) {}
            else if($row->min_kadaluarsa > $row->expired_day){
                if($flag) {
                    $inline = '<p class="inline">-</p>';
                }
                $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
            }

            $flag=0;

            $data[] = [
                $no.'<input type="hidden" value="'.$row->slug.'">',
                '<p class="font-w600 mb-0">'.$row->item_detail->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'',
                $row->stok,
                'Rp. '.number_format($row->item_detail->harga),
                $row->expired,
                $category,
                '<a href="'.url('farmasi/'.$farmasi.'/item/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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

	public function single($farmasi, $slug)
	{
		$farm = session('farmasi');
		$item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemDetail($slug);
        $active = app('App\Http\Controllers\Farmasi\Items\ReadController')->getActiveItemList($farmasi, $item->id);
        $tipe = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $satuan = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        foreach ($kategori as $gori) {
            if(isset($item->item_detail->detail_kategori) 
                && count($item->item_detail->detail_kategori->where('kategori_id',$gori->id))) 
                $gori->selected = 1;
        }
        $data['kategori'] = $kategori;
        $data['satuan'] = $satuan;
        $data['item'] = $item;
        $data['tipe'] = $tipe;
        $data['active'] = $active;
        $data['total_active'] = $active->count();
        $data['farmasi'] = $farm;
		$data['sidebar_active'] = "";
        $data['lokasi'] = Lokasi::all();
        $data['date_range_start_month_default'] = Carbon::now()->subDays(7);
        $data['date_range_end_month_default'] = Carbon::now();;
        // dd($item);

		return view('farmasi.item.detail', $data);	
	}

    public function allStok($item_id)
    {
        $item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemById($item_id);
        $stok = app('App\Http\Controllers\Farmasi\Items\ReadController')->getAllStok($item_id);
        
        $data['stok'] = $stok;
        $data['item'] = $item;
        $data['lokasi'] = Lokasi::all();

        return view('farmasi.item.stok', $data);  
    }

    public function filterExpired($farmasi, Request $request)
    {
        $farm = session('farmasi');
        $batas_hari = $request->batas_hari ?? 30; 
        $data['data'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->filterExpiredItems($farm->id,$batas_hari);
        $data['sidebar_active'] = "";
        $data['batas_hari'] = $batas_hari;
        $data['farmasi'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();

        return view('farmasi.item.filter.expired-items', $data);  
    }

    public function filterLowStock($farmasi, Request $request)
    {
        $farm = session('farmasi');
        $data['data'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->filterLowStockItems($farm->id);
        $data['sidebar_active'] = "";
        $data['farmasi'] = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAllWithHidden();

        return view('farmasi.item.filter.low-stock-items', $data);  
    }
    
    public function lowStockExport($farmasi, Request $request)
    {
        $farm = session('farmasi');
        $data['data'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->filterLowStockItems($farm->id)->sortBy('item_template.nama');
        $filename = "Barang Low Stok - ".$farm->nama;
        
        return (new BarangLowStock($data))->download($filename.'.xlsx');
    }
}