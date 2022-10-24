<?php

namespace App\Http\Controllers\Gudang\Items;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Gudang\Items;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\LogDistribusi;
use App\Models\Gudang\LogPenghapusan;
use App\Models\Gudang\LogPengadaan;
use App\Models\Gudang\Kategori;
use App\Models\Farmasi\ItemsFarmasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime, stdClass;

class ReadController extends Controller
{
    public function getAll()
	{
		$items = ItemsTemplate::with('stok')->orderBy('nama', 'asc')->get();
        //$count = count(Items::all());
		return $items;
	}

    public function countAll()
    {
        return ItemsTemplate::count();
    }

    public function getAllItems()
    {
        $items = Items::with(['detail_item'])->where('jumlah','!=',0)->where('kadaluarsa', '>' , Carbon::today())->latest()->get();
        return $items;
    }

    public function getItemById($item_id)
    {
        $item = ItemsTemplate::with('stok')->find($item_id);

        return $item;
    }

    public function getAllStok($item_id)
    {
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $stok = array();
        $i=1;

        $temp = ItemsTemplate::with('stok')->find($item_id);
        $stok[0]['farmasi'] = 'Gudang';
        $stok[0]['stok'] = $temp ? $temp->stok : '-';

        foreach ($pharmacy as $pharm) {
            $item = ItemsFarmasi::where('item_template_id',$temp->id)->where('farmasi_id', $pharm->id)->first();
            $stok[$i]['farmasi'] = $pharm->nama;
            $stok[$i]['stok'] = $item ? $item->stok : '-';
            $i++;
        }

        return $stok;            
    }

