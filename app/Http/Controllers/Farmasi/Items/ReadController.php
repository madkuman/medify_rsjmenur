<?php

namespace App\Http\Controllers\Farmasi\Items;

use App\Http\Controllers\Controller;
use App\Models\Farmasi\AturanHarga;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\LogPengadaan;
use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReadController extends Controller
{

    public function search($request)
    {
        // $search = preg_replace("/[^[:alnum:][:space:]]/u", '', $request->get('keyword'));
        $search = $request->get('keyword'); # direct karena gk pake elastic
        if ($search == "NOT") {
            $search = strtolower($search);
        }

        $jenis = $request->get('jenis') ? $request->get('jenis') : 0;

        if (!empty($search)) {
            $item = ItemsTemplate::with([])
                ->when($jenis, function ($query) use ($jenis) {
                    $query->where('jenis', $jenis);
                })
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'like',"%$search%")
                        ->orWhereHas('bahan_aktif',function ($query) use ($search) {
                            $query->select(DB::raw(1))
                                ->where('nama', 'like',"%$search%");
                        });
                })
                ->paginate(20);
        } else {
            $item = ItemsTemplate::with('stok')->latest()->paginate(20);
        }

        // dd($item);
        return $item;
    }
    public function getAll($id)
    {
        $items = ItemsFarmasi::where('farmasi_id', $id)->latest()->get();
        return $items;
    }

    public function getAllItems($farmasi_id)
    {
        $items = Items::with(['detail_item.item_detail'])->where('kadaluarsa', '>', Carbon::today())->where('farmasi_id', $farmasi_id)->latest()->get();
        return $items;
    }

    public function getDataIndex($farmasi_id, $request)
    {
        $flag = 0;
        $barang = $request->nama_barang;
        $stok_min = $request->stok_minimal;
        $stok_max = $request->stok_maksimal;
        $harga_min = $request->harga_minimal;
        $harga_max = $request->harga_maksimal;
        $kategori = $request->kategori;
        $jenis = $request->jenis;
        $itemFarmasi = ItemsFarmasi::with('items_available')->where('farmasi_id', $farmasi_id);
        $barang = preg_replace("/[^[:alnum:][:space:]]/u", ' ', $barang);
        if ($barang) {
            $rest = ItemsTemplate::search($barang)->take(1000)->get()->pluck('id')->toArray();
            $itemFarmasi = $itemFarmasi->whereHas('item_detail', function ($item) use ($rest) {
                $item->whereIn('id', $rest);
            });
        }
        if ($kategori) {
            $itemFarmasi = $itemFarmasi->whereHas('item_detail', function ($item) use ($kategori) {
                $item->whereHas('kategori_item', function ($cat) use ($kategori) {
                    $cat->whereIn('kategori_id', $kategori);
                }, '>=', count($kategori));
            });
        }
        if ($jenis) {
            $rest = ItemsTemplate::whereIn('jenis', $jenis)->get()->pluck('id')->toArray();
            $itemFarmasi = $itemFarmasi->whereHas('item_detail', function ($item) use ($rest) {
                $item->whereIn('id', $rest);
            });
        }
        if ($harga_min) {
            $itemFarmasi = $itemFarmasi->whereHas('item_detail', function ($item) use ($harga_min) {
                $item->where('harga', '>=', $harga_min);
            });
        }
        if ($harga_max) {
            $itemFarmasi = $itemFarmasi->whereHas('item_detail', function ($item) use ($harga_max) {
                $item->where('harga', '<=', $harga_max);
            });
        }
        if ($stok_min) {
            $itemFarmasi = $itemFarmasi->whereHas('items_available', function ($item) use ($stok_min) {
                $item->where('jumlah', '>=', $stok_min);
            });

        }
        if ($stok_max) {
            $itemFarmasi = $itemFarmasi->whereHas('items_available', function ($item) use ($stok_max) {
                $item->where('jumlah', '<=', $stok_max);
            });
        }

        if ($barang && !empty($rest)) {
            $rest = implode(',', $rest);
            $itemFarmasi->orderByRaw("FIELD(item_template_id, $rest)");
        } else {
            $itemFarmasi = $itemFarmasi->latest();
        }

        return $itemFarmasi;
    }

    public function getItemWithStok($farmasi_id)
    {
        $func = function ($value) {
            return $value->id;
        };

        $query = DB::connection('farmasi')->select('SELECT id FROM items_farmasi WHERE id IN
                        (SELECT item.id FROM (SELECT item_farmasi_id AS id, SUM(jumlah) AS stok FROM items WHERE kadaluarsa > CURRENT_TIMESTAMP() AND deleted_at IS NULL AND farmasi_id = ' . $farmasi_id . ' GROUP BY item_farmasi_id) AS item WHERE item.stok != 0)');
        $id = array_map($func, $query);

        $items = ItemsFarmasi::whereIn('id', $id)->where('farmasi_id', $farmasi_id)->latest()->get();
        return $items;

    }

    public function getAllStok($item_id)
    {
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $stok = array();
        $i = 1;

        $item = ItemsFarmasi::find($item_id);
        $temp = ItemsTemplate::find($item->item_template_id);

        foreach ($pharmacy as $pharm) {
            $item = ItemsFarmasi::where('item_template_id', $temp->id)->where('farmasi_id', $pharm->id)->first();
            $stok[$i]['farmasi'] = $pharm->nama;
            $stok[$i]['stok'] = $item ? $item->stok : '-';
            $i++;
        }

        return $stok;
    }

    public function getItemById($item_id)
    {
        $item = ItemsFarmasi::find($item_id);

        return $item;
    }

    public function getItemWithWarningExp($farmasi_id)
    {
        $func = function ($value) {
            return $value->id;
        };

        $query = DB::connection('farmasi')->select('SELECT * FROM items_farmasi WHERE id IN
            (SELECT item.id FROM
            (SELECT items_farmasi.id, items_farmasi.min_kadaluarsa, DATEDIFF(MIN(items.kadaluarsa),CURDATE()) AS expired FROM items,items_farmasi WHERE items.jumlah > 0 AND items.kadaluarsa > CURDATE() AND items.deleted_at IS NULL AND items.item_farmasi_id = items_farmasi.id GROUP BY items_farmasi.id) AS item WHERE item.min_kadaluarsa > item.expired)');
        $id = array_map($func, $query);

        $items = ItemsFarmasi::whereIn('id', $id)->where('farmasi_id', $farmasi_id)->latest()->get();
        return $items;
    }

    public function getItemWithWarningStok($farmasi_id)
    {
        $func = function ($value) {
            return $value->id;
        };

        $query = DB::connection('farmasi')->select('SELECT * FROM items_farmasi WHERE id IN
                        (SELECT item.id FROM
                        (SELECT items_farmasi.id, items_farmasi.min_stok, SUM(items.jumlah) AS stok FROM items, items_farmasi WHERE items.kadaluarsa > CURRENT_TIMESTAMP() AND items.deleted_at IS NULL AND items.item_farmasi_id = items_farmasi.id GROUP BY items_farmasi.id) AS item WHERE item.stok < item.min_stok)');
        $id = array_map($func, $query);

        $items = ItemsFarmasi::whereIn('id', $id)->where('farmasi_id', $farmasi_id)->latest()->get();
        return $items;

    }

    public function getItems($farmasi, Request $request)
    {
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $farm_asal = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($request->farm_asal);
        $search = $request->get('keyword');
        if($request->has('kasus_id') && $request->kasus_id != null){
            $kasus = app(\App\Http\Controllers\Kasus\Kasus\ReadController::class)->getById($request->kasus_id, ['pembayaran.perusahaan', 'lokasi.lokasi']);
            if($kasus != null){
                $perusahaan_tipe = $kasus->pembayaran->perusahaan->type ?? null;
                $lokasi_departemen_id = $kasus->lokasi->lokasi->lokasi_departemen_id ?? null;
            }
        }
        $aturan_harga = app(\App\Http\Controllers\Farmasi\AturanHarga\ReadController::class)->filterAturan($farm->id, $perusahaan_tipe ?? null, $transaksi ?? null, $jenis_pasien ?? null, $lokasi_departemen_id ?? null);
        
        $items = $this->search($request);
        $id = $items->map(function ($item) {
            return collect($item->toArray())
                ->only(['id'])
                ->all();
        });

        $arr = array();
        if (!empty($search)) {
            foreach ($id as $ide) {
                array_push($arr, $ide['id']);
            }

            $arrStr = implode(',', $arr);
            $item = ItemsFarmasi::whereIn('item_template_id', $arr)->where('farmasi_id', $farm->id)->orderByRaw(DB::raw("FIELD(item_template_id, $arrStr)"))->with('item_detail', 'kadal', 'stok', 'item_detail.kategori_item.detail_kategori')->paginate(10);
            if (!empty($farm_asal)) {
                $item_asal = ItemsFarmasi::whereIn('item_template_id', $arr)->where('farmasi_id', $farm_asal->id)->orderByRaw(DB::raw("FIELD(item_template_id, $arrStr)"))->with('item_detail', 'kadal', 'stok', 'item_detail.kategori_item.detail_kategori')->paginate(10);
            }

            foreach ($item as $index => $it) {
                $it->text = $it->item_detail->nama;
                $it->item_detail->harga = round($it->hitungHargaJual($aturan_harga, 1, true, $farm));
                if (!empty($farm_asal)) {
                    if ($item_asal[$index]->stok) {
                        $it->stok_asal = round($item_asal[$index]->stok);
                    } else {
                        $it->stok_asal = 0;
                    }
                }
            }
            if ($request->has('order_by_stok')) {
                $sortedResult = $item->getCollection()->sortBy(function ($item) {
                    return ($item->stok == 0 ? 'z' : 'a').'-'.$item->item_detail->nama;
                })->values();
                $item->setCollection($sortedResult);
            }
        } else {
            $item = ItemsTemplate::latest()->paginate(10);
            foreach ($item as $it) {
                $it->text = $it->nama;
            }
        }

        // dd($item);
        return $item;
    }

    public function getItembyItemTemplateIds($ids, $farmasi)
    {
        $item_templates = ItemsTemplate::whereIn('id', $ids)->pluck('id')->toArray();
        $items = ItemsFarmasi::whereIn('item_template_id', $item_templates)->where('farmasi_id', $farmasi->id)->with('item_detail', 'kadal', 'stok')->get();

        return $items;

    }

    public function getItemDetail($item_slug)
    {
        $item = ItemsFarmasi::with('item_detail.produksi.detail.item_farmasi.item_detail',
            'item_detail.produksi.detail.item_farmasi.kadal',
            'item_detail.kategori_item.detail_kategori')->where('slug', $item_slug)->first();
        return $item;
    }

    public function getMutasi($farmasi, $slug, $date_start, $date_end)
    {

        $min_date = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
        $max_date = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();

        $item_farmasi_id = ItemsFarmasi::where('slug', $slug)->first()->id;

        $query_riwayat = "SELECT * FROM (
                    SELECT
                    table_transaksi.id,
                    table_transaksi.created_at AS tanggal,
                    table_transaksi.jenis_transaksi,
                    table_transaksi.pihak_kedua,
                    table_transaksi.stok,
                    table_transaksi.slug
                    FROM (
                        SELECT  it.id, ld.created_at,'Transaksi' jenis_transaksi, if(d.pasien_id IS NULL,'Pasien Bebas',p.name) AS pihak_kedua, (ld.jumlah) AS stok, d.slug
                        FROM log_transaksi ld
                        JOIN resep_detail rd ON ld.`resep_detail_id` = rd.`id`
                        JOIN resep r ON rd.`resep_id` = r.`id`
                        JOIN items i ON i.id = ld.item_id
                        JOIN items_farmasi it ON i.item_farmasi_id = it.id
                        JOIN transaksi_obat d ON r.`transaksi_id` = d.`id`
                        LEFT JOIN " . config('app.db_name') . "_patients.pasien p ON d.pasien_id = p.id
                        WHERE it.id = " . $item_farmasi_id . "
                        AND ld.created_at > '" . $min_date . "'
                        AND ld.created_at < '" . $max_date . "'
                        AND r.retur = 0
                        AND r.`deleted_at` IS  NULL
                        AND d.deleted_at IS  NULL
                        AND ld.`deleted_at` IS  NULL
                    ) table_transaksi

                    UNION ALL

                    SELECT  it.id, ld.created_at,'Transaksi Retur' jenis_transaksi, if(d.pasien_id IS NULL,'Pasien Bebas',p.name) AS pihak_kedua, (ld.jumlah_retur) AS stok, d.slug
                        FROM log_transaksi ld
                        JOIN resep_detail rd ON ld.`resep_detail_id` = rd.`id`
                        JOIN resep r ON rd.`resep_id` = r.`id`
                        JOIN items i ON i.id = ld.item_id
                        JOIN items_farmasi it ON i.item_farmasi_id = it.id
                        JOIN transaksi_obat d ON r.`transaksi_id` = d.`id`
                        LEFT JOIN " . config('app.db_name') . "_patients.pasien p ON d.pasien_id = p.id
                        WHERE it.id = " . $item_farmasi_id . "
                        AND ld.created_at > '" . $min_date . "'
                        AND ld.created_at < '" . $max_date . "'
                        AND ld.jumlah_retur > 0
                        AND r.`deleted_at` IS  NULL
                        AND d.deleted_at IS  NULL
                        AND ld.`deleted_at` IS  NULL

                    UNION ALL

                    SELECT  it.id, d.created_at, 'Penghapusan' jenis_transaksi,'-' pihak_kedua, (ld.jumlah) AS stok, d.slug
                    FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                    WHERE d.id = ld.penghapusan_id
                    AND it.id = " . $item_farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL

                    UNION ALL

                    SELECT  it.id, d.created_at, 'Pengadaan' jenis_transaksi,s.nama as pihak_kedua, (ld.jumlah) AS stok, d.slug
                    FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it," . config('app.db_name') . "_keuangan.perusahaan s
                    WHERE d.id = ld.pengadaan_id
                    AND s.id = d.supplier_id
                    AND it.id = " . $item_farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL

                    UNION ALL

                    SELECT  it.id, ld.created_at, 'Distribusi Keluar' jenis_transaksi, IF(d.unit_tujuan, f.nama, 'GUDANG') pihak_kedua, (ld.jumlah) AS Stok, d.slug
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                    WHERE d.id = ld.distribusi_id
                    AND it.id = " . $item_farmasi_id . "
                    AND f.id = d.unit_tujuan
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    UNION ALL

                    SELECT  it.id, ld.created_at, 'Distribusi Masuk' jenis_transaksi, IF(d.unit_tujuan, IF(d.unit_tujuan = d.farmasi_id, 'Stok Opname', f.nama), 'GUDANG') pihak_kedua, (ld.jumlah) AS stok, d.slug
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                    WHERE d.id = ld.distribusi_id
                    AND it.id = " . $item_farmasi_id . "
                    AND f.id = d.unit_tujuan
                    AND d.tipe = 1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                ) AS hasil ORDER BY tanggal DESC";
        $data = DB::connection('farmasi')->select(DB::raw($query_riwayat));

        foreach ($data as $item) {
            $item->tanggal = date('d-m-Y', strtotime($item->tanggal));
        }

        return json_encode($data);
    }

    public function getActiveItemList($farmasi, $item_id)
    {
        //$item = Items::where('item_template_id', $item_id)->where('kadaluarsa','>',Carbon::today())->latest()->get();
        $item = Items::where('item_farmasi_id', $item_id)->where('jumlah', '!=', 0)->orderBy('kadaluarsa', 'asc')->get();

        return $item;
    }

    public function getMinusItemList($item_id)
    {
        //$item = Items::where('item_template_id', $item_id)->where('kadaluarsa','>',Carbon::today())->latest()->get();
        $item = Items::where('item_farmasi_id', $item_id)->where('jumlah', '<', 0)->orderBy('kadaluarsa', 'asc')->get();

        return $item;
    }

    public function getByPengadaan($pengadaan_id)
    {
        $items = Items::where('pengadaan_id', $pengadaan_id)->get();
        //$count = count(Items::all());
        return $items;
    }
    public function getByPenghapusan($pengadaan_id)
    {
        $items = LogPenghapusan::with('detail_item.detail_item.item_detail')->where('penghapusan_id', $pengadaan_id)->get();
        //$count = count(Items::all());
        return $items;
    }

    public function getKartuStok($item, $tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
            $min_date = $min_date->copy()->startOfDay();
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        $now = Carbon::now();
        if ($min_date > $now) {
            $min_date = $now->copy()->startOfDay();
        }

        if ($max_date > $now) {
            $max_date = $now->copy()->endOfDay();
        }

        $query_riwayat = $this->kartuStokUtil($min_date, $max_date, $item->id);
        $query_luar_riwayat = $this->kartuStokUtil($max_date, $now, $item->id);
        // dd($query_riwayat);
        $riwayat = DB::connection('farmasi')->select(DB::raw($query_riwayat));
        $luar_riwayat = DB::connection('farmasi')->select(DB::raw($query_luar_riwayat));
        $selisih = collect($riwayat)->sum(function ($item) {
            return $item->jumlah_plus - $item->jumlah_min;
        });
        $selisih_luar = collect($luar_riwayat)->sum(function ($item) {
            return $item->jumlah_plus - $item->jumlah_min;
        });

        $stok_awal = $item->all_stok - $selisih - $selisih_luar;
        return ['stok_awal' => $stok_awal, 'riwayat' => $riwayat, 'luar_riwayat' => $luar_riwayat];

    }

    public function getKegiatanKesehatan($farmasi_id, $tgl_awal, $tgl_akhir)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal)->startOfDay();
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        $now = Carbon::now();
        if ($min_date > $now) {
            $min_date = $now->copy()->startOfDay();
        }

        if ($max_date > $now) {
            $max_date = $now->copy();
        }

        $query_max_now = $this->kegiatanKesehatanUtil($max_date, $now, $farmasi_id);
        $query_min_max = $this->kegiatanKesehatanUtil($min_date, $max_date, $farmasi_id);
        $res_max_now = DB::connection('farmasi')->select(DB::raw($query_max_now));
        $res_min_max = DB::connection('farmasi')->select(DB::raw($query_min_max));
        $min_max = collect($res_min_max)->keyBy('id');
        $max_now = collect($res_max_now)->keyBy('id');

        $item_farmasi = ItemsFarmasi::with('stok', 'item_detail', 'stok_kadaluarsa')->where('farmasi_id', $farmasi_id)->get()->keyBy('id');
        // dd($farmasi_id, $query_min_max, $query_max_now);
        return ['items' => $item_farmasi,
            'dilaporkan' => $min_max,
            'luar_laporan' => $max_now,
            'min_date' => $min_date->toDateTimeString(),
            'max_date' => $max_date->toDateTimeString(),
        ];
    }

    public function getNarkotika($farmasi_id, $tgl_awal, $tgl_akhir, $kategori)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        if ($kategori) {
            $id = ItemsTemplate::whereHas('kategori_item', function ($cat) use ($kategori) {
                $cat->whereIn('kategori_id', $kategori);
            })->orderBy('satuan', 'asc')->orderBy('nama', 'asc')->pluck('id');
        } else {
            $id = ItemsTemplate::orderBy('satuan', 'asc')->orderBy('nama', 'asc')->pluck('id');
        }

        $items = ItemsFarmasi::whereIn('item_template_id', $id)->where('farmasi_id', $farmasi_id)->get();

        $arr = array();
        foreach ($items as $item) {
            $stok_item = LogPengadaan::whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->get();
            $item->masuk = $stok_item->sum('jumlah');
            $minus = LogDistribusi::where('jenis', 1)->whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', -1);
            });
            $plus = LogDistribusi::where('jenis', 1)->whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', 1);
            });
            $hapus = LogPenghapusan::whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });
            $trans = LogTransaksi::whereBetween('created_at', [$min_date, $max_date])->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });
            $item->keluar = $minus->sum('jumlah');
            $item->masuk += $plus->sum('jumlah');
            $item->hapus = $hapus->sum('jumlah');
            $item->resep = $trans->sum('jumlah');
            $item->resep -= $trans->sum('jumlah_retur');

            //Stok Awal
            $item_awal = LogPengadaan::whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereDate('created_at', '<', $min_date)->get();
            $item->stok_awal = $item_awal->sum('jumlah');
            $minus = LogDistribusi::where('jenis', 1)->whereDate('created_at', '<', $min_date)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', -1);
            });
            $plus = LogDistribusi::where('jenis', 1)->whereDate('created_at', '<', $min_date)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', 1);
            });
            $hapus = LogPenghapusan::whereDate('created_at', '<', $min_date)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });
            $trans = LogTransaksi::whereDate('created_at', '<', $min_date)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });
            $item->stok_awal -= $minus->sum('jumlah');
            $item->stok_awal += $plus->sum('jumlah');
            $item->stok_awal -= $hapus->sum('jumlah');
            $item->stok_awal -= $trans->sum('jumlah');
            $item->stok_awal += $trans->sum('jumlah_retur');
            if ($item->stok_awal || $item->masuk) {
                array_push($arr, $item);
            }

        }
        return $arr;
    }

    public function getPemakaian($farmasi_id, $tgl_awal, $tgl_akhir, $mode, $kategori, $jenis, $shift, $array_pembayaran)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        if ($mode == 1) {
            $isBebas = "AND transaksi_obat.kasus_id IS NOT NULL";
        } elseif ($mode == 2) {
            $isBebas = "AND transaksi_obat.kasus_id IS NOT NULL";
        } else {
            $isBebas = "";
        }

        $query = 'SELECT
                transaksi_obat.`kasus_id`,
                items_farmasi.`item_template_id`,
                SUM(log_transaksi.`jumlah` - IFNULL(log_transaksi.`jumlah_retur`, 0)) AS jumlah
            FROM
                ' . config('app.db_name') . '_farmasi.`resep_detail`,
                ' . config('app.db_name') . '_farmasi.`transaksi_obat`,
                ' . config('app.db_name') . '_farmasi.`log_transaksi`,
                ' . config('app.db_name') . '_farmasi.`items_farmasi`
            WHERE   transaksi_obat.`created_at` >= "' . $min_date . '"
            AND     transaksi_obat.`created_at` < "' . $max_date . '"
            AND     transaksi_obat.`resep_final` = resep_detail.`resep_id`
            AND     log_transaksi.`resep_detail_id` = resep_detail.id
            AND     transaksi_obat.`status` = 1
            AND     transaksi_obat.`farmasi_id` =' . $farmasi_id . '
            AND     transaksi_obat.`deleted_at` IS NULL
            ' . $isBebas . '
            AND     items_farmasi.`id` = resep_detail.`obat_id`
            GROUP BY items_farmasi.item_template_id
            ';

        $res = DB::connection('farmasi')->select(DB::raw($query));
        $res = collect($res);

        if (count($array_pembayaran) != 4) {
            $kasus_ids = $res->pluck('kasus_id')->filter(function ($el) {
                return $el != null;
            });
            $kasus = Kasus::with('pembayaran.perusahaan')->whereIn('id', $kasus_ids)->get();
            $kasus = $kasus->filter(function ($el) use ($array_pembayaran) {
                return isset($el->pembayaran->perusahaan->type) &&
                in_array($el->pembayaran->perusahaan->type, $array_pembayaran);
            });
            $res = $res->filter(function ($el) use ($kasus) {
                return in_array($el->kasus_id, $kasus->pluck('id')->toArray());
            });
        }

        $item_template = ItemsTemplate::whereIn('id', $res->pluck('item_template_id'));
        if (isset($kategori)) {
            $item_template->whereHas('kategori_item', function ($q) use ($kategori) {
                $q->whereIn('kategori_id', $kategori);
            });
        }

        $item_template = $item_template->get();
        $data['jumlah'] = $res->pluck('jumlah', 'item_template_id');
        $data['items'] = $item_template;
        return $data;
    }

    public function getPengeluaran($farmasi_id, $tgl_awal, $tgl_akhir, $mode)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        //dd($max_date);

        $id = ItemsTemplate::orderBy('satuan', 'asc')->orderBy('nama', 'asc')->pluck('id');
        $items = ItemsFarmasi::whereIn('item_template_id', $id)->where('farmasi_id', $farmasi_id)->get();

        $arr = array();
        foreach ($items as $item) {
            if ($mode) {
                if ($mode == 1) {
                    $trans = ResepDetail::whereBetween('created_at', [$min_date, $max_date])->where('obat_id', $item->id)->whereHas('log')->whereHas('resep_detail', function ($res) {
                        $res->whereHas('transaksi_detail', function ($tra) {
                            $tra->whereNull('kasus_id');
                        });
                    })->get();
                } else {
                    $trans = ResepDetail::whereBetween('created_at', [$min_date, $max_date])->where('obat_id', $item->id)->whereHas('log')->whereHas('resep_detail', function ($res) {
                        $res->whereHas('transaksi_detail', function ($tra) {
                            $tra->whereNotNull('kasus_id');
                        });
                    })->get();
                }

            } else {
                $trans = ResepDetail::whereBetween('created_at', [$min_date, $max_date])->where('obat_id', $item->id)->whereHas('log')->get();
            }

            //if($item->item_template_id == 6) dd($stok_item);
            $item->jumlah = $trans->sum('jumlah');
            $item->hari7 = $trans->sum('hari7');
            $item->hari23 = $trans->sum('hari23');
            $item->dukunganrs = $trans->sum('dukunganrs');
            //$item->harga = $trans->sum('subtotal');

            foreach ($trans as $tra) {
                foreach ($tra->log as $row) {
                    $item->jumlah -= $row->jumlah_retur;
                }
            }
            if ($item->jumlah) {
                array_push($arr, $item);
            }

        }

        return $arr;
    }

    public function getPemberian($farmasi_id, $tgl_awal, $tgl_akhir, $pasien_id)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        if (!$farmasi_id) {
            $farmasi_id = Farmasi::pluck('id');
        }

        $transaksi = TransaksiObat::with(['final_detail.resep_detail.obat_detail.item_detail', 'final_detail.owner_detail', 'dokter', 'created_by_detail'])->where('pasien_id', $pasien_id)->whereIn('farmasi_id', $farmasi_id)->where('status_retur', '!=', 2)
            ->whereBetween('paid_at', [$min_date, $max_date])->whereHas('final_detail', function ($fin) {
            $fin->whereHas('resep_detail', function ($res) {
                $res->whereHas('log');
            });
        })->orderBy('paid_at', 'asc')->get();
        return $transaksi;
    }

    public function getPemberianPerBangsal($farmasi_id, $bangsal_id, $tgl_awal, $tgl_akhir, $pasien_id)
    {
        if ($tgl_awal) {
            $tgl_awal = str_replace("/", "-", $tgl_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else {
            $min_date = Carbon::minValue();
        }

        if ($tgl_akhir) {
            $tgl_akhir = str_replace("/", "-", $tgl_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else {
            $max_date = Carbon::maxValue();
        }

        if (!$farmasi_id) {
            $farmasi_id = Farmasi::pluck('id');
        }

        if (!$bangsal_id) {
            $bangsal_id = Bangsal::pluck('id');
        }

        $lokasi = Ruangan::whereIn('bangsal_id', $bangsal_id)->pluck('lokasi_id');
        //dd($lokasi);

        $transaksi = TransaksiObat::whereIn('farmasi_id', $farmasi_id)->where('status_retur', '!=', 2)
            ->whereBetween('created_at', [$min_date, $max_date])->whereHas('final_detail', function ($fin) {
            $fin->whereHas('resep_detail', function ($res) {
                $res->whereHas('log');
            });
        })->orderBy('paid_at', 'desc');
        if ($lokasi) {
            $transaksi = $transaksi->whereIn('lokasi_id', $lokasi);
        }

        $transaksi = $transaksi->get();
        //dd($transaksi);
        /*$resep = Resep::whereHas('transaksi_detail', function($tra) use($pasien_id,$farmasi_id,$min_date,$max_date){
        $tra->where('pasien_id', $pasien_id)->whereIn('farmasi_id', $farmasi_id)->where('status_retur','!=',2)
        ->whereBetween('paid_at', [$min_date, $max_date]);
        })
        ->whereHas('resep_detail', function($res){
        $res->whereHas('log');
        })->orderBy('transaksi_detail.paid_at','desc')->get();*/

        return $transaksi;
    }

    public function getOpname($farmasi_id, $tgl_awal, $tgl_akhir)
    {
        if ($tgl_akhir) {
            $end = str_replace("/", "-", $tgl_akhir);
            $end = strtotime($end);
            $end = date('m/d/Y', $end);

            $end = Carbon::parse($end);
            $end = $end->copy()->endOfDay();
        } else {
            $end = Carbon::maxValue();
        }

        if ($tgl_awal) {
            $start = str_replace("/", "-", $tgl_awal);
            $start = strtotime($start);
            $start = date('m/d/Y', $start);

            $start = Carbon::parse($start);
            $start = $start->copy()->startOfDay();
        } else {
            $start = Carbon::minValue();
        }

        $penghapusan = LogPenghapusan::with(['detail_penghapusan', 'detail_item.detail_item.item_detail', 'detail_item.detail_item.stok'])->whereBetween('created_at', [$start, $end])->whereHas('detail_penghapusan', function ($q) {
            $q->where('keterangan', 'Stok Opname Live')->orWhere('keterangan', 'Stok Opname');
        })->get();
        $distribusi = LogDistribusi::with(['detail_distribusi', 'detail_item.detail_item.item_detail', 'detail_item.detail_item.stok'])->whereBetween('created_at', [$start, $end])->whereHas('detail_distribusi', function ($q) {
            $q->where('deskripsi', 'Stok Opname Live')->orWhere('deskripsi', 'Stok Opname');
        })->get();
        $items = [];
        foreach ($distribusi as $item) {
            if ($item->detail_distribusi->farmasi_id == $farmasi_id) {
                if (isset($items[$item->detail_item->detail_item->id])) {
                    $items[$item->detail_item->detail_item->id]['stok'] += $item->jumlah_setelah_distribusi;
                } else {
                    $items[$item->detail_item->detail_item->id]['stok'] = $item->jumlah_setelah_distribusi;
                    $items[$item->detail_item->detail_item->id]['nama'] = $item->detail_item->detail_item->item_detail->nama;
                    $items[$item->detail_item->detail_item->id]['satuan'] = $item->detail_item->detail_item->item_detail->satuan;
                    $items[$item->detail_item->detail_item->id]['harga'] = $item->detail_item->detail_item->item_detail->harga;
                    $items[$item->detail_item->detail_item->id]['kadaluarsa'] = $item->detail_item->kadaluarsa;
                }
            }
        }
        foreach ($penghapusan as $item) {
            if ($item->detail_penghapusan->farmasi_id == $farmasi_id) {
                if (isset($items[$item->detail_item->detail_item->id])) {
                    $items[$item->detail_item->detail_item->id]['stok'] -= $item->jumlah_setelah_penghapusan;
                } else {
                    $items[$item->detail_item->detail_item->id]['stok'] = -$item->jumlah_setelah_penghapusan;
                    $items[$item->detail_item->detail_item->id]['nama'] = $item->detail_item->detail_item->item_detail->nama;
                    $items[$item->detail_item->detail_item->id]['satuan'] = $item->detail_item->detail_item->item_detail->satuan;
                    $items[$item->detail_item->detail_item->id]['harga'] = $item->detail_item->detail_item->item_detail->harga;
                    $items[$item->detail_item->detail_item->id]['kadaluarsa'] = $item->detail_item->kadaluarsa;
                }
            }
        }
        usort($items, array($this, 'cmp3'));

        return [
            'items' => $items,
            'min_date' => $start->toDateString(),
            'max_date' => $end->toDateString(),
        ];
    }

    public function getStokSekarang($farmasi_id)
    {
        // dd($farmasi_id);
        $items = ItemsFarmasi::with(['stok', 'item_detail', 'kadal', 'items_all'])->where('farmasi_id', $farmasi_id)->whereHas('stok')->get()->toArray();
        usort($items, array($this, 'cmp4'));
        return $items;
        $arr = array();
        foreach ($items as $item) {
            //Stok Awal
            $item_awal = LogPengadaan::whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereDate('created_at', '<=', $tanggal)->get();
            //dd($item_awal);
            //if($item->item_template_id == 93)
            $item->kadal = $item_awal->min('detail_item.kadaluarsa');
            $item->stok_awal = $item_awal->sum('jumlah');
            $minus = LogDistribusi::where('jenis', 1)->whereDate('created_at', '<=', $tanggal)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', -1);
            });
            $plus = LogDistribusi::where('jenis', 1)->whereDate('created_at', '<=', $tanggal)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            })->whereHas('detail_distribusi', function ($cat) use ($item) {
                $cat->where('tipe', 1);
            });
            $hapus = LogPenghapusan::whereDate('created_at', '<=', $tanggal)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });
            $trans = LogTransaksi::whereDate('created_at', '<=', $tanggal)->whereHas('detail_item', function ($cat) use ($item) {
                $cat->where('item_farmasi_id', $item->id);
            });

            $item->stok_awal -= $minus->sum('jumlah');
            $item->stok_awal += $plus->sum('jumlah');
            $item->stok_awal -= $hapus->sum('jumlah');
            $item->stok_awal -= $trans->sum('jumlah');
            $item->stok_awal += $trans->sum('jumlah_retur');
            //dd($item);
            if ($item->stok_awal) {
                array_push($arr, $item);
            }

        }

        // dd($arr[0]);

        return $arr;
    }

    public function getExpiredAt($tanggal_start, $tanggal_end, $farm)
    {
        if ($tanggal_end) {
            $end = str_replace("/", "-", $tanggal_end);
            $end = strtotime($end);
            $end = date('m/d/Y', $end);

            $end = Carbon::parse($end);
            $end = $end->copy()->endOfDay();
        } else {
            $end = Carbon::maxValue();
        }

        if ($tanggal_start) {
            $start = str_replace("/", "-", $tanggal_start);
            $start = strtotime($start);
            $start = date('m/d/Y', $start);

            $start = Carbon::parse($start);
            $start = $start->copy()->startOfDay();
        } else {
            $start = Carbon::minValue();
        }

        // dd($tanggal_start, $tanggal_end, $farm, $start, $end);
        $item = Items::with(['detail_item.item_detail'])->where('kadaluarsa', '>=', $start->toDateTimeString())->where('kadaluarsa', '<=', $end->toDateTimeString())->where('farmasi_id', $farm)->get()->toArray();

        usort($item, array($this, 'cmp2'));
        return $item;
    }

    public function obatMasuk($tanggal_start, $tanggal_end, $farm)
    {
        if ($tanggal_end) {
            $end = str_replace("/", "-", $tanggal_end);
            $end = strtotime($end);
            $end = date('m/d/Y', $end);

            $end = Carbon::parse($end);
            $end = $end->copy()->endOfDay();
        } else {
            $end = Carbon::maxValue();
        }

        if ($tanggal_start) {
            $start = str_replace("/", "-", $tanggal_start);
            $start = strtotime($start);
            $start = date('m/d/Y', $start);

            $start = Carbon::parse($start);
            $start = $start->copy()->startOfDay();
        } else {
            $start = Carbon::minValue();
        }

        // dd($tanggal_start, $tanggal_end, $farm, $start, $end);
        $item = DB::connection('farmasi')->select(DB::raw('SELECT jenis_type, jenis_id, farmasi_items_kadaluarsa , template_id, template_nama, template_harga, template_satuan, template_id, template_kode, SUM(jumlah_masuk) AS jumlah, SUM(jumlah_masuk) * template_harga as subtotal_harga FROM laporan_transaksi
            WHERE src_created_at > "' . $start .
            '" AND src_created_at < "' . $end .
            '" and farmasi_id = ' . $farm .
            ' GROUP BY template_id HAVING SUM(jumlah_masuk) > 0'));

        // $item = LaporanTransaksi::with(['jenis'])->whereBetween('src_created_at', [$start, $end])->orderBy('src_created_at', 'asc')->whereRaw('jumlah_masuk - jumlah_keluar > 0')->get();
        // dd($item);

        usort($item, array($this, 'cmp'));
        return $item;
    }
    public function obatKeluar($tanggal_start, $tanggal_end, $farm)
    {
        if ($tanggal_end) {
            $end = str_replace("/", "-", $tanggal_end);
            $end = strtotime($end);
            $end = date('m/d/Y', $end);

            $end = Carbon::parse($end);
            $end = $end->copy()->endOfDay();
        } else {
            $end = Carbon::maxValue();
        }

        if ($tanggal_start) {
            $start = str_replace("/", "-", $tanggal_start);
            $start = strtotime($start);
            $start = date('m/d/Y', $start);

            $start = Carbon::parse($start);
            $start = $start->copy()->startOfDay();
        } else {
            $start = Carbon::minValue();
        }

        // dd($tanggal_start, $tanggal_end, $farm, $start, $end);
        $item = DB::connection('farmasi')->select(DB::raw('SELECT jenis_type, jenis_id, farmasi_items_kadaluarsa , template_id, template_nama, template_harga, template_satuan, template_id, template_kode, SUM(jumlah_keluar) AS jumlah, SUM(jumlah_keluar) * template_harga as subtotal_harga FROM laporan_transaksi
            WHERE src_created_at > "' . $start .
            '" AND src_created_at < "' . $end .
            '" and farmasi_id = ' . $farm .
            ' GROUP BY template_id HAVING SUM(jumlah_keluar) > 0'));

        // $item = LaporanTransaksi::with(['jenis'])->whereBetween('src_created_at', [$start, $end])->orderBy('src_created_at', 'asc')->whereRaw('jumlah_masuk - jumlah_keluar > 0')->get();
        // dd($item);

        usort($item, array($this, 'cmp'));
        return $item;
    }

    public function obatDukungan($bulan, $tahun, $farmasi_id)
    {
        $date = Carbon::parse($bulan . '/1/' . $tahun);
        $min_date = ($date->copy()->startOfMonth());
        $max_date = ($date->copy()->endOfMonth());

        $transaksi = TransaksiObat::with('final_detail.resep_detail.obat_detail.item_detail',
            'final_detail.resep_detail.log.detail_item.detail_item.item_detail',
            'final_detail.resep_detail.logLast.detail_item.detail_item.item_detail',
            'pasien_detail')
            ->whereHas('final_detail', function ($q) {
                $q->where('nomor_resep', 'like', '%md%');
            })
            ->whereBetween('created_at', [$min_date, $max_date])
            ->get();
        return ['transaksi' => $transaksi, 'bulan' => substr(indonesian_date($min_date), 2)];
    }

    public function putGudang($tipe, $bulan, $triwulan, $tahun, $farmasi_id)
    {
        $items = ItemsFarmasi::with('item_detail')->where('farmasi_id', $farmasi_id)->get()->pluck('item_detail', 'id');
        $gudang = Farmasi::where('jenis', 4)->get()->pluck('id')->toArray();
        $gudangid = implode(',', $gudang);
        if ($tipe == 'triwulan') {
            $batas = 3;
            $interval = Carbon::parse((($triwulan - 1) * 3 + 1) . '/1/' . $tahun);
        } else {
            $batas = 4;
            $interval = Carbon::parse($bulan . '/1/' . $tahun);
        }
        $result = [];
        $periode = [];
        for ($i = 0; $i < $batas; $i++) {
            if ($tipe == 'triwulan') {
                $interval_bawah = $interval->copy()->addMonth($i)->startOfMonth();
                $interval_atas = $interval->copy()->addMonth($i)->endOfMonth();
            } else {
                $interval_bawah = $interval->copy()->addWeek($i)->startOfWeek();
                $interval_atas = $interval->copy()->addWeek($i)->endOfWeek();
            }

            $query_hasil = "SELECT i.`item_farmasi_id` item_farmasi_id, SUM(ld.`jumlah`) AS jumlah
                FROM log_distribusi ld, distribusi d, items i
                WHERE ld.distribusi_id = d.id
                AND d.tipe = 1
                -- AND d.unit_tujuan = 0
                AND d.unit_tujuan IN ('" . $gudangid . "')
                AND d.created_at > '" . $interval_bawah . "'
                AND d.created_at < '" . $interval_atas . "'
                AND d.farmasi_id = " . $farmasi_id . "
                AND i.`farmasi_id` = " . $farmasi_id . "
                AND ld.`item_id` = i.id
                AND d.deleted_at IS NULL
                AND ld.deleted_at IS NULL
                GROUP BY  i.item_farmasi_id";
            $hasil = DB::connection('farmasi')->select(DB::raw($query_hasil));
            $result[$i] = collect($hasil)->pluck('jumlah', 'item_farmasi_id');
            if ($tipe == 'triwulan') {
                $periode[$i] = substr(indonesian_date($interval_bawah), 2, 4);
            } else {
                $periode[$i] = "Minggu Ke-" . ($i + 1);
            }

        }
        // dd($result);
        if ($tipe == 'triwulan') {
            $data['triwulan'] = "TW " . $triwulan;
        } else {
            $data['bulan'] = explode(' ', indonesian_date($interval_bawah))[1];
        }

        $data['items'] = $items;
        $data['hasil'] = $result;
        $data['periode'] = $periode;
        return $data;
    }

    public function kegiatanKesehatanUtil($min_date, $max_date, $farmasi_id)
    {
        return "SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah FROM
                (
              SELECT  it.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                    FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                    WHERE  i.id = ld.item_id
                    AND it.farmasi_id = " . $farmasi_id . "
                    AND ld.`resep_detail_id` = rd.`id`
                    AND rd.`resep_id` = r.`id`
                    AND r.`id` = d.`resep_final`
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND r.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id

                    UNION ALL

                    SELECT  it.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                    WHERE d.id = ld.penghapusan_id
                    AND d.farmasi_id = " . $farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id

                    UNION ALL

                    SELECT  it.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                    WHERE d.id = ld.pengadaan_id
                    AND d.farmasi_id = " . $farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id

                    UNION ALL

                    SELECT  it.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                    WHERE d.id = ld.distribusi_id
                    AND d.farmasi_id = " . $farmasi_id . "
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id
                    UNION ALL

                    SELECT  it.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                    WHERE d.id = ld.distribusi_id
                    AND d.farmasi_id = " . $farmasi_id . "
                    AND d.tipe = 1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    GROUP BY it.id
                ) hasil
                GROUP BY id";
    }

    public function kartuStokUtil($min_date, $max_date, $item_farmasi_id)
    {
        return "SELECT * FROM (
                    SELECT
                    table_transaksi.id,
                    table_transaksi.item_id,
                    table_transaksi.tabel_id,
                    table_transaksi.tabel,
                    table_transaksi.created_at,
                    IF(table_transaksi.pasien_id IS NULL, '0', p.no_rm) nomor_rm,
                    IF(table_transaksi.pasien_id IS NULL, 'Pasien Bebas', p.name) nama,
                    table_transaksi.jumlah_min,
                    table_transaksi.jumlah_plus,
                    table_transaksi.nomor_resep
                    FROM (
                        SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_transaksi' as tabel, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                        FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                        WHERE  i.id = ld.item_id
                        AND it.id = " . $item_farmasi_id . "
                        AND ld.`resep_detail_id` = rd.`id`
                        AND rd.`resep_id` = r.`id`
                        AND r.`id` = d.`resep_final`
                        AND i.item_farmasi_id = it.id
                        AND ld.created_at > '" . $min_date . "'
                        AND ld.created_at < '" . $max_date . "'
                        AND r.`deleted_at` IS  NULL
                        AND d.deleted_at IS  NULL
                        AND ld.`deleted_at` IS  NULL

                        UNION ALL

                        SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_transaksi' as tabel, ld.created_at, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, r.nomor_resep nomor_resep, d.pasien_id
                        FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                        WHERE  i.id = ld.item_id
                        AND it.id = " . $item_farmasi_id . "
                        AND ld.`resep_detail_id` = rd.`id`
                        AND rd.`resep_id` = r.`id`
                        AND r.`transaksi_id` = d.id
                        AND r.retur = 1
                        AND i.item_farmasi_id = it.id
                        AND ld.created_at > '" . $min_date . "'
                        AND ld.created_at < '" . $max_date . "'
                        AND r.`deleted_at` IS  NULL
                        AND d.deleted_at IS  NULL
                        AND ld.`deleted_at` IS  NULL
                    ) table_transaksi
                    LEFT JOIN " . config('app.db_name') . "_patients.pasien p
                    ON table_transaksi.pasien_id = p.id

                    UNION ALL

                    SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_penghapusan' as tabel, d.created_at, 0 as nomor_rm, 'Penghapusan Obat' nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                    FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                    WHERE d.id = ld.penghapusan_id
                    AND it.id = " . $item_farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.created_at > '" . $min_date . "'
                    AND d.created_at < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL

                    UNION ALL

                    SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_pengadaan' as tabel, d.tanggal as created_at, 0 AS nomor_rm, 'Pengadaan Obat' nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                    FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                    WHERE d.id = ld.pengadaan_id
                    AND it.id = " . $item_farmasi_id . "
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND d.tanggal > '" . $min_date . "'
                    AND d.tanggal < '" . $max_date . "'
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL

                    UNION ALL

                    SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_distribusi' as tabel, ld.created_at, 0 as nomor_rm, IF(d.unit_tujuan, f.nama, 'GUDANG') nama, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, '-' nomor_resep
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                    WHERE d.id = ld.distribusi_id
                    AND it.id = " . $item_farmasi_id . "
                    AND f.id = d.unit_tujuan
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                    UNION ALL

                    SELECT  it.id, i.id as item_id, ld.id as tabel_id, 'log_distribusi' as tabel, ld.created_at, 0 AS nomor_rm, IF(d.unit_tujuan, IF(d.unit_tujuan = d.farmasi_id, 'Stok Opname', f.nama), 'GUDANG') nama, 0 AS jumlah_min, (ld.jumlah) AS jumlah_plus, '-' nomor_resep
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                    WHERE d.id = ld.distribusi_id
                    AND it.id = " . $item_farmasi_id . "
                    AND f.id = d.unit_tujuan
                    AND d.tipe = 1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND ld.created_at > '" . $min_date . "'
                    AND ld.created_at < '" . $max_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                ) AS hasil ORDER BY created_at ASC";
    }

    public function cmp($a, $b)
    {
        return strcmp($a->template_nama, $b->template_nama);
    }
    public function cmp4($a, $b)
    {
        return strcmp($a['item_detail']['nama'], $b['item_detail']['nama']);
    }

    public function cmp2($a, $b)
    {
        return strcmp($a['detail_item']['item_detail']["nama"], $b['detail_item']['item_detail']["nama"]);
    }

    public function cmp3($a, $b)
    {
        return strcmp($a['nama'], $b['nama']);
    }

    public function getStatistik($id)
    {
        $day = Carbon::now();

        $kategori = ItemsKategori::groupBy('kategori_id')
            ->join('kategori', function ($q) {
                $q->on('items_kategori.kategori_id', '=', 'kategori.id');
            })
            ->get(array(
                DB::raw('kategori.nama as nama'),
                DB::raw('COUNT(*) as "kategori_count"'),
            ));
        // dd($kategori);

        // $kategori = Kategori::groupBy('slug')
        //             ->get(array(
        //                     DB::raw('nama'),
        //                     DB::raw('COUNT(*) as "kategori_count"')
        //                 ));
        $stats = new stdClass();
        $stats->kategori = $kategori;

        $item = ItemsFarmasi::with('stok')->where('farmasi_id', $id)->whereDate('created_at', '>=', $day->copy()->startOfDay())->get();
        $stats->item = $item->count();

        return $stats;
    }

    public function getStatistikKekayaanPerBulan($farmasi_ids, $month_start, $month_end)
    {
        $current_month = $month_start;
        $data = [];
        $index = 1;
        $select_query = "SELECT * FROM";
        $iteration = $month_start->diffInMonths($month_end);
        for ($i = 1; $i <= $iteration; $i++) {
            $index = $i;
            $current_month_end = $current_month->copy()->endOfMonth();

            $select_query .= "
            (
                SELECT
                    pengadaan_$index + distribusi_masuk_$index - distribusi_keluar_$index - penghapusan_$index - transaksi_$index as kekayaan_$index
                FROM
                (
                    SELECT IFNULL(SUM(total_harga),0) AS pengadaan_$index FROM `pengadaan`
                    WHERE tanggal_faktur <= '" . $current_month_end->toDateTimeString() . "'
                    AND farmasi_id IN (" . implode(",", $farmasi_ids) . ")
                ) pengadaan_$index,
                (
                    SELECT IFNULL(SUM(total_harga),0) AS distribusi_masuk_$index FROM `distribusi`
                    WHERE verified_at <= '" . $current_month_end->toDateTimeString() . "'
                    AND farmasi_id IN (" . implode(",", $farmasi_ids) . ")
                    AND tipe = 1
                ) distribusi_masuk_$index,
                (
                    SELECT IFNULL(SUM(total_harga),0) AS distribusi_keluar_$index FROM `distribusi`
                    WHERE verified_at <= '" . $current_month_end->toDateTimeString() . "'
                    AND farmasi_id IN (" . implode(",", $farmasi_ids) . ")
                    AND tipe = -1
                ) distribusi_keluar_$index,
                (
                    SELECT IFNULL(SUM(total_harga),0) AS penghapusan_$index FROM `penghapusan`
                    WHERE created_at <= '" . $current_month_end->toDateTimeString() . "'
                    AND farmasi_id IN (" . implode(",", $farmasi_ids) . ")
                ) penghapusan_$index,
                (
                    SELECT IFNULL(SUM(total_biaya_obat),0) AS transaksi_$index FROM `transaksi_obat`
                    WHERE paid_at <= '" . $current_month_end->toDateTimeString() . "'
                    AND farmasi_id IN (" . implode(",", $farmasi_ids) . ")
                ) transaksi_$index
            )table_$index";
            if ($i != $iteration) {
                $select_query .= ",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }

        $kekayaan = DB::connection('farmasi')->select($select_query);

        $new_data = [];
        foreach ($data as $index => $item) {
            $variable = "kekayaan_" . $item;
            $value = $kekayaan[0]->$variable;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = $value / 1000000;
            $new_data[] = $object;
        }
        return $new_data;
    }

    public function filterExpiredItems($farmasi_id, $batas_hari)
    {
        $func = function ($value) {
            return $value->id;
        };

        $query = "
        SELECT item.id FROM
            (
                SELECT
                    items.id,
                    items_farmasi.min_kadaluarsa,
                    DATEDIFF(items.kadaluarsa,CURDATE()) AS expired

                FROM
                    items,
                    items_farmasi
                WHERE
                    items.jumlah > 0
                    AND items.kadaluarsa > CURDATE()
                    AND items.deleted_at IS NULL
                    AND items.item_farmasi_id = items_farmasi.id
                    AND items_farmasi.farmasi_id = $farmasi_id
                GROUP BY items.id
            )
            AS item WHERE $batas_hari > item.expired
        ";

        $query = DB::connection('farmasi')->select($query);
        $id = array_map($func, $query);
        $items = Items::whereIn('id', $id)->with('item_farmasi.item_template', 'log_pengadaan.pengadaan.supplier_detail', 'log_pengadaan.produsen')->get();
        return $items;
    }

    public function filterLowStockItems($farmasi_id)
    {
        $func = function ($value) {
            return $value->id;
        };

        $query = "
        SELECT id FROM
        (
            SELECT items_farmasi.id, items_farmasi.min_stok, SUM(items.jumlah) AS stok
            FROM items, items_farmasi
            WHERE items.kadaluarsa > CURRENT_TIMESTAMP()
            AND items.deleted_at IS NULL
            AND items.item_farmasi_id = items_farmasi.id
            AND items_farmasi.farmasi_id = $farmasi_id
            GROUP BY items_farmasi.id
        )
        AS item WHERE item.stok <= min_stok
        ";

        $query = DB::connection('farmasi')->select($query);
        $id = array_map($func, $query);
        $items = ItemsFarmasi::whereIn('id', $id)->with('item_template')->get();
        return $items;
    }

    public function mutasiStokQuery($farmasi_ids, $start_date, $end_date, $item_template_ids)
    {
        $query_item_template = '';
        if (count($item_template_ids) > 0) {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }
        $farmasi_ids_implode = implode(",", $farmasi_ids);

        $check = Carbon::now()->between($start_date, $end_date);
        if ($check) {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        } else {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        }

        $sql_date_start = $start_date->copy()->startOfDay()->format('Y-m-d H:i:s');
        $sql_date_end = $end_date->copy()->endOfDay()->format('Y-m-d H:i:s');
        /*NOTE
        QUERY BERDASARKAN GROUP BY ITEMS
        KALO MINTA DIUBAH KE GROUP BY TEMPLATE
        TINGGAL DIUBAH DI BLADE
         */
        $query =
            "

            SELECT
                item_template.nama,
                item_template.satuan,
                table2.kadaluarsa,
                table2.item_id AS item_id,
                table2.item_template_id,
                item_template.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                penyesuaian_penerimaan_range - penyesuaian_pemakaian_range AS penyesuaian,
                stok_saat_ini $query_stok_akhir AS stok_akhir
            FROM
            (
                SELECT
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range,
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir,
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir,
                    IFNULL(laporan_range.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_range,
                    IFNULL(laporan_range.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_range,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_akhir,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_akhir
                FROM
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, items_farmasi.harga, kadaluarsa
                            FROM items_farmasi,items
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu
                            FROM (
                                SELECT items.id AS item_id, MAX(log_pengadaan.harga_saat_itu) as harga_saat_itu, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                GROUP BY `items`.id
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama


        ";
        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

    public function mutasiStokQueryWithNewFilter($params)
    {
        $start_date = $params['date_start']->startOfDay();
        $end_date = $params['date_end']->endOfDay();
        $item_template_ids = $params['item_template_ids'];
        $farmasi_ids = $params['farmasi_ids'];
        $lokasi_ids = $params['lokasi_ids'] ?? '';
        if (empty($lokasi_ids)) {
            $lokasi_ids = '';
        } else {
            $lokasi_ids = implode(",", $lokasi_ids);
            $lokasi_ids = "AND d.lokasi_id IN ($lokasi_ids)";
        }

        $sumber_dana_id = $params['sumber_dana_id'];
        $jenis_pembayaran_ids = $params['jenis_pembayaran_ids'] ?? '';

        $query_sumber_dana = '';
        if (is_array($sumber_dana_id)) {
            $query_sumber_dana = "AND d.sumber_dana_id in (".implode(',', $sumber_dana_id).")";
        } else if ($sumber_dana_id != 0) {
            $query_sumber_dana = "AND d.sumber_dana_id = $sumber_dana_id";
        }

        if (isset($params['katalog_id']) && is_array($params['katalog_id'])) {
            $query_sumber_dana .= " AND d.katalog_id in (".implode(',', $params['katalog_id']).")";
        }

        $query_perusahaan_id = '';
        if ($jenis_pembayaran_ids != '') {
            $query_perusahaan_id = "AND pp.perusahaan_id IN ($jenis_pembayaran_ids)";
        }

        $query_item_template = '';
        if (count($item_template_ids) > 0) {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }
        $farmasi_ids_implode = implode(",", $farmasi_ids);

        $check = Carbon::now()->between($start_date, $end_date);
        if ($check) {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        } else {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        }

        $sql_date_start = $start_date->copy()->startOfDay()->format('Y-m-d H:i:s');
        $sql_date_end = $end_date->copy()->endOfDay()->format('Y-m-d H:i:s');
        /*NOTE
        QUERY BERDASARKAN GROUP BY ITEMS
        KALO MINTA DIUBAH KE GROUP BY TEMPLATE
        TINGGAL DIUBAH DI BLADE
         */
        $query =
        "

            SELECT
                item_template.nama,
                item_template.satuan,
                table2.kadaluarsa,
                table2.item_id AS item_id,
                table2.item_template_id,
                item_template.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                penyesuaian_penerimaan_range - penyesuaian_pemakaian_range AS penyesuaian,
                stok_saat_ini $query_stok_akhir AS stok_akhir
            FROM
            (
                SELECT
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range,
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir,
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir,
                    IFNULL(laporan_range.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_range,
                    IFNULL(laporan_range.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_range,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_akhir,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_akhir
                FROM
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, items_farmasi.harga, kadaluarsa
                            FROM items_farmasi,items
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu
                            FROM (
                                SELECT items.id AS item_id, MAX(log_pengadaan.harga_saat_itu) as harga_saat_itu, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                GROUP BY `items`.id
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            $lokasi_ids
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            $lokasi_ids
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            $query_sumber_dana
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            $lokasi_ids
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            $lokasi_ids
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            $query_sumber_dana
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama


        ";
        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

    public function getItemsFarmasiStokFormDistribusi($distribusi)
    {
        $farm_id = [$distribusi->unit_tujuan, $distribusi->farmasi_id];
        $item_template_id = [];
        foreach ($distribusi->draft as $log) {
            $item_template_id[] = $log->item_farmasi->item_template_id ?? $log->detail_item->detail_item->item_template_id;
        }
        foreach ($distribusi->log as $log) {
            $item_template_id[] = $log->detail_item->detail_item->item_template_id;
        }
        if ($distribusi->distribusi_detail) {
            foreach ($distribusi->distribusi_detail->draft as $log) {
                $item_template_id[] = $log->item_farmasi->item_template_id ?? $log->detail_item->detail_item->item_template_id;
            }
            foreach ($distribusi->distribusi_detail->log as $log) {
                $item_template_id[] = $log->detail_item->detail_item->item_template_id;
            }
        }
        $items_farmasi = ItemsFarmasi::whereIn('farmasi_id', $farm_id)->whereIn('item_template_id', $item_template_id)->with('stok')->get()->groupby(['item_template_id', 'farmasi_id']);
        return $items_farmasi;
    }

    public function mutasiQueryItemsFarmasi($farmasi_ids, $start_date, $end_date, $item_template_ids)
    {
        $farmasi_ids_implode = $farmasi_ids;
        $sql_date_end = $end_date;
        $sql_date_start = $start_date;
        $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir';
        $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range';
        $query_item_template = '';
        if (count($item_template_ids) > 0) {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }

        $query =
            "

            SELECT
                item_template.nama,
                item_template.satuan,
                table2.kadaluarsa,
                table2.farmasi_id,
                table2.item_id AS item_id,
                table2.item_template_id,
                table2.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                stok_saat_ini $query_stok_akhir AS stok_akhir
            FROM
            (
                SELECT
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.farmasi_id,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range,
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir,
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir
                FROM
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa,farmasi_id FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, item_template.harga, kadaluarsa,items_farmasi.farmasi_id
                            FROM items_farmasi,items,item_template
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.item_template_id = item_template.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu
                            FROM (
                                SELECT items.id AS item_id, log_pengadaan.harga_saat_itu, log_pengadaan.tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama


        ";

        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

    public function mutasiQueryItemsFarmasiWithNewFilter($params_query)
    {
        $farmasi_ids = $params_query['farmasi_ids_implode'];
        $start_date = $params_query['date_start'];
        $end_date = $params_query['date_end'];
        $item_template_ids = $params_query['item_template_ids'];
        $lokasi_ids = $params_query['lokasi_ids'];
        $sumber_dana_id = $params_query['sumber_dana_id'];
        $jenis_pembayaran_ids = $params_query['jenis_pembayaran_ids'];

        $query_perusahaan_id = '';
        if ($jenis_pembayaran_ids != '') {
            $query_perusahaan_id = "AND pp.perusahaan_id IN ($jenis_pembayaran_ids)";
        }

        $query_sumber_dana = '';
        if ($sumber_dana_id != 0) {
            $query_sumber_dana = "AND d.sumber_dana_id = $sumber_dana_id";
        }

        $farmasi_ids_implode = $farmasi_ids;
        $sql_date_end = $end_date;
        $sql_date_start = $start_date;
        $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir';
        $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range';
        $query_item_template = '';
        if (count($item_template_ids) > 0) {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }

        $query =
        "

            SELECT
                item_template.nama,
                item_template.satuan,
                table2.kadaluarsa,
                table2.farmasi_id,
                table2.item_id AS item_id,
                table2.item_template_id,
                table2.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                stok_saat_ini $query_stok_akhir AS stok_akhir
            FROM
            (
                SELECT
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.farmasi_id,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range,
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir,
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir
                FROM
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa,farmasi_id FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, item_template.harga, kadaluarsa,items_farmasi.farmasi_id
                            FROM items_farmasi,items,item_template
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.item_template_id = item_template.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu
                            FROM (
                                SELECT items.id AS item_id, log_pengadaan.harga_saat_itu, log_pengadaan.tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.lokasi_id IN ($lokasi_ids)
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.lokasi_id IN ($lokasi_ids)
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            $query_sumber_dana
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.lokasi_id IN ($lokasi_ids)
                            AND d.deleted_at IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.lokasi_id IN ($lokasi_ids)
                            AND d.deleted_at IS  NULL
                            $query_perusahaan_id
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            $query_sumber_dana
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama


        ";

        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

    public function penggunaanBarang($farmasi_ids, $start_date, $end_date, $item_template_ids)
    {
        $item_template_ids = implode(",", $item_template_ids);

        $query = "SELECT * FROM (
                    SELECT
                    table_transaksi.id,
                    table_transaksi.tanggal,
                    table_transaksi.farmasi_id,
                    table_transaksi.jumlah_min,
                    table_transaksi.jumlah_plus,
                    table_transaksi.total_biaya
                    FROM (
                        SELECT  it.id, CONCAT(YEAR(ld.created_at),'-',MONTH(ld.created_at)) AS tanggal,it.farmasi_id, (ld.jumlah) AS jumlah_min, IFNULL((ld.jumlah_retur), 0) AS jumlah_plus, IFNULL((i.harga_saat_itu),it.harga) * (ld.jumlah) AS total_biaya
                        FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                        WHERE  i.id = ld.item_id
                        AND it.farmasi_id IN (" . $farmasi_ids . ")
                        AND ld.`resep_detail_id` = rd.`id`
                        AND rd.`resep_id` = r.`id`
                        AND r.`id` = d.`resep_final`
                        AND i.item_farmasi_id = it.id
                        AND it.item_template_id IN (" . $item_template_ids . ")
                        AND ld.created_at > '" . $start_date . "'
                        AND ld.created_at < '" . $end_date . "'
                        AND r.`deleted_at` IS  NULL
                        AND d.deleted_at IS  NULL
                        AND ld.`deleted_at` IS  NULL
                    ) table_transaksi

                    UNION ALL

                    SELECT  it.id, CONCAT(YEAR(ld.created_at),'-',MONTH(ld.created_at)) AS tanggal,it.farmasi_id, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, ld.subtotal AS total_biaya
                    FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                    WHERE d.id = ld.penghapusan_id
                    AND it.farmasi_id IN (" . $farmasi_ids . ")
                    AND i.id = ld.item_id
                    AND i.item_farmasi_id = it.id
                    AND it.item_template_id IN (" . $item_template_ids . ")
                    AND d.created_at > '" . $start_date . "'
                    AND d.created_at < '" . $end_date . "'
                    AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL

                    UNION ALL

                    SELECT  it.id, CONCAT(YEAR(ld.created_at),'-',MONTH(ld.created_at)) AS tanggal,it.farmasi_id, (ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, ld.subtotal AS total_biaya
                    FROM log_distribusi ld, distribusi d, items i, items_farmasi it, farmasi f
                    WHERE d.id = ld.distribusi_id
                    AND it.farmasi_id IN (" . $farmasi_ids . ")
                    AND f.id = d.unit_tujuan
                    AND d.tipe = -1
                    AND ld.jenis = 1
                    AND i.item_farmasi_id = it.id
                    AND i.id = ld.item_id
                    AND it.item_template_id IN (" . $item_template_ids . ")
                    AND ld.created_at > '" . $start_date . "'
                    AND ld.created_at < '" . $end_date . "'
                    AND d.status <> -1
                    AND ld.`deleted_at` IS  NULL
                    AND d.deleted_at IS  NULL
                ) AS hasil";

        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }

    public function mutasiQueryItemsFarmasiWithYearAgo($params_query)
    {
        $farmasi_ids = $params_query['farmasi_ids_implode'];
        $start_date = $params_query['date_start'];
        $end_date = $params_query['date_end'];
        $date_start_year_ago = $params_query['date_start_year_ago'];
        $date_end_year_ago = $params_query['date_end_year_ago'];
        $item_template_ids = $params_query['item_template_ids'];
        $sumber_dana_id = $params_query['sumber_dana_id'];

        $query_sumber_dana = '';
        if ($sumber_dana_id != 0) {
            $query_sumber_dana = "AND d.sumber_dana_id = $sumber_dana_id";
        }

        $farmasi_ids_implode = $farmasi_ids;
        $sql_date_end = $end_date;
        $sql_date_start = $start_date;
        $sql_date_start_year_ago = $date_start_year_ago;
        $sql_date_end_year_ago = $date_end_year_ago;
        $check = Carbon::now()->between(Carbon::parse($start_date), Carbon::parse($end_date));
        if ($check) {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        } else {
            $query_stok_akhir = '+ pemakaian_akhir - penerimaan_akhir + penyesuaian_pemakaian_akhir - penyesuaian_penerimaan_akhir';
            $query_stok_awal = '- penerimaan_akhir + pemakaian_akhir  + pemakaian_range - penerimaan_range - penyesuaian_penerimaan_akhir + penyesuaian_pemakaian_akhir  + penyesuaian_pemakaian_range - penyesuaian_penerimaan_range';
        }
        $query_item_template = '';
        if (count($item_template_ids) > 0) {
            $item_template_ids_implode = implode(",", $item_template_ids);
            $query_item_template = "AND item_template_id IN ($item_template_ids_implode)";
        }

        $query =
        "

            SELECT
                item_template.nama,
                item_template.satuan,
                table2.kadaluarsa,
                table2.farmasi_id,
                table2.item_id AS item_id,
                table2.item_template_id,
                table2.harga,
                table2.harga_saat_itu,
                stok_saat_ini,
                stok_saat_ini $query_stok_awal AS stok_awal,
                penerimaan_range AS penerimaan,
                pemakaian_range AS pemakaian,
                stok_saat_ini $query_stok_akhir AS stok_akhir,
                penerimaan_year as penerimaan_year_ago,
                pemakaian_year as pemakaian_year_ago,
                pengadaan_ago as pengadaan_ago,
                pengadaan as pengadaan,
                transaksi_real as transaksi_real,
                penyesuaian_penerimaan_range - penyesuaian_pemakaian_range AS penyesuaian
            FROM
            (
                SELECT
                    items_table.item_id AS item_id,
                    items_table.item_template_id AS item_template_id,
                    items_table.kadaluarsa,
                    items_table.farmasi_id,
                    items_table.harga,
                    items_table.harga_saat_itu,
                    IFNULL(items_table.stok,0) AS stok_saat_ini,
                    IFNULL(laporan_range_year_ago.jumlah_plus,0) AS penerimaan_year,
                    IFNULL(laporan_range_year_ago.jumlah_min,0) AS pemakaian_year,
                    IFNULL(laporan_range_year_ago.pengadaan_ago,0) AS pengadaan_ago,
                    IFNULL(laporan_range.pengadaan,0) AS pengadaan,
                    IFNULL(laporan_range.transaksi_real,0) AS transaksi_real,
                    IFNULL(laporan_range.jumlah_plus,0) AS penerimaan_range,
                    IFNULL(laporan_range.jumlah_min,0) AS pemakaian_range,
                    IFNULL(laporan_akhir.jumlah_plus,0) AS penerimaan_akhir,
                    IFNULL(laporan_akhir.jumlah_min,0) AS pemakaian_akhir,
                    IFNULL(laporan_range.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_range,
                    IFNULL(laporan_range.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_range,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_plus,0) AS penyesuaian_penerimaan_akhir,
                    IFNULL(laporan_akhir.penyesuaian_jumlah_min,0) AS penyesuaian_pemakaian_akhir
                FROM
                    (
                        SELECT table_items_farmasi_list.item_id, item_template_id, stok, harga, harga_saat_itu,kadaluarsa,farmasi_id FROM
                        (
                            SELECT items.id AS item_id, items_farmasi.item_template_id, items.jumlah AS stok, item_template.harga, kadaluarsa,items_farmasi.farmasi_id
                            FROM items_farmasi,items,item_template
                            WHERE items.item_farmasi_id = items_farmasi.id
                            AND items_farmasi.item_template_id = item_template.id
                            AND items_farmasi.farmasi_id IN ($farmasi_ids_implode)
                            $query_item_template
                        )table_items_farmasi_list
                        LEFT JOIN
                        (
                            SELECT t1.item_id, harga_saat_itu
                            FROM (
                                SELECT items.id AS item_id, log_pengadaan.harga_saat_itu, log_pengadaan.tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                AND log_pengadaan.tanggal >= '$sql_date_start'
                                AND log_pengadaan.tanggal <= '$sql_date_end'
                                AND items.farmasi_id IN ($farmasi_ids_implode)
                                ) t1
                            JOIN (
                                SELECT items.id AS item_id, MAX(log_pengadaan.tanggal) as tanggal
                                FROM `log_pengadaan`, `items`
                                WHERE `items`.id = `log_pengadaan`.item_id
                                GROUP BY item_farmasi_id
                                ) t2
                            ON t1.item_id = t2.item_id
                            AND t1.tanggal = t2.tanggal
                        )table_item_farmasi_harga
                        ON table_items_farmasi_list.item_id = table_item_farmasi_harga.item_id
                    ) items_table
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(pengadaan_ago),2) AS pengadaan_ago FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS pengadaan_ago
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start_year_ago'
                            AND ld.created_at <= '$sql_date_end_year_ago'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS pengadaan_ago
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r, " . config('app.db_name') . "_patients.pasien_pembayaran pp
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND d.metode_pembayaran_id = pp.id
                            AND ld.created_at >= '$sql_date_start_year_ago'
                            AND ld.created_at <= '$sql_date_end_year_ago'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS pengadaan_ago
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start_year_ago'
                            AND d.created_at <= '$sql_date_end_year_ago'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, SUM(ld.jumlah) AS pengadaan_ago
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start_year_ago'
                            AND d.tanggal <= '$sql_date_end_year_ago'
                            AND ld.`deleted_at` IS  NULL
                            $query_sumber_dana
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS pengadaan_ago
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start_year_ago'
                            AND ld.created_at <= '$sql_date_end_year_ago'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS pengadaan_ago
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start_year_ago'
                            AND ld.created_at <= '$sql_date_end_year_ago'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range_year_ago
                    ON items_table.item_id = laporan_range_year_ago.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min, ROUND(SUM(pengadaan),2) AS pengadaan, ROUND(SUM(transaksi_real),2) AS transaksi_real FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, SUM(ld.jumlah) AS transaksi_real
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, SUM(ld.jumlah) AS pengadaan, 0 AS transaksi_real
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal >= '$sql_date_start'
                            AND d.tanggal <= '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at >= '$sql_date_start'
                            AND d.created_at <= '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus, 0 AS pengadaan, 0 AS transaksi_real
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at >= '$sql_date_start'
                            AND ld.created_at <= '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_range
                    ON items_table.item_id = laporan_range.id
                    LEFT JOIN
                    (
                        SELECT id, ROUND(SUM(jumlah_plus),2) AS jumlah_plus, ROUND(SUM(jumlah_min),2) AS jumlah_min,  ROUND(SUM(jumlah_plus) - SUM(jumlah_min),2) AS jumlah, ROUND(SUM(penyesuaian_jumlah_plus),2) AS penyesuaian_jumlah_plus, ROUND(SUM(penyesuaian_jumlah_min),2) AS penyesuaian_jumlah_min FROM
                        (
                            SELECT  i.id, 'transaksi' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`id` = d.`resep_final`
                            AND i.item_farmasi_id = it.id
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'transaksi retur' nama, SUM(ld.jumlah) AS jumlah_min, IFNULL(SUM(ld.jumlah_retur), 0) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_transaksi ld, transaksi_obat d, items i, items_farmasi it, resep_detail rd, resep r
                            WHERE  i.id = ld.item_id
                            AND it.farmasi_id IN ($farmasi_ids_implode)
                            AND ld.`resep_detail_id` = rd.`id`
                            AND rd.`resep_id` = r.`id`
                            AND r.`transaksi_id` = d.`id`
                            AND i.item_farmasi_id = it.id
                            AND r.retur = 1
                            AND ld.created_at > '$sql_date_end'
                            AND r.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            AND ld.`deleted_at` IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND (d.keterangan NOT IN ('Stok Opname Live','Stok Opname') OR d.keterangan IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'pengadaan' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_pengadaan ld, pengadaan d, items i, items_farmasi it
                            WHERE d.id = ld.pengadaan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.tanggal > '$sql_date_end'
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_min' nama, SUM(ld.jumlah) AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = -1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, SUM(ld.jumlah) AS jumlah_plus, 0 AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND (d.deskripsi NOT IN ('Stok Opname Live','Stok Opname') OR d.deskripsi IS NULL)
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'penghapusan' nama, 0 AS jumlah_min, 0 AS jumlah_plus, SUM(ld.jumlah) AS penyesuaian_jumlah_min, 0 AS penyesuaian_jumlah_plus
                            FROM log_penghapusan ld, penghapusan d, items i, items_farmasi it
                            WHERE d.id = ld.penghapusan_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND i.id = ld.item_id
                            AND i.item_farmasi_id = it.id
                            AND d.created_at > '$sql_date_end'
                            AND d.keterangan IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id

                            UNION ALL

                            SELECT  i.id, 'distri_plus' nama, 0 AS jumlah_min, 0 AS jumlah_plus, 0 AS penyesuaian_jumlah_min, SUM(ld.jumlah) AS penyesuaian_jumlah_plus
                            FROM log_distribusi ld, distribusi d, items i, items_farmasi it
                            WHERE d.id = ld.distribusi_id
                            AND d.farmasi_id IN ($farmasi_ids_implode)
                            AND d.tipe = 1
                            AND ld.jenis = 1
                            AND i.item_farmasi_id = it.id
                            AND i.id = ld.item_id
                            AND ld.created_at > '$sql_date_end'
                            AND d.status <> -1
                            AND d.deskripsi IN ('Stok Opname Live','Stok Opname')
                            AND ld.`deleted_at` IS  NULL
                            AND d.deleted_at IS  NULL
                            GROUP BY i.id
                        ) hasil
                        GROUP BY id
                    ) laporan_akhir
                ON items_table.item_id = laporan_akhir.id
            ) table2,
            item_template
            WHERE item_template.id = item_template_id
            ORDER BY item_template.nama


        ";

        $stok_log = DB::connection('farmasi')->select($query);
        return $stok_log;
    }
}
