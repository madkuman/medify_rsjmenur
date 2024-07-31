<?php

namespace App\Http\Controllers\Farmasi\Laporan;

use App\Exports\Farmasi\KartuBarang;
use App\Exports\Farmasi\KartuStok;
use App\Models\Farmasi\Farmasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DOMPDF;
use MPDF;
use App\Exports\Farmasi\KegiatanKesehatan;
use App\Exports\Farmasi\RekapitulasiNarkotika;
use App\Exports\Farmasi\PemakaianObat;
use App\Exports\Farmasi\PemberianObat;
use App\Exports\Farmasi\PemberianPerBangsal;
use App\Exports\Farmasi\PasienKemoterapi;
use App\Exports\Farmasi\ResepObat;
use App\Exports\Farmasi\StokOpname;
use App\Exports\Farmasi\PengeluaranObat;
use App\Models\Farmasi\AturanShift;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\LogPengadaan;
use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\MasterKodeBidang;
use App\Models\Farmasi\MasterKodeRekening;
use App\Models\Farmasi\Pengadaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use Illuminate\Support\Arr;
use ReflectionFunctionAbstract;

class ViewController extends Controller
{
	public function index(Request $request, $farmasi)
	{
		$farm = session('farmasi');
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $perusahaan = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getPerusahaan();
        $lokasi_beauty = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap','rawat-jalan','igd']);
        $data['bangsal'] = Bangsal::all();
        $data['pharmacy'] = $pharmacy;
        $data['perusahaan'] = $perusahaan;
        $data['gorilla'] = $kategori;
        $data['kategori'] = $kategori;
        $data['farmasi'] = $farm;
        $data['lokasi_beauty'] = $lokasi_beauty;
		$data['sidebar_active'] = "laporan";
        $data['lokasi'] = Lokasi::all();
        $data['sumber_dana'] = app('App\Http\Controllers\Farmasi\SumberDana\ReadController')->getAll();
        $data['katalog'] = app('App\Http\Controllers\Farmasi\Katalog\ReadController')->getAll();
        $data['penyedia'] = json_decode(app('App\Http\Controllers\Keuangan\Perusahaan\ReadController')->get());
        $data['asuransi_tipe'] = PembayaranPerusahaanType::get();
        $data['master_kode_rekening'] = MasterKodeRekening::get();
        $data['master_kode_bidang'] = MasterKodeBidang::get();
		return view('farmasi.laporan.index', $data);
	}

	public function kartuStok($farmasi, $slug, Request $request)
    {
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $filename = 'Laporan Kartu Stok';
        $item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemDetail($slug);
        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->getKartuStok($item,$request->input('tanggal_awal'),$request->input('tanggal_akhir'));
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['item'] = $item;
        if($request->export_as == 'pdf') {
            $customPaper = array(0, 0, 288, 612);
            $pdf = DOMPDF::loadView('farmasi.laporan.laporan-kartu-stok', $data)->setPaper($customPaper);
            return $pdf->stream($filename);
        }else{
            return (new KartuStok($data))->download($filename.'.xlsx');
        }
    }