    public function getPerPage($limit, $offset)
    {
        $func = function($value) {
            return $value->id;
        };
        
        $query = DB::connection('gudang')->select('SELECT id FROM item_template WHERE id IN 
                        (SELECT item.id FROM (SELECT item_template_id AS id, SUM(jumlah) AS stok FROM items WHERE kadaluarsa > CURRENT_TIMESTAMP() AND deleted_at IS NULL GROUP BY item_template_id) AS item WHERE item.stok >= 1)');
        $id = array_map($func, $query);
        
        $items = ItemsTemplate::with('stok')->whereIn('id',$id)->orderBy('nama', 'asc')->limit($limit)->offset($offset)->get();
        return $items;
    }

    public function getByPengadaan($pengadaan_id)
    {
        $items = Items::where('pengadaan_id', $pengadaan_id)->get();
        //$count = count(Items::all());
        return $items;
    }

    public function getByPenghapusan($penghapusan_id)
    {
        $items = LogPenghapusan::with('detail_item.detail_item')->where('penghapusan_id', $penghapusan_id)->get();
        //$count = count(Items::all());
        return $items;
    }

	public function getItemDetail($item_slug)
	{

        $item = ItemsTemplate::with('stok')->where('slug', $item_slug)->first();

		return $item;
	}

    public function getItems(Request $request)
    {
        $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
        if($search == "NOT")    $search = strtolower($search);
        $jenis = $request->get('jenis') ? $request->get('jenis') : 0;
                
        if(!empty($search)) {
            if($jenis) {
                $item = ItemsTemplate::search($search)->rule(\App\SearchRule\FarmasiItems::class)->with('stok')->where('jenis',$jenis)->paginate(20);
            }
            else $item = ItemsTemplate::search($search)->rule(\App\SearchRule\FarmasiItems::class)->with('stok')->paginate(20);
        }
        else
            $item = ItemsTemplate::with('stok')->latest()->paginate(20);
        // dd($item);
        return $item;
    }

    public function getItemList($slug, $page)
    {
        $item = ItemsTemplate::with('stok')->where('slug', $slug)->first();
        $item_id = $item->id;
        $pengadaan = LogPengadaan::whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->with('detail_pengadaan.supplier_detail')->latest()->get();
        $distribusi = LogDistribusi::where('jenis',1)->whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->with('detail_distribusi.farmasi_detail')->latest()->get();
        $penghapusan = LogPenghapusan::whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->with('detail_penghapusan')->latest()->get();

        $items = $distribusi->concat($penghapusan)->concat($pengadaan)->sortByDesc('created_at');
        //dd($items);
        
        $count = $items->count();
        if($count == 0) 
        {
            $items->count = $count;
            return $items;
        }
        $items = $items->chunk(10);
        $items[$page]->count = $count;
        //dd($items[$page]);

        return $items[$page];
    }

    public function getActiveItemList($item_id)
    {
        //$item = Items::where('item_template_id', $item_id)->where('kadaluarsa','>',Carbon::today())->latest()->get();
        $item = Items::where('item_template_id', $item_id)->where('jumlah','!=',0)->orderBy('kadaluarsa','asc')->get();

        return $item;
    }

    public function getAllKategori()
    {
        $item = Kategori::groupBy('nama')->latest()->get();

        return $item;
    }

    public function getItemWithStok()
    {
        $func = function($value) {
            return $value->id;
        };

        $query = DB::connection('gudang')->select('SELECT id FROM item_template WHERE id IN 
                        (SELECT item.id FROM (SELECT item_template_id AS id, SUM(jumlah) AS stok FROM items WHERE kadaluarsa > CURRENT_TIMESTAMP() AND deleted_at IS NULL GROUP BY item_template_id) AS item WHERE item.stok >= 1)');
        $id = array_map($func, $query);
        $item = ItemsTemplate::with('stok', 'stok_kadaluarsa')->whereIn('id',$id)->orderBy('nama', 'asc')->get();

        return $item;
    }

    public function getItemWithWarningExp()
    {
        $func = function($value) {
            return $value->id;
        };

        $query = DB::connection('gudang')->select('SELECT * FROM item_template WHERE id IN
            (SELECT item.id FROM
            (SELECT item_template.id, item_template.min_kadaluarsa, DATEDIFF(MIN(items.kadaluarsa),CURDATE()) AS expired FROM items,item_template WHERE items.jumlah > 0 AND items.kadaluarsa > CURDATE() AND items.deleted_at IS NULL AND items.item_template_id = item_template.id GROUP BY item_template.id) AS item WHERE item.min_kadaluarsa > item.expired)');
            $id = array_map($func, $query);
        $item = ItemsTemplate::with('stok')->whereIn('id',$id)->orderBy('nama', 'asc')->get();

        return $item;
            
    }

    public function getItemWithWarningStok()
    {
        $func = function($value) {
            return $value->id;
        };

        $query = DB::connection('gudang')->select('SELECT * FROM item_template WHERE id IN 
                        (SELECT item.id FROM 
                        (SELECT item_template.id, item_template.min_stok, SUM(items.jumlah) AS stok FROM items, item_template WHERE items.kadaluarsa > CURRENT_TIMESTAMP() AND items.deleted_at IS NULL AND items.item_template_id = item_template.id GROUP BY item_template.id) AS item WHERE item.stok < item.min_stok)');
        $id = array_map($func, $query);
        $item = ItemsTemplate::with('stok')->whereIn('id',$id)->orderBy('nama', 'asc')->get();

        return $item;
            
    }
    
    public function filteredData($limit, $offset, $barang, $stok_min, $stok_max, $harga_min, $harga_max, $kategori, $warning_stok, $warning_kadaluarsa)
    {
        $flag = 0;
        $barang = preg_replace("/[^[:alnum:][:space:]]/u", '', $barang);
        if($barang) 
        {
            $item = ItemsTemplate::search($barang)->with(['stok', 'items_category']);
        }else{
            $item = ItemsTemplate::with(['stok', 'items_category'])->whereHas('stok')->orderBy('nama', 'asc');
        }

        if(isset($harga_min)){
            $item->where('harga', '>=', $harga_min);
        }

        if(isset($harga_max)){
            $item->where('harga', '<=', $harga_max);
        }
        $item = $item->get();


        $i = 0;
        $filtered =  $item->filter(function($val, $key) use($kategori, $harga_min, $harga_max, $stok_min, $stok_max, $warning_stok, $warning_kadaluarsa){
            // dd($val);
            // if(isset($harga_min) && !($val->harga > $harga_min)){
            //     return false;
            // }

            // if(isset($harga_max) && ($val->harga < $harga_max)){
            //     return false;
            // }

            if(isset($stok_min) && !($val->stok > $stok_min)){
                return false;
            }

            if(isset($stok_max) && !($val->stok < $stok_max)){
                return false;
            }

            if(isset($kategori)){
                $filter_kategori = true;
                $kategori = explode(",", $kategori);
                if(!$val->items_category->isEmpty()){
                    $cat_array = array_map(function($v){
                        return $v['kategori_id'];
                    }, $val->items_category->toArray());
                    foreach ($kategori as $kat) {
                        $found = array_search($kat, $cat_array, false);
                        // dd($kat, $cat_array, $found);
                        $filter_kategori = ($found != NULL || $found !== FALSE);
                    }
                        return $filter_kategori;
                }else{
                    return false;
                }
            }

            // dd($filter_kategori && $filter_stok_max && $filter_stok_min &&
            //         $filter_harga_max && $filter_harga_min && $filter_stok && $filter_kadaluarsa, $val);

           
            if(isset($warning_stok) && $warning_stok)
            {
                return $val->min_stok > $val->stok;
            }

            if(isset($warning_kadaluarsa) && $warning_kadaluarsa)
            {
                return $val->min_kadaluarsa > $val->expired_day;
            }

            return true;

        });
        $count= count($filtered);
        $filtered = $filtered->forPage(($offset/$limit)+1, $limit);
        $filtered->count = $count;
        return $filtered;
    }

    public function getStatistik()
    {
        $day = Carbon::now();
        
        $kategori = Kategori::groupBy('slug')
                    ->get(array(
                            DB::raw('nama'),
                            DB::raw('COUNT(*) as "kategori_count"')
                        ));

        $stats = new stdClass();
        $stats->kategori = $kategori;

        $item = ItemsTemplate::with('stok')->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->item = $item->count();

        return $stats;
    }

    public function getKartuStok($item_id,$tgl_awal,$tgl_akhir)
    {
        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        $pengadaan = LogPengadaan::whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->whereBetween('tanggal', [$min_date, $max_date])->get();
        $distribusi = LogDistribusi::where('jenis',1)->whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->whereBetween('created_at', [$min_date, $max_date])->get();
        $penghapusan = LogPenghapusan::whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->whereBetween('created_at', [$min_date, $max_date])->get();

        $items = $distribusi->concat($pengadaan)->concat($penghapusan)->sortBy('created_at');

        //Stok Awal
        $item_awal = LogPengadaan::whereHas('detail_item', function($det) use($item_id){
                            $det->where('item_template_id', $item_id);
                        })->whereDate('tanggal','<',$min_date)->get();
        $items->stok_awal = $item_awal->sum('jumlah');
        $minus = LogDistribusi::where('jenis',1)->whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item_id){
                $cat->where('item_template_id', $item_id);
            })->whereHas('detail_distribusi', function($cat) use($item_id){
                $cat->where('tipe', -1);
            });
        $plus = LogDistribusi::where('jenis',1)->whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item_id){
                $cat->where('item_template_id', $item_id);
            })->whereHas('detail_distribusi', function($cat) use($item_id){
                $cat->where('tipe', 1);
            });
        $hapus = LogPenghapusan::whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item_id){
                $cat->where('item_template_id', $item_id);
            });
        //if($item->id == 6) dd($item->stok_awal);
        $items->stok_awal -= $minus->sum('jumlah');
        $items->stok_awal += $plus->sum('jumlah');
        $items->stok_awal -= $hapus->sum('jumlah');
        
        return $items;
    }

    public function getKegiatanKesehatan($tgl_awal,$tgl_akhir)
    {
        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        $items = $this->getItemWithStok();

        $query_awal = "SELECT id, SUM(jumlah_plus-jumlah_min) AS jumlah_awal FROM 
                (
                    SELECT  it.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_penghapusan ld, penghapusan d, items i, item_template it
                    WHERE d.id = ld.penghapusan_id
                    AND i.id = ld.item_id
                    AND i.item_template_id = it.id
                    AND DATE(d.created_at) < DATE('".$min_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id
                    
                    UNION ALL
                    
                    SELECT  it.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_pengadaan ld, pengadaan d, items i, item_template it
                    WHERE d.id = ld.pengadaan_id
                    AND i.id = ld.item_id
                    AND i.item_template_id = it.id
                    AND DATE(d.created_at) < DATE('".$min_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id 
                    
                    UNION ALL
                    
                    SELECT  it.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, item_template it
                    WHERE d.id = ld.distribusi_id
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_template_id = it.id
                    AND i.id = ld.item_id
                    AND DATE(d.created_at) < DATE('".$min_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id 
                    UNION ALL
                    
                    SELECT  it.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, item_template it
                    WHERE d.id = ld.distribusi_id
                    AND d.tipe = 1
                    AND ld.jenis = 1
                    AND i.item_template_id = it.id
                    AND i.id = ld.item_id
                    AND DATE(d.created_at) < DATE('".$min_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id 
                ) hasil
                GROUP BY id
                HAVING COUNT(DISTINCT nama) < 4";
            // dd(DB::raw($query_awal));
        $res = DB::connection('gudang')->select(DB::raw($query_awal));
        $awal = [];
        foreach ($res as $value) {
            $awal[$value->id] = $value->jumlah_awal;
        }


        $query = "SELECT id, SUM(jumlah_plus) AS jumlah_plus, SUM(jumlah_min) AS jumlah_min FROM 
                (
                    SELECT  it.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_penghapusan ld, penghapusan d, items i, item_template it
                    WHERE d.id = ld.penghapusan_id
                    AND i.id = ld.item_id
                    AND i.item_template_id = it.id
                    AND DATE(d.created_at) >= DATE('".$min_date."')
                    AND DATE(d.created_at) <= DATE('".$max_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY i.id
                    
                    UNION ALL
                    
                    SELECT  it.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_pengadaan ld, pengadaan d, items i, item_template it
                    WHERE d.id = ld.pengadaan_id
                    AND i.id = ld.item_id
                    AND i.item_template_id = it.id
                    AND DATE(d.created_at) >= DATE('".$min_date."')
                    AND DATE(d.created_at) <= DATE('".$max_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY i.id 
                    
                    UNION ALL
                    
                    SELECT  it.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, item_template it
                    WHERE d.id = ld.distribusi_id
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_template_id = it.id
                    AND i.id = ld.item_id
                    AND DATE(d.created_at) >= DATE('".$min_date."')
                    AND DATE(d.created_at) <= DATE('".$max_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY i.id 
                    UNION ALL
                    
                    SELECT  it.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, item_template it
                    WHERE d.id = ld.distribusi_id
                    AND d.tipe = 1
                    AND ld.jenis = 1
                    AND i.item_template_id = it.id
                    AND i.id = ld.item_id
                    AND DATE(d.created_at) >= DATE('".$min_date."')
                    AND DATE(d.created_at) <= DATE('".$max_date."')
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY i.id 
                ) hasil
                GROUP BY id
                HAVING COUNT(DISTINCT nama) < 4";
            // dd(DB::raw($query_awal));
        $res_sekarang = DB::connection('gudang')->select(DB::raw($query));
        $sekarang = [];
        foreach ($res_sekarang as $value) {
            $sekarang[$value->id] = (object)[
                                        'jumlah_min' => $value->jumlah_min,
                                        'jumlah_plus' => $value->jumlah_plus
                                    ];
        }


        return ['awal' => $awal, 'sekarang' => $sekarang, 'items' => $items];
    }

    public function getNarkotika($tgl_awal,$tgl_akhir,$kategori)
    {
        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        if($kategori) $items = ItemsTemplate::with('stok')->whereHas('items_category', function($cat) use($kategori){
                    $cat->whereIn('kategori_id', $kategori);
                })->orderBy('satuan', 'asc')->orderBy('nama', 'asc')->get();
        else $items = $this->getItemWithStok();//ItemsTemplate::with('stok')->orderBy('satuan', 'asc')->orderBy('nama', 'asc')->get();

        $arr = array();
        foreach($items as $item) {
            if(!$item->stok) continue;
            $stok_item = LogPengadaan::whereHas('detail_item', function($det) use($item){
                            $det->where('item_template_id', $item->id);
                        })->whereBetween('tanggal', [$min_date, $max_date])->get();
            $item->kadaluarsa = $stok_item->min('detail_item.kadaluarsa');
            $item->masuk = $stok_item->sum('jumlah');
            $minus = LogDistribusi::where('jenis',1)->whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', -1);
                });
            $plus = LogDistribusi::where('jenis',1)->whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', 1);
                });
            $hapus = LogPenghapusan::whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                });
            $item->keluar = $minus->sum('jumlah');
            $item->masuk += $plus->sum('jumlah');
            $item->hapus = $hapus->sum('jumlah');

            //Stok Awal
            $item_awal = LogPengadaan::whereHas('detail_item', function($det) use($item){
                            $det->where('item_template_id', $item->id);
                        })->whereDate('tanggal','<',$min_date)->get();
            $item->stok_awal = $item_awal->sum('jumlah');
            if(!$item->kadaluarsa) $item->kadaluarsa = $item_awal->min('kadaluarsa');
            $minus = LogDistribusi::where('jenis',1)->whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', -1);
                });
            $plus = LogDistribusi::where('jenis',1)->whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', 1);
                });
            $hapus = LogPenghapusan::whereDate('created_at','<',$min_date)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                });
            //if($item->id == 6) dd($item->stok_awal);
            $item->stok_awal -= $minus->sum('jumlah');
            $item->stok_awal += $plus->sum('jumlah');
            $item->stok_awal -= $hapus->sum('jumlah');

            if($item->stok_awal || $item->masuk || $item->keluar || $item->hapus) array_push($arr,$item);
        }

        return $arr;
    }

    public function getOpname($tanggal)
    {
        //$day = Carbon::now();
        $items = $this->getItemWithStok();//ItemsTemplate::with('stok')->orderBy('satuan', 'desc')->orderBy('nama', 'asc')->get();
        if($tanggal) {
            $tgl_awal = str_replace("/", "-", $tanggal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $tanggal = Carbon::parse($tgl_awal);
            $tanggal = $tanggal->copy()->endOfDay();
        } else $tanggal = Carbon::maxValue();

        $arr = array();
        foreach($items as $item) {
            if(!$item->stok) continue;
            //Stok Awal
            $item_awal = LogPengadaan::whereHas('detail_item', function($det) use($item){
                            $det->where('item_template_id', $item->id);
                        })->whereDate('tanggal','<=',$tanggal)->get();
            $item->stok_awal = $item_awal->sum('jumlah');
            $item->kadal = $item_awal->min('detail_item.kadaluarsa');
            $minus = LogDistribusi::where('jenis',1)->whereDate('created_at','<=',$tanggal)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', -1);
                });
            $plus = LogDistribusi::where('jenis',1)->whereDate('created_at','<=',$tanggal)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                })->whereHas('detail_distribusi', function($cat) use($item){
                    $cat->where('tipe', 1);
                });
            $hapus = LogPenghapusan::whereDate('created_at','<=',$tanggal)->whereHas('detail_item', function($cat) use($item){
                    $cat->where('item_template_id', $item->id);
                });
            //if($item->id == 6) dd($item->stok_awal);
            $item->stok_awal -= $minus->sum('jumlah');
            $item->stok_awal += $plus->sum('jumlah');
            $item->stok_awal -= $hapus->sum('jumlah');

            if($item->stok_awal) array_push($arr,$item);
        }

        return $arr;
    }

    public function getPenerimaan($tgl_awal, $tgl_akhir)
    {
        if($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::minValue();

        if($tgl_akhir){
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::maxValue();

        $items = LogPengadaan::whereBetween('tanggal', [$min_date, $max_date])->orderBy('tanggal','asc')->get();
        //dd($items);
        return $items;
    }

    public function getProduksi(Request $request)
    {
        $barang = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->keyword);
        if($barang) 
        {
            $item = ItemsTemplate::search($barang)->with(['stok', 'items_category'])->whereNotNull('produksi_id');
        }else{
            $item = ItemsTemplate::with(['stok', 'items_category'])->whereHas('stok')->whereNotNull('produksi_id')->orderBy('nama', 'asc');
        }
        return json_encode($item->get());
    }

    public function tes()
    {
        
        $items = ItemsTemplate::with('stok')->search('para')->get();
        $id =   $items->map(function ($item) {
                    return collect($item->toArray())
                        ->only(['id'])
                        ->all();
                });
        $items = ItemsTemplate::with('stok')->whereIn('id',$id)->where('harga', '>', 0)->get();
        $item = $items->filter(function ($value, $key) {
            return $value->min_stok > $value->stok;
        });
        dd($items);

        /*if($stok_min)
        {
            $item->where('stok', '>=', $stok_min);
        }
        if($stok_max)
        {
            $item->where('stok', '<=', $stok_max);
        }
        if($harga_min)
        {
            $item->where('harga', '>=', $harga_min);
        }
        if($harga_max)
        {
            $item->where('harga', '<=', $harga_max);
        }*/
        /*if($input['categories'])
        {
            if(count($input['categories']) > 1)
            {
                $result->whereHas('items_category', function($cat) use($input){
                    $cat->whereBetween('name', $input['categories']);
                });
            }
            else
            {
                $result->whereHas('items_category', function($cat) use($input){
                    $cat->where('name', $input['categories']);
                });
            }
        }*/
        return $item->get();
    }

    public function obatKeluar($tanggal_start, $tanggal_end)
    {
        if($tanggal_end) {
            $end = str_replace("/", "-", $tanggal_end);
            $end = strtotime($end);
            $end = date('m/d/Y', $end);

            $end = Carbon::parse($end);
            $end = $end->copy()->endOfDay();
        } else $end = Carbon::maxValue();

        if($tanggal_start) {
            $start = str_replace("/", "-", $tanggal_start);
            $start = strtotime($start);
            $start = date('m/d/Y', $start);

            $start = Carbon::parse($start);
            $start = $start->copy()->startOfDay();
        } else $start = Carbon::minValue();

        $query = "SELECT i.id, it.nama, it.harga, it.kode, d.farmasi_id, i.kadaluarsa, SUM(ld.jumlah) as jumlah
            FROM log_distribusi ld, distribusi d, items i, item_template it
            WHERE d.id = ld.distribusi_id
            AND d.farmasi_id != 0
            AND i.id = ld.item_id
            AND i.item_template_id = it.id
            AND DATE(d.created_at) >= DATE('".$start."')
            AND DATE(d.created_at) <= DATE('".$end."')
            GROUP BY i.id, it.nama, it.harga, it.kode, d.farmasi_id, i.kadaluarsa
            ORDER BY it.nama";
        $res = DB::connection('gudang')->select(DB::raw($query));
        $tujuan =  Farmasi::all()->pluck('nama', 'id');
        $data['tujuan'] = $tujuan;
        $data['items'] =$res;
        return $data;

    }
}
