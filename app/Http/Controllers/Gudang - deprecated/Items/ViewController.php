<?php

namespace App\Http\Controllers\Gudang\Items;

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

        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $satuan = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        $data['sidebar_active'] = "item";
        $data['gorilla'] = $kategori;
        $data['satuan'] = $satuan;
        $data['nama_barang'] = $request->nama_barang;
        $data['stok_minimal'] = $request->stok_minimal;
        $data['stok_maksimal'] = $request->stok_maksimal;
        $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        $data['kategori'] = $request->kategori;
        $data['warning_stok'] = $request->warning_stok;
        $data['warning_kadaluarsa'] = $request->warning_kadaluarsa;

        if($request->nama_barang) $data['barang'] = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemById($request->nama_barang);

        return view('warehouse.item.index2',$data);
    }

    public function single($slug)
    {
        $item = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemDetail($slug);
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemList($item->slug,0);
        $active = app('App\Http\Controllers\Gudang\Items\ReadController')->getActiveItemList($item->id);
        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $satuan = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
        foreach ($kategori as $gori) {
            if(count($item->items_category->where('kategori_id',$gori->id))) $gori->selected = 1;
        }
        $data['sidebar_active'] = "item";
        $data['gorilla'] = $kategori;
        $data['satuan'] = $satuan;
        $data['item'] = $item;
        $data['items'] = $items;
        $data['active'] = $active;
        $data['total_items'] = $items->count;
        $data['total_active'] = $active->count();
        
        return view('warehouse.item.detail2',$data);
    }

    public function allStok($item_id)
    {
        $item = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemById($item_id);
        $stok = app('App\Http\Controllers\Gudang\Items\ReadController')->getAllStok($item_id);
        
        $data['stok'] = $stok;
        $data['item'] = $item;

        return view('farmasi.item.stok', $data);  
    }

    public function loadData(Request $request)
    {
        ini_set('max_execution_time', 300);
        $limit = intval($request->length);
        $start = intval($request->start);
        $draw = intval($request->draw);
        $searchKey = $request->search['value'];
        $no = $start;
        $first = null;
        $data = array();

        $totalData = app('App\Http\Controllers\Gudang\Items\ReadController')->countAll();
     
        if(empty($searchKey)){
            $barang = $request->nama_barang;
            $stok_min = $request->stok_minimal;
            $stok_max = $request->stok_maksimal;
            $harga_min = $request->harga_barang_minimal;
            $harga_max = $request->harga_barang_maksimal;
            $kategori = $request->kategori;
            $warning_stok = false;
            $warning_kadaluarsa = false;
            $getItemsPerPage = app('App\Http\Controllers\Gudang\Items\ReadController')
                            ->filteredData($limit, $start, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa);
            $totalFiltered = $getItemsPerPage->count;
        }
        $flag=0;
        foreach($getItemsPerPage as $row) {
            $no++;
            $category = "";
            $stok_low = "";
            $inline = "";
            $expired_soon = "";
            
            foreach($row->items_category as $gori) {
                $category .= '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span> ';
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
                '<p class="font-w600 mb-0">'.$row->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'',
                $row->stok.' '.($row->satuan ?? ''),
                'Rp. '.number_format($row->harga),
                $row->expired,
                $category,
                '<a href="'.url('gudang/item/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
            ];
        }

        $json_data = array(
            "draw"            => $draw,
            "recordsTotal"    => $totalData,  
            "recordsFiltered" => $totalFiltered, 
            "data"            => $data,
            'start'           => $start,
            'length'          => $limit
        );
        
        return json_encode($json_data);
    }

    public function expired(Request $request)
    {
        if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $data['sidebar_active'] = "item_exp";
        $data['gorilla'] = $kategori;
        // dd($data['item'][0]->items_category);
        $data['nama_barang'] = $request->nama_barang;
        $data['stok_minimal'] = $request->stok_minimal;
        $data['stok_maksimal'] = $request->stok_maksimal;
        $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        $data['kategori'] = $request->kategori;

        return view('warehouse.item.expired',$data);
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

        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemWithWarningExp();
        // dd($pengadaan);
        $totalData = intval(count($items));

        if(empty($searchKey)){
            $barang = $request->nama_barang;
            $stok_min = $request->stok_minimal;
            $stok_max = $request->stok_maksimal;
            $harga_min = $request->harga_barang_minimal;
            $harga_max = $request->harga_barang_maksimal;
            $kategori = $request->kategori;
            $warning_stok = false;
            $warning_kadaluarsa = true;

            $getItemsPerPage = app('App\Http\Controllers\Gudang\Items\ReadController')
                            ->filteredData($limit, $start, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa);
            $totalFiltered = $getItemsPerPage->count;
        }
        $flag=0;
        //$totalFiltered = 0;
        foreach($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = "";
            $stok_low = "";
            $inline = "";
            $expired_soon = "";
            
            foreach($row->items_category as $gori) {
                $category .= '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span> ';
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
                '<p class="font-w600 mb-0">'.$row->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'',
                $row->stok,
                'Rp. '.number_format($row->harga),
                $row->expired,
                $category,
                '<a href="'.url('gudang/item/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
            ];
        }

        $json_data = array(
            "draw"            => $draw,
            "recordsTotal"    => $totalData,  
            "recordsFiltered" => $totalFiltered, 
            "data"            => $data,
            'start'           => $start,
            'length'          => $limit
        );
        
        return json_encode($json_data);
    }

    public function stokkosong(Request $request)
    {
        if ($request->isMethod('post')) {
            session($request->except('_token'));
        }

        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $data['sidebar_active'] = "item_stok";
        $data['gorilla'] = $kategori;
        // dd($data['item'][0]->items_category);
        $data['nama_barang'] = $request->nama_barang;
        $data['stok_minimal'] = $request->stok_minimal;
        $data['stok_maksimal'] = $request->stok_maksimal;
        $data['harga_barang_minimal'] = $request->harga_barang_minimal;
        $data['harga_barang_maksimal'] = $request->harga_barang_maksimal;
        $data['kategori'] = $request->kategori;

        return view('warehouse.item.stokkosong',$data);
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

        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemWithWarningStok();
        $totalData = intval(count($items));

        if(empty($searchKey)){
            $barang = $request->nama_barang;
            $stok_min = $request->stok_minimal;
            $stok_max = $request->stok_maksimal;
            $harga_min = $request->harga_barang_minimal;
            $harga_max = $request->harga_barang_maksimal;
            $kategori = $request->kategori;
            $warning_stok = true;
            $warning_kadaluarsa = false;

            $getItemsPerPage = app('App\Http\Controllers\Gudang\Items\ReadController')
                            ->filteredData($limit, $start, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa);
            $totalFiltered = $getItemsPerPage->count;
        }
        $flag=0;
        //$totalFiltered = 0;
        foreach($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = "";
            $stok_low = "";
            $inline = "";
            $expired_soon = "";
            
            foreach($row->items_category as $gori) {
                $category .= '<span class="badge badge-primary">'.$gori->detail_kategori->nama.'</span> ';
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
                '<p class="font-w600 mb-0">'.$row->nama.'</p>'.$stok_low.''.$inline.''.$expired_soon.'',
                $row->stok,
                'Rp. '.number_format($row->harga),
                $row->expired,
                $category,
                '<a href="'.url('gudang/item/'.$row->slug).'" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
            ];
        }

        $json_data = array(
            "draw"            => $draw,
            "recordsTotal"    => $totalData,  
            "recordsFiltered" => $totalFiltered, 
            "data"            => $data,
            'start'           => $start,
            'length'          => $limit
        );
        
        // dd($json_data);
        return json_encode($json_data);
    }

    /*public function index(Request $request)
    {
        $items = app('App\Http\Controllers\Warehouse\Items\ReadController')->getPage(0);
        $items =  json_decode($items);
        $data['items'] = $items->data;
        $data['count'] = $items->count;
        $data['categories'] = $items->categories;
        $data['report'] = NULL;
        $data['routeFlag'] = 3;
        if($request->session()->has('report'))
            $data['report'] = $request->session()->get('report');
        return view('warehouse.item.index',$data);
    }

    public function create() {
        $supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getAll();
        $supplier =  json_decode($supplier);
        $data['supplier'] = $supplier->data;
        $data['routeFlag'] = 3; 

        return view('warehouse.item.create', $data);
    }*/

    public function log() {
        $log = app('App\Http\Controllers\Warehouse\ItemsLog\ReadController')->getPage(0);
        $log =  json_decode($log);
        $data['log'] = $log->data;
        $data['count'] = $log->count;

        $supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getAll();
        $supplier =  json_decode($supplier);
        $data['supplier'] = $supplier->data;

        $apotek = app('App\Http\Controllers\Apotek\Pharmacy\ReadController')->getAll();
        $apotek =  json_decode($apotek);
        $data['apotek'] = $apotek->data;

        $barang = app('App\Http\Controllers\Warehouse\Items\ReadController')->getAll();
        $barang =  json_decode($barang);
        $data['barang'] = $barang->data;
        $data['routeFlag'] = 3; 
        //dd($data);

        return view('warehouse.item.log', $data);
    }

    public function getSingle(Request $request, $slug) {
        $items = app('App\Http\Controllers\Warehouse\Items\ReadController')->getItemDetail($slug);
        $items =  json_decode($items);
        $history = app('App\Http\Controllers\Warehouse\ItemsLog\ReadController')->getItemLog($items->data->id,0);        
        $history =  json_decode($history);
        $available = app('App\Http\Controllers\Warehouse\ItemsLog\ReadController')->getAvailable($items->data->id,0);        
        $available =  json_decode($available);

        if(!$items)
        {
            $request->session()->flash('report', 'Maaf Barang Tidak Ada / Sudah Dihapus');
            return redirect('warehouse/item');
        }
        $data['items'] = $items->data;
        $data['history'] = $history->data;
        $data['count'] = $history->count;
        $data['available'] = $available->data;
        $data['coent'] = $available->count;
        $data['report'] = NULL;
        if($request->session()->has('report'))
            $data['report'] = $request->session()->get('report');
        $data['routeFlag'] = 3; 
        //dd($data);

        return view('warehouse.item.detail',$data);
    }

    public function editSingle(Request $request, $slug) {

        $supplier = app('App\Http\Controllers\Warehouse\Supplier\ReadController')->getAll();
        $supplier =  json_decode($supplier);
        $data['supplier'] = $supplier->data;

        $items = app('App\Http\Controllers\Warehouse\Items\ReadController')->getItemDetail($slug);
        $items =  json_decode($items);
        if(!$items)
        {
            $request->session()->flash('report', 'Maaf Barang Tidak Ada / Sudah Dihapus');
            return redirect('warehouse/item');
        }
        $data['items'] = $items->data;
        $data['report'] = NULL;
        if($request->session()->has('report'))
            $data['report'] = $request->session()->get('report');
        $data['routeFlag'] = 3;
        
        return view('warehouse.item.edit',$data);
    }

    public function search(Request $request) {
        $items = app('App\Http\Controllers\Warehouse\Items\ReadController')->getItemSearch($request);
        $items = json_decode($items);
        $data['items'] = $items->data;
        $data['report'] = NULL;
        $request->flash();
        return view('warehouse.item.index', $data);
    }

    public function tes(Request $request) {
        ini_set('max_execution_time', 30000);
        app('App\Http\Controllers\Farmasi\Items\CreateController')->check();
    }
}