	public function kartuBarang(Request $request, $farmasi, $slug)
    {
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $filename = 'Laporan Kartu Barang';
        $item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getItemDetail($slug);
        $data = app(\App\Http\Controllers\Farmasi\Items\ReadController::class)->getKartuStok($item,$request->input('tanggal_awal'),$request->input('tanggal_akhir'));
        
        # get stok awal per items
        $list_stok_awal = $item->all_items->map(function ($item) use ($data) {
            $selisih = collect($data['riwayat'])->where('item_id', $item->id)->sum(function ($item) {
                return $item->jumlah_plus - $item->jumlah_min;
            });
            $selisih_luar = collect($data['luar_riwayat'])->where('item_id', $item->id)->sum(function ($item) {
                return $item->jumlah_plus - $item->jumlah_min;
            });
            $item->stok_awal = $item->jumlah - $selisih - $selisih_luar;
            return $item;
        })->keyBy('id');
        
        # proses eager manual
        $riwayat = collect($data['riwayat']);

        $eager_transaksi = [
            'detail_resep.resep',
        ];

        $eager_distribusi = [
            'detail_distribusi',
        ];

        $data_items = Items::with('log_pengadaan')->whereIn('id', $riwayat->pluck('item_id'))->get()->keyBy('id');
        $data_log_transaksi = LogTransaksi::withTrashed()->with($eager_transaksi)->whereIn('id', $riwayat->where('tabel', 'log_transaksi')->pluck('tabel_id'))->get()->keyBy('id');
        $data_log_pengadaan = LogPengadaan::withTrashed()->whereIn('id', $riwayat->where('tabel', 'log_pengadaan')->pluck('tabel_id'))->get()->keyBy('id');
        $data_log_penghapusan = LogPenghapusan::withTrashed()->whereIn('id', $riwayat->where('tabel', 'log_penghapusan')->pluck('tabel_id'))->get()->keyBy('id');
        $data_log_distribusi = LogDistribusi::withTrashed()->with($eager_distribusi)->whereIn('id', $riwayat->where('tabel', 'log_distribusi')->pluck('tabel_id'))->get()->keyBy('id');

        $riwayat = $riwayat->map(function ($item) use ($data_items, $data_log_transaksi, $data_log_pengadaan, $data_log_penghapusan, $data_log_distribusi) {
            $item->is_distribusi_retur = 0;
            if ($item->tabel == 'log_transaksi') {
                $item->log = $data_log_transaksi[$item->tabel_id];
                $item->log_parent_id = $item->log->resep_detail_id;
            } else if ($item->tabel == 'log_pengadaan') {
                $item->log = $data_log_pengadaan[$item->tabel_id];
                $item->log_parent_id = $item->log->pengadaan_id;
            } else if ($item->tabel == 'log_penghapusan') {
                $item->log = $data_log_penghapusan[$item->tabel_id];
                $item->log_parent_id = $item->log->penghapusan_id;
            } else if ($item->tabel == 'log_distribusi') {
                $item->log = $data_log_distribusi[$item->tabel_id];
                $item->log_parent_id = $item->log->distribusi_id;
                $item->is_distribusi_retur = $item->log->detail_distribusi->kategori == 'Retur' ? 1 : 0;
            }
            $item->items = $data_items[$item->item_id];
            return $item;
        });

        # end proses eager manual

        # proses menyatukan transaksi dengan retur
        $group_riwayat = $riwayat->groupBy(function ($item) {
            $id = $item->tabel_id;
            if ($item->tabel == 'log_transaksi') {
                $id = $item->log->detail_resep->resep->transaksi_id."-".$item->log->item_id;
            }
            return $item->tabel."-".$id;
        });

                
        $riwayat = collect($group_riwayat)->map(function ($collect) {
            $item = clone $collect->first();
            $item->jumlah_min = $collect->sum('jumlah_min');
            $item->jumlah_plus = $collect->sum('jumlah_plus');
            return $item;
        })->values();
        # end proses menyatukan transaksi dengan retur

        # proses sorting
        $riwayat->sortBy(function ($item) {
            return $item->created_at. "-" .$item->tabel. "-". $item->log_parent_id;
        })->values();
        # end proses sorting

        # proses perhitungan stok awal
        $riwayat = $riwayat->groupBy(function ($item) {
            return $item->created_at. "-" .$item->tabel. "-". $item->log_parent_id;
        });

        # end proses sorting
        $data['riwayat_group'] = $riwayat->toArray();
        $data['list_stok_awal'] = $list_stok_awal;
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['item'] = $item;
        $data['is_format_detail'] = $request->format == 'mutasi_lengkap' ? 1 : 0;
        return (new KartuBarang($data))->download($filename.'.xlsx');
    }

