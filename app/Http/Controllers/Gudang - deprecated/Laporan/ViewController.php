<?php

namespace App\Http\Controllers\Gudang\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use MPDF;
use Carbon\Carbon;
use DB;
use App\Exports\Gudang\KegiatanKesehatan;
use App\Exports\Gudang\RekapitulasiNarkotika;
use App\Exports\Gudang\Penerimaan;
use App\Exports\Gudang\StokOpname;
use Illuminate\Support\Arr;

class ViewController extends Controller
{
	public function index()
	{
        $kategori = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getAll();
        $data['gorilla'] = $kategori;
		$data['sidebar_active'] = "laporan";
		return view('warehouse.laporan.index', $data);
	}

    public function stokSekarang()
    {
        ini_set('max_execution_time', 1500);
        app('debugbar')->disable();
        $filename = 'Laporan Stok';
        $items =  app('App\Http\Controllers\Gudang\Items\ReadController')->getAll();
        $data['items'] = $items;
        $data['date'] = Carbon::now();
// dd($items);
        return view('warehouse.laporan.stok-sekarang',$data);
        $pdf = MPDF::loadView('warehouse.laporan.stok-sekarang',$data);
        return $pdf->stream($filename);   
    }

	public function kartuStok($slug, Request $request)
    {
        ini_set('max_execution_time', 300);
        $filename = 'Laporan Kartu Stok';
        $item = app('App\Http\Controllers\Gudang\Items\ReadController')->getItemDetail($slug);
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getKartuStok($item->id,$request->input('tanggal_awal'),$request->input('tanggal_akhir'));
        $data['items'] = $items;
        $data['item'] = $item;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));

        $pdf = DOMPDF::loadView('warehouse.laporan.laporan-kartu-stok',$data);
        return $pdf->stream($filename);
    }

    public function kegiatanKesehatan(Request $request)
    {
        //$bulan = ['JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER'];

        ini_set('max_execution_time', 300);
        $filename = 'Laporan Kegiatan Kesehatan';
        $data = app('App\Http\Controllers\Gudang\Items\ReadController')->getKegiatanKesehatan($request->input('tanggal_awal'),$request->input('tanggal_akhir'));

        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        //$data['bulan'] = $bulan[$request->input('bulan')-1];

        if ($request->export_as == 'pdf') {
            $pdf = MPDF::loadView('warehouse.laporan.kegiatan-kesehatan', $data, [], [
               'mode' => 'utf-8',
              'format' => 'A4-L']);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new KegiatanKesehatan($data))->download('Laporan Kegiatan Kesehatan.xlsx');
        }
        
    }

    public function rekapitulasiNarkotika(Request $request)
    {
        //$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        ini_set('max_execution_time', 300);
        $filename = 'Laporan Rekapitulasi Narkotika';
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getNarkotika($request->input('tanggal_awal'),$request->input('tanggal_akhir'),$request->input('kategori'));
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));

        $kategori = $request->input('kategori');
        $blugori = "";
        $i = 0;
        if($kategori)
        foreach ($kategori as $gori) {
            $temp = app('App\Http\Controllers\Gudang\Kategori\ReadController')->getById($gori);
            if($i) $blugori .= ", ";
            $blugori .= strtoupper($temp->nama); 
            $i++; 
        }
        $data['kategori'] = $blugori;
        //$data['bulan'] = $bulan[$request->input('bulan')-1];

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('warehouse.laporan.rekapitulasi-narkotika', $data)->setPaper('a4', 'landscape');
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new RekapitulasiNarkotika($data))->download($filename.'.xlsx');
        }
    }

    public function stokOpname(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filename = 'Laporan Stok Opname';
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getOpname($request->input('tanggal'));
        $data['items'] = $items;
        $data['date'] = str_replace('/', '-', $request->input('tanggal'));

        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('warehouse.laporan.laporan-stok-opname',$data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new StokOpname($data))->download($filename.'.xlsx');
        }
    }

    public function penerimaan(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filename = 'Laporan Penerimaan';
        $items = app('App\Http\Controllers\Gudang\Items\ReadController')->getPenerimaan($request->input('tanggal_awal'),$request->input('tanggal_akhir'));
        $data['items'] = $items;
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        
        if ($request->export_as == 'pdf') {
            $pdf = DOMPDF::loadView('warehouse.laporan.laporan-penerimaan',$data);
            return $pdf->stream($filename);
        } elseif ($request->export_as == 'xls') {
            return (new Penerimaan($data))->download($filename.'.xlsx');
        }
    }

    public function pemakaianObat()
    {
        $filename = 'Laporan Pemakaian Obat';
        $pdf = DOMPDF::loadView('warehouse.laporan.pemakaian-obat');
        return $pdf->stream($filename);   
    }

    public function pengeluaranObat()
    {
        $filename = 'Laporan Pengeluaran Obat';
        $pdf = DOMPDF::loadView('warehouse.laporan.pengeluaran-obat');
        return $pdf->stream($filename);   
    }

    public function pemberianObat()
    {
        $filename = 'Laporan Pemberian Obat';
        $pdf = DOMPDF::loadView('warehouse.laporan.pemberian-obat');
        return $pdf->stream($filename);   
    }

    public function resepObat()
    {
        $filename = 'Resep Obat';
        $pdf = DOMPDF::loadView('warehouse.laporan.resep-obat');
        return $pdf->stream($filename);   
    }

    public function laporanObatKeluar(Request $request)
    {
        ini_set('max_execution_time', 300);
        ini_set("pcre.backtrack_limit", "5000000");
        $data = app('App\Http\Controllers\Gudang\Items\ReadController')->obatKeluar($request->tanggal_awal, $request->tanggal_akhir);
        $data['min_date'] = str_replace('/', '-', $request->input('tanggal_awal'));
        $data['max_date'] = str_replace('/', '-', $request->input('tanggal_akhir'));
        
        $pdf = MPDF::loadView('warehouse.laporan.obat-keluar',$data);
        return $pdf->stream('Laporan Distribusi Obat Keluar');
    }
}