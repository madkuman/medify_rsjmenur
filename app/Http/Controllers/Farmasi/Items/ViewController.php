<?php

namespace App\Http\Controllers\Farmasi\Items;

use App\Exports\Farmasi\BarangLowStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemJenisInteraksi;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\KodeKfaDetail;
use App\Models\Farmasi\MasterBahanAktif;
use App\Models\Farmasi\MasterJenisInteraksi;
use App\Models\Farmasi\MasterKodeBidang;
use App\Models\Farmasi\MasterKodeRekening;
use App\Models\Farmasi\MasterRakObat;
use App\Models\Farmasi\MasterRute;
use App\Models\Farmasi\MasterSatuanKekuatan;
use App\Models\Farmasi\RetriksiBpjsDataLab;
use App\Models\Hospital\Lokasi;
use App\Models\LabPK\Form;
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

        $rute = MasterRute::latest()->get();
        $bahan_aktif = MasterBahanAktif::latest()->get();
        $satuan_kekuatan = MasterSatuanKekuatan::latest()->get();
        $rak_obat = MasterRakObat::latest()->get();
        $jenis_interaksi = MasterJenisInteraksi::latest()->get();
        $kategori = Kategori::latest()->get();
        $form_lab_pk = Form::latest()->get();
        $item_template = ItemsTemplate::latest()->get();

        $data['rute'] = $rute;
        $data['bahan_aktif'] = $bahan_aktif;
        $data['satuan_kekuatan'] = $satuan_kekuatan;
        $data['rak_obat'] = $rak_obat;
        $data['jenis_interaksi'] = $jenis_interaksi;
        $data['kategori'] = $kategori;
        $data['form_lab_pk'] = $form_lab_pk;
        $data['item_template'] = $item_template;

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
                ->addColumn('rownum', function ($items) use (&$rowNum) {
                    return ++$rowNum . '<input type="hidden" value="' . $items->slug . '">';
                })
                ->addColumn('nama', function ($items) {
                    $flag = 0;
                    $stok_low = "";
                    $inline = "";
                    $expired_soon = "";
                    if ($items->min_stok >= $items->stok) {
                        $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>';
                        $flag = 1;
                    }
                    if (!$items->expired_day) {
                    } else if ($items->min_kadaluarsa > $items->expired_day) {
                        if ($flag) {
                            $inline = '<p class="inline">-</p>';
                        }
                        $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
                    }
                    $content = '<p class="font-w600 mb-0">' . $items->item_detail->nama . '</p>' . $stok_low . '' . $inline . '' . $expired_soon . '';
                    return $content;
                })
                ->editColumn('stok', function ($items) {
                    $content = $items->stok ?? '-';
                    return $content;
                })
                ->editColumn('harga', function ($items) {
                    $content = 'Rp. ' . number_format($items->item_detail->harga);
                    return $content;
                })
                ->editColumn('expired', function ($items) {
                    $content = $items->expired ?? '-';
                    return $content;
                })
                ->editColumn('kategori', function ($items) {
                    $kategori = [];
                    foreach ($items->item_detail->kategori_item as $gori) {
                        $kategori[] = '<span class="badge badge-primary">' . $gori->detail_kategori->nama . '</span>';
                    }
                    return $kategori;
                })
                ->addColumn('detail', function ($items) use ($farmasi) {
                    $content = '
				<a href="javascript:void(0)" onclick="popupwindow(' . "'" . url('farmasi/item/stok/' . $items->id) . "'" . ')" class="btn btn-warning">Stok Semua Farmasi</a>
				<a href="' . url('farmasi/' . $farmasi . '/item/' . $items->slug) . '" class="btn btn-primary">Detail</a>            
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

        if (empty($searchKey)) {
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
        $flag = 0;
        //$totalFiltered = 0;
        //dd($getItemsPerPage);
        foreach ($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = [];
            $stok_low = "";
            $inline = "";
            $expired_soon = "";

            foreach ($row->item_detail->kategori_item as $gori) {
                $category[] = '<span class="badge badge-primary">' . $gori->detail_kategori->nama . '</span>';
            }

            if ($row->min_stok > $row->stok) {
                $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>';
                $flag = 1;
            }

            if (!$row->expired_day) {
            } else if ($row->min_kadaluarsa > $row->expired_day) {
                if ($flag) {
                    $inline = '<p class="inline">-</p>';
                }
                $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
            }

            $flag = 0;

            $data[] = [
                $no . '<input type="hidden" value="' . $row->slug . '">',
                '<p class="font-w600 mb-0">' . $row->item_detail->nama . '</p>' . $stok_low . '' . $inline . '' . $expired_soon . '',
                $row->stok,
                'Rp. ' . number_format($row->item_detail->harga),
                $row->expired,
                $category,
                '<a href="' . url('farmasi/' . $farmasi . '/item/' . $row->slug) . '" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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

        if (empty($searchKey)) {
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
        $flag = 0;
        //$totalFiltered = 0;
        //dd($getItemsPerPage);
        foreach ($getItemsPerPage as $row) {
            //if($row->stok == 0) continue;
            //$totalFiltered++;
            $no++;
            $category = [];
            $stok_low = "";
            $inline = "";
            $expired_soon = "";

            foreach ($row->item_detail->kategori_item as $gori) {
                $category[] = '<span class="badge badge-primary">' . $gori->detail_kategori->nama . '</span>';
            }

            if ($row->min_stok > $row->stok) {
                $stok_low = '<p class="mb-0 text-danger inline">Stock Low</p>';
                $flag = 1;
            }

            if (!$row->expired_day) {
            } else if ($row->min_kadaluarsa > $row->expired_day) {
                if ($flag) {
                    $inline = '<p class="inline">-</p>';
                }
                $expired_soon = '<p class="mb-0 text-success inline">Expired Soon</p>';
            }

            $flag = 0;

            $data[] = [
                $no . '<input type="hidden" value="' . $row->slug . '">',
                '<p class="font-w600 mb-0">' . $row->item_detail->nama . '</p>' . $stok_low . '' . $inline . '' . $expired_soon . '',
                $row->stok,
                'Rp. ' . number_format($row->item_detail->harga),
                $row->expired,
                $category,
                '<a href="' . url('farmasi/' . $farmasi . '/item/' . $row->slug) . '" class="btn btn-sm btn-circle btn-outline-success mr-5 mb-5"><i class="fa fa-search-plus"></i></a>'
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
            if (
                isset($item->item_detail->detail_kategori)
                && count($item->item_detail->detail_kategori->where('kategori_id', $gori->id))
            )
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

        $data['rute'] = MasterRute::latest()->get();
        $data['bahan_aktif'] = MasterBahanAktif::latest()->get();
        $data['satuan_kekuatan'] = MasterSatuanKekuatan::latest()->get();
        $data['rak_obat'] = MasterRakObat::latest()->get();
        $data['jenis_interaksi'] = MasterJenisInteraksi::latest()->get();
        $data['kategori'] = Kategori::latest()->get();
        $data['form_lab_pk'] = Form::latest()->get();
        $data['item_template'] = ItemsTemplate::latest()->get();
        $data['master_kode_rekening'] = MasterKodeRekening::get();
        $data['master_kode_bidang'] = MasterKodeBidang::get();

        $data['retriksi_bpjs_data_lab_ids'] = RetriksiBpjsDataLab::where('item_template_id', $item->item_template->id)->pluck('form_id')->toArray();
        $data['item_jenis_interaksi_kelas_terapi'] = ItemJenisInteraksi::where('item_template_id', $item->item_template->id)->where('tipe', 'kelas-terapi')->get();
        $data['item_jenis_interaksi_obat'] = ItemJenisInteraksi::where('item_template_id', $item->item_template->id)->where('tipe', 'kelas-obat')->get();

        $data['rute_id'] = $item->item_template->rute_id ?? '';
        $data['bahan_aktif_id'] = $item->item_template->bahan_aktif_id ?? '';
        $data['kekuatan_sediaan'] = $item->item_template->kekuatan_sediaan ?? '';
        $data['satuan_kekuatan_id'] = $item->item_template->satuan_kekuatan_id ?? '';
        $data['kelas_terapi_id'] = $item->item_template->kelas_terapi_id ?? '';
        $data['is_kelas_terapi'] = $item->item_template->is_kelas_terapi ?? '';
        $data['kelas_terapi_fornas_id'] = $item->item_template->kelas_terapi_fornas_id ?? '';
        $data['is_kelas_terapi_fornas'] = $item->item_template->is_kelas_terapi_fornas ?? '';
        $data['rak_obat_id'] = $item->item_template->rak_obat_id ?? '';
        $data['is_formularium_rs'] = $item->item_template->is_formularium_rs ?? '';
        $data['is_fornas'] = $item->item_template->is_fornas ?? '';
        $data['retriksi_bpjs_jumlah'] = $item->item_template->retriksi_bpjs_jumlah ?? '';
        $kfa = '';
        if (!empty($item->item_template->kode_kfa)) {
            $kfa = KodeKfaDetail::where('kode_kfa', $item->item_template->kode_kfa)->first();
            $data['detail_kfa'] = $kfa;
        }
        // dd($kfa);

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
        $data['data'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->filterExpiredItems($farm->id, $batas_hari);
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
        $filename = "Barang Low Stok - " . $farm->nama;

        return (new BarangLowStock($data))->download($filename . '.xlsx');
    }

    public function masterDataIndex($farmasi, Request $request)
    {
        $farm = session('farmasi');
        $data['sidebar_active'] = "";

        return view('farmasi.item.master-data-index', $data);
    }
}