    public function kegiatanKesehatan($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        $farm = session('farmasi');
        $filename = 'Laporan Kegiatan Kesehatan';
        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->getKegiatanKesehatan($farm->id,$request->input('tanggal_awal'),$request->input('tanggal_akhir'));
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        if ($request->export_as == 'pdf') {
            $pdf = MPDF::loadView('farmasi.laporan.kegiatan-kesehatan-xls',$data, [], [
                'mode' => 'utf-8',
                'format' => 'A4-L'
            ]);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new KegiatanKesehatan($data))->download($filename.'.xlsx');
        }
    }

    public function rekapitulasiNarkotika($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $filename = 'Laporan Rekapitulasi Narkotika';
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getNarkotika($farm->id,$request->tanggal_awal,$request->tanggal_akhir,$request->kategori);
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->tanggal_awal);
        $data['max_date'] = str_replace('/', '-', $request->tanggal_akhir);

        $kategori = $request->kategori;
        $blugori = "";
        $i = 0;
        if($kategori)
        {
            foreach ($kategori as $gori) {
                $temp = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getById($gori);
                if($i) $blugori .= ", ";
                $blugori .= strtoupper($temp->nama); 
                $i++; 
            }
        }   
        $data['kategori'] = $blugori;

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.rekapitulasi-narkotika', $data)->setPaper('a4', 'landscape');
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new RekapitulasiNarkotika($data))->download($filename.'.xlsx');
        }
    }

    public function stokSekarang($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        $filename = 'Laporan Stok Opname';
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getStokSekarang($farm->id);
        $data['items'] = $items;
        $data['date'] = Carbon::now();

        $pdf = MPDF::loadView('farmasi.laporan.laporan-stok-sekarang',$data);
        return $pdf->stream($filename);
    }

    public function pemakaianObat($farmasi, Request $request)
    {   
        app('debugbar')->disable();
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $filename = 'Laporan Pemakaian Obat';

        if($request->input('obat_bebas') && $request->input('obat_resep')) $mode=0;
        else if($request->input('obat_bebas')) $mode=1;
        else if($request->input('obat_resep')) $mode=2;
        else $mode=0;

        $array_pembayaran = [];
        if($request->input('pasien_umum')) array_push($array_pembayaran, 4);
        if($request->input('pasien_bpjs')) array_push($array_pembayaran, 1);
        if($request->input('pasien_asuransi')){
            array_push($array_pembayaran, 2);
            array_push($array_pembayaran, 3);
        }


        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->getPemakaian($farm->id,$request->input('tanggal_awal'),$request->input('tanggal_akhir'),$mode,$request->input('kategori'),$request->input('jenis'),$request->input('shift'), $array_pembayaran);
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));

        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $kategori = $request->input('kategori');
        $blugori = "";
        $i = 0;
        if($kategori)
        foreach ($kategori as $gori) {
            $temp = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getById($gori);
            if($i) $blugori .= ", ";
            $blugori .= strtoupper($temp->nama); 
            $i++; 
        }
        $data['kategori'] = $blugori;
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.pemakaian-obat', $data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new PemakaianObat($data))->download($filename.'.xlsx');
        }
    }

    public function pengeluaranObat($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $filename = 'Laporan Pengeluaran Obat';

        if($request->input('obat_bebas') && $request->input('obat_resep')) $mode=0;
        else if($request->input('obat_bebas')) $mode=1;
        else if($request->input('obat_resep')) $mode=2;
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getPengeluaran($farm->id,$request->input('tanggal_awal'),$request->input('tanggal_akhir'),$mode);
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.pengeluaran-obat', $data);
            return $pdf->stream($filename);   
        } elseif ($request->export_as == 'xls') {
            return (new PengeluaranObat($data))->download($filename.'.xlsx');
        }
    }

    public function pemberianObat($farmasi, Request $request)
    {   
        app('debugbar')->disable();
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $filename = 'Laporan Pemberian Obat';
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getPemberian($request->input('farmasi'),$request->input('tanggal_awal'),$request->input('tanggal_akhir'),$request->input('pasien'));        
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $data['pasien'] = app('App\Http\Controllers\Pasien\Pasien\ReadController')->getSingle($request->input('pasien'));
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.pemberian-obat', $data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new PemberianObat($data))->download($filename.'.xlsx');
        }
    }

    public function pemberianPerBangsal($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $filename = 'Laporan Pemberian Obat per Bangsal';
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getPemberianPerBangsal($request->input('farmasi'),$request->input('bangsal'),$request->input('tanggal_awal'),$request->input('tanggal_akhir'),$request->input('pasien'));        
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($request->input('pasien'));
        $data['pasien'] = $pasien['identitas'];

        $bangsal = $request->input('bangsal');
        $salut = "";
        $i = 0;
        if($bangsal)
        foreach ($bangsal as $bang) {
            $temp = Bangsal::find($bang);
            if($i) $salut .= ", ";
            $salut .= strtoupper($temp->nama); 
            $i++; 
        }
        $data['bangsal'] = $salut;

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.pemberian-per-bangsal', $data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new PemberianPerBangsal($data))->download($filename.'.xlsx');
        }
    }

    public function resepObat($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $filename = 'Resep Obat';
        $items = app('App\Http\Controllers\Farmasi\Items\ReadController')->getPemberian($request->input('farmasi'),$request->input('tanggal_awal'),$request->input('tanggal_akhir'),$request->input('pasien'));        
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $pasien = app('App\Http\Controllers\Pasien\Pasien\ReadController')->profile($request->input('pasien'));
        $data['pasien'] = $pasien['identitas'];

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.resep-obat', $data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new ResepObat($data))->download($filename.'.xlsx');
        }
    }
    
    public function laporanPenjualanObat($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        if($request->shift)
            $data['shift'] = AturanShift::whereIn('id',$request->shift)->get();
        else
            $data['shift'] = [];

        $data['transaksi'] = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getLaporanTransaksiSortedResep($request->tanggal_awal, $request->tanggal_akhir,$request->shift,$farm->id);
        $filename = 'Laporan Penjualan Obat';
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.penjualan-obat', $data)->setPaper('a4', 'landscape');;
            return $pdf->stream($filename);   
        }
    }

    public function laporanPenjualanBebas($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $flag = 1; //flag bebas;
        $data['transaksi'] = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getLaporanTransaksi($request->tanggal_awal, $request->tanggal_akhir,null,$farm->id,$flag);
        $filename = 'Laporan Penjualan Bebas';
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.penjualan-bebas',$data)->setPaper('a4');;
            return $pdf->stream($filename);   
        }        
    }

    public function laporanObatMasuk($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $data['items'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->obatMasuk($request->tanggal_awal, $request->tanggal_akhir,$farm->id);
        $item = Arr::pluck($data['items'], ('jenis_id'));
        $data['asal'] = LogDistribusi::with('detail_distribusi.detail_tujuan')->whereIn('id', $item)->get()->pluck('detail_distribusi.detail_tujuan.nama', 'id');
        // dd( $data['asal']);

        $pdf = DOMPDF::loadView('farmasi.laporan.obat-masuk',$data)->setPaper('a4');
        return $pdf->stream('Laporan Distribusi Obat Masuk');
    }

    public function laporanObatKeluar($farmasi, Request $request)
    {
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
         $data['items'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->obatKeluar($request->tanggal_awal, $request->tanggal_akhir,$farm->id);
        $item = Arr::pluck($data['items'], ('jenis_id'));
        $data['asal_distribusi'] = LogDistribusi::with('detail_distribusi.detail_tujuan')->whereIn('id', $item)->get()->pluck('detail_distribusi.detail_tujuan.nama', 'id');
        
        $pdf = DOMPDF::loadView('farmasi.laporan.obat-keluar',$data)->setPaper('a4');
        return $pdf->stream('Laporan Distribusi Obat Keluar');
    }

    public function obatDukungan($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->obatDukungan($request->bulan, $request->tahun, $farm->id);
        $data['farm'] = $farm;
        $data['farmer'] = $farm->nama;
        $pdf = DOMPDF::loadView('farmasi.laporan.obat-dukungan', $data)->setPaper('a4','landscape');
        return $pdf->stream('Laporan Pemakaian Obat Dukungan');
    }

    public function putGudang($farmasi, Request $request)
    {   
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        $farm = session('farmasi');
        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->putGudang($request->tipe_put, $request->bulan, $request->triwulan, $request->tahun, $farm->id);
        $data['farm'] = $farm;
        $data['farmasi'] = $farm->nama;
        $data['tahun'] = $request->tahun;
        $pdf = MPDF::loadView('farmasi.laporan.laporan-put',$data, [], [
            'mode' => 'utf-8',
            'format' => 'A4-L'
        ]);
        return $pdf->stream('Laporan Pemakaian Obat Dukungan');
    }

    public function expired($farmasi, Request $request)
    {
        // dd($request->all());
        ini_set('max_execution_time', 300);
        $farm = session('farmasi');
        $data['farm'] = $farmasi;
        $data['farmer'] = $farm->nama;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        $flag = 1; //flag bebas;
        $data['items'] = app('App\Http\Controllers\Farmasi\Items\ReadController')->getExpiredAt($request->tanggal_awal, $request->tanggal_akhir,$farm->id);
        $filename = 'Laporan Penjualan Bebas';
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('farmasi.laporan.laporan-expired',$data)->setPaper('a4');;
            return $pdf->stream($filename);   
        }   
    }

    public function stokOpname(Request $request, $farmasi)
    {
        ini_set('max_execution_time', 300);
        $filename = 'Laporan Stok Opname';
		$farm = session('farmasi');
        $data = app('App\Http\Controllers\Farmasi\Items\ReadController')->getOpname($farm->id, $request->tanggal, $request->tanggal);
        if ($request->export_as == 'pdf') {
            $pdf = MPDF::loadView('farmasi.laporan.laporan-stok-opname',$data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new StokOpname($data))->download($filename.'.xlsx');
        }       
    }

    public function penerimaanGudang(Request $request, $farmasi)
	{
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
		$farm = session('farmasi');
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

        $pengadaan = Pengadaan::with(['log', 'supplier_detail','log.detail_item'])->orderBy('tanggal_faktur','asc')->whereBetween('tanggal_faktur', [$min_date, $max_date])->where('farmasi_id', $farm->id)->get();
        $data['min_date'] = $min_date;
        $data['max_date'] = $max_date;
		$data['pengadaans'] = $pengadaan;
		$pdf = MPDF::loadView('farmasi.laporan.penerimaan-gudang',$data, [], ['format' => 'a4-L']);
        return $pdf->stream('penerimaan-gudang.pdf');
	}

    public function pasienKemoterapi(Request $request, $farmasi)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '2048M');
        ini_set("pcre.backtrack_limit", "5000000");
        $start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal);
        $end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir);
        $filename = 'Rekapitulasi Pasien Kemoterapi';
        $farm = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getSingle($farmasi);
        $transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getKemoterapi($farm->id, $start, $end);
        // dd($farm,$transaksi);
        $data['farmasi'] = $farm;
        $data['min_date'] = $request->tanggal_awal;
        $data['max_date'] = $request->tanggal_akhir;
        $data['transaksi'] = $transaksi;
        return (new PasienKemoterapi($data))->download($filename.'.xlsx');
    }
}