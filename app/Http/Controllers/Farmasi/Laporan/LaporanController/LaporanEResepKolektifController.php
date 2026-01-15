<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\QueueArtisan;
use App\Models\Farmasi\Farmasi;
use App\Models\Pasien\PembayaranPerusahaanType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\Farmasi\SumberDana;
use App\Models\Farmasi\Kategori;
use App\Models\Hospital\DataArtisanCall;

class LaporanEResepKolektifController extends Controller
{
    public function index(Request $request)
    {
        $farmasi = app(\App\Http\Controllers\Farmasi\Farmasi\ReadController::class)->getAll();
        $farmasi_opt = $farmasi->pluck('nama', 'id')->toArray();
        $farmasi_opt[0] = 'Semua';

        $farmasi_current = app(\App\Http\Controllers\Farmasi\Farmasi\ReadController::class)->getSingle($request->farmasi_slug);
        $kategori = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getAll();
        $laporan_files = app(\App\Http\Controllers\Hospital\Laporan\ReadController::class)->getAll('farmasi-eresep-kolektif');
        $sumber_dana = SumberDana::all();


        $data['pharmacy'] = Farmasi::get();
        $data['lokasi_beauty'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->getAsalPelayanan();
        $data['asuransi_tipe'] = PembayaranPerusahaanType::get();
        $data['sumber_dana'] = $sumber_dana;
        $data['sidebar_active'] = "laporan";
        $data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
        $data['farmasi_opt']  = $farmasi_opt;
        $data['farmasi_current']  = $farmasi_current;
        $data['kategori']  = $kategori;
        $data['files']  = $laporan_files;

        return view('farmasi.laporan.view.laporan-eresep-kolektif', $data);
    }

    public function generate(Request $request)
    {
        $date_min = Carbon::createFromFormat('d-m-Y', $request->input('daterange-start'));
        $date_max = Carbon::createFromFormat('d-m-Y', $request->input('daterange-end'));
        $lokasi_id = $request->lokasi_id ?? 'all';
        $sumber_dana_id = $request->sumber_dana_id;
        $resep_jenis = $request->resep_jenis ?? 'all';
        $farmasi_ids = $request->farmasi_ids ?? [];
        $asuransi_tipe_id = $request->asuransi_tipe_id ?? [];
        $filename = $request->nama_file; 
        $jenis_cetak = $request->jenis_cetak; 
        $kategori = $request->kategori ?? ['0']; 
        $file_list = $request->file_list ?? ['resep','sep','hasil-lab','identitas','profil','billing'];

        $lokasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processLokasi($lokasi_id);
        $lokasi_id = implode(',', $lokasi_id_array);

        $farmasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processFarmasi($farmasi_ids);
        $farmasi_id = implode(',', $farmasi_id_array);

        $asuransi_tipe_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processAsuransi($asuransi_tipe_id);
        $asuransi_tipe_id = implode(',', $asuransi_tipe_id_array);

        $kategori = implode(',', $kategori);
        $file_list = implode(',', $file_list);

        $laporan_data = [];
        $laporan_data['slug'] = 'farmasi-eresep-kolektif';
        $laporan_data['file_name'] = NULL;
        $laporan_data['file_path'] = NULL;
        $laporan_data['start_date'] = $date_min->toDateTimeString();
        $laporan_data['end_date'] = $date_max->toDateTimeString();
        $laporan = app(\App\Http\Controllers\Hospital\Laporan\CreateController::class)->create($laporan_data);

        $data = [
            'farmasi_id' => $farmasi_id,
            'date_min' => $date_min->toDateString(),
            'date_max' => $date_max->toDateString(),
            'laporan_id' => $laporan->id,
            'lokasi_id' => $lokasi_id,
            'sumber_dana_id' => $sumber_dana_id,
            'kategori_id' => $kategori,
            'asuransi_tipe_id' => $asuransi_tipe_id,
            'resep_jenis' => $resep_jenis,
            'filename' => $filename,
            'jenis_cetak' => $jenis_cetak,
            'file_list' => $file_list,
        ];

//        if (Auth::id() == 3) {
//            Artisan::call('farmasi:eresep-kolektif', $data);
//            dd('done');
//        } else {
        $data = [
            'param_request' => json_encode($data),
            'command_artisan' => 'farmasi:eresep-kolektif',
            'created_by' => 1,
            'created_at' => now(),
        ];
        $data_artisan_call_id = DataArtisanCall::insertGetId($data);
//        }

        return back()
            ->with('message', 'File Sedang Dibuat')
            ->with('status', 1)
            ->with('title', 'Berhasil');
    }
}
