<?php

namespace App\Http\Controllers\Farmasi\Laporan;

use App\Exports\Farmasi\LaporanPelayananObatJknView;
use App\Models\Keuangan\Perusahaan;
use App\Models\RawatInap\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Kategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Hospital\Lokasi;
use App\Exports\Farmasi\LaporanPelayananResepExcel;
use App\Exports\Farmasi\LaporanResponseTimeHarianExcel;
use App\Exports\Farmasi\LaporanResponseTimeTahunanExcel;
use App\Exports\Farmasi\LaporanWaktuPelayananExcel;
use App\Exports\Farmasi\LaporanKesesuaianDokterFornasBulananExcel;
use App\Exports\Farmasi\LaporanKesesuaianDokterFornasHarianExcel;
use App\Exports\Farmasi\LaporanTelaahResepExcel;
use App\Exports\Farmasi\LaporanPersediaanFarmasiExcel;
use App\Exports\Farmasi\LaporanPerbekalanFarmasiExcel;
use App\Exports\Farmasi\MutasiStokEmergensiExcel;
use App\Exports\Farmasi\LaporanStokEmergensiExcel;
use App\Exports\Farmasi\RekapPenggunaanBarangExcel;
use App\Exports\Farmasi\LaporanPenggunaanBarangExcel;
use App\Exports\Farmasi\LaporanBarangTelahExpiredExcel;
use App\Exports\Farmasi\LaporanBarangMendekatiExpiredExcel;
use App\Exports\Farmasi\PelayananKefarmasianJatim;
use App\Exports\Farmasi\LaporanPenggunaanObat;
use App\Exports\Farmasi\LaporanPelayananObatJkn;
use App\Exports\Farmasi\LaporanPenerimaanBarangHabisPakai;
use App\Exports\Farmasi\LaporanRealisasi;
use App\Exports\Farmasi\LaporanBpkSumberDana;
use App\Exports\Farmasi\LaporanBPKPenerimaan;
use App\Exports\Farmasi\LaporanBPKPemakaian;
use App\Exports\Farmasi\LaporanPenghapusanBarangExcel;
use App\Exports\General\TemplateGeneralExcel;
use App\Models\Farmasi\SumberDana;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Exports\Farmasi\LaporanBeritaAcaraPemeriksaaanFormatBA;
use App\Exports\Farmasi\LaporanBeritaAcaraPemeriksaanFormatLampiran;
use App\Exports\Farmasi\LaporanRekapitulasiMutasiBarang;
use App\Models\Farmasi\LogPengadaan;
use App\Models\Farmasi\MasterKodeBidang;

class PostController extends Controller
{
    public function laporanPelayananResep($farmasi_slug, Request $request)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '2048M');
        ini_set("pcre.backtrack_limit", "5000000");
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_non_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('non-generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('formularium-rs')->id;
        $item_template_ids_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        $item_template_ids_non_generik_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikFormularium($kategori_generik,$kategori_formularium);
        $item_template_ids_non_generik_non_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikNonFormularium($kategori_generik,$kategori_formularium);

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $get_data_item = $this->getTemplateIdsFromFilterKategori('inklusi',$request->kategori);

        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];
		$item_template_ids = $get_data_item['item_template_ids'];

        if ($request->lokasi_id == 'all') {
            $lokasi_departemen = ['rawat_inap', 'rawat_jalan', 'igd'];
        } elseif ($request->lokasi_id == 'all-ri') {
            $lokasi_departemen = ['rawat_inap'];
        } elseif ($request->lokasi_id == 'all-rj') {
            $lokasi_departemen = ['rawat_jalan'];
        } elseif ($request->lokasi_id == 'all-igd') {
            $lokasi_departemen = ['igd'];
        } else {
            $lokasi_ids = $request->lokasi_id;
            $lokasi_ids = explode(',',$lokasi_ids);
            $lokasi = Lokasi::whereIn('id',$lokasi_ids)->first();
            $lokasi_departemen = $lokasi->departemen->slug ?? '';
            if($lokasi_departemen == 'rawat-inap'){
                $lokasi_departemen = ['rawat_inap'];
            }elseif ($lokasi_departemen == 'igd'){
                $lokasi_departemen = ['igd'];
            }elseif ($lokasi_departemen == 'rawat-jalan'){
                $lokasi_departemen = ['rawat_jalan'];
            }
        }

        $jenis_pembayaran = [];
        if(isset($request->jenis))
        {
            $jenis_pembayaran = $request->jenis;
        }

        $item_template_ids_generik_arr = [];
        $item_template_ids_non_generik_formularium_arr = [];
        $item_template_ids_non_generik_non_formularium_arr = [];

        foreach ($item_template_ids_non_generik_formularium as $key => $value) {
            if(in_array($value->id,$item_template_ids)){
                $item_template_ids_non_generik_formularium_arr[] = $value->id;
            }
        }

        foreach ($item_template_ids_non_generik_non_formularium as $key => $value) {
            if(in_array($value->id,$item_template_ids)){
                $item_template_ids_non_generik_non_formularium_arr[] = $value->id;
            }
        }

        foreach ($item_template_ids_generik as $key => $value) {
            if(in_array($value,$item_template_ids)){
                $item_template_ids_generik_arr[] = $value;
            }
        }

        $params['date_start'] = $date_start;
        $params['date_end'] = $date_end;
        $params['farmasi_ids'] = $farmasi_ids;
        $params['lokasi_departemen'] = $lokasi_departemen;
        $params['jenis_pembayaran'] = $jenis_pembayaran;
        $params['item_template_ids'] = $item_template_ids;
        $params['item_template_ids_generik'] = $item_template_ids_generik;
        $params['item_template_ids_non_generik_formularium_arr'] = $item_template_ids_non_generik_formularium_arr;
        $params['item_template_ids_non_generik_non_formularium_arr'] = $item_template_ids_non_generik_non_formularium_arr;

        $data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPelayananResepController')->get($params);
        

        $filename = 'Laporan Pelayanan Resep__'.$farmasi_names.'__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['farmasi'] = $farmasi_names;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        return (new LaporanPelayananResepExcel($data))->download($filename.'.xlsx');
    }


    public function laporanResponseTimeHarian($farmasi_slug, Request $request)
    {
        ini_set('max_execution_time', 400);
        ini_set('memory_limit', '3048M');
        ini_set("pcre.backtrack_limit", "5000000");

        try {
            $date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
            $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
            $farmasi_names = $get_data['farmasi_names'];
            $farmasi_ids = $get_data['farmasi_ids'];

            if ($request->lokasi_id == 'all') {
                $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap', 'rawat-jalan', 'igd']);
                $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
                $lokasi_name = 'Semua';
            } elseif ($request->lokasi_id == 'all-ri') {
                $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
                $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
                $lokasi_name = 'Rawat Inap';
            } elseif ($request->lokasi_id == 'all-rj') {
                $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
                $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
                $lokasi_name = 'Rawat Jalan';
            } elseif ($request->lokasi_id == 'all-igd') {
                $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
                $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
                $lokasi_name = 'IGD';
            } else {
                $lokasi_ids = $request->lokasi_id;
                $lokasi_ids = explode(',',$lokasi_ids);
                $lokasi = Lokasi::whereIn('id',$lokasi_ids)->first();
                $lokasi_departemen = $lokasi->departemen->slug ?? '';
                $lokasi_name = '';
                if($lokasi_departemen == 'rawat-inap'){
                    $lokasi_name = Ruangan::where('lokasi_id',$lokasi->id)->first()->bangsal->nama;
                }elseif ($lokasi_departemen == 'igd'){
                    $lokasi_name = 'IGD';
                }elseif ($lokasi_departemen == 'rawat-jalan'){
                    $lokasi_name = $lokasi->nama;
                }

            }

            $jenis_resep = $request->jenis_resep;

            $data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanResponseTimeHarianController')->get($date_start, $date_end, $farmasi_ids, $lokasi_ids, $jenis_resep);

            $filename = 'Laporan Response Time Harian__' . $farmasi_names . '__' . $date_start->format('d-m-Y') . '__' . $date_end->format('d-m-Y');
            $data['farmasi'] = $farmasi_names;
            $data['lokasi'] = $lokasi_name;
            $data['jenis_resep'] = $jenis_resep;
            $data['date_start'] = $date_start;
            $data['date_end'] = $date_end;
            return (new LaporanResponseTimeHarianExcel($data))->download($filename . '.xlsx');
        }catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function laporanResponseTimeTahunan($farmasi_slug, Request $request)
    {
        ini_set('max_execution_time', 400);
        ini_set('memory_limit', '3048M');
        ini_set("pcre.backtrack_limit", "5000000");
        
    	$date_start = Carbon::createFromFormat('d/m/Y', '01/01/'.$request->tahun)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', '31/12/'.$request->tahun)->endOfDay();
        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];
        $lokasi_id = $request->lokasi_id;
        $lokasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processLokasi($lokasi_id);

        if($lokasi_id == 'all') $lokasi_text = 'Semua';
        else if($lokasi_id == 'all-rj') $lokasi_text = 'Rawat Jalan';
        else if($lokasi_id == 'all-igd') $lokasi_text = 'IGD';
        else if($lokasi_id == 'all-ri') $lokasi_text = 'Rawat Inap';
        else $lokasi_text = '--';

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanResponseTimeTahunanController')->get($date_start,$date_end,$farmasi_ids,$lokasi_id_array);

		$filename = 'Laporan Response Time Tahunan__'.$farmasi_names.'__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
		$data['farmasi'] = $farmasi_names;
		$data['tahun'] = $request->tahun;
        $data['lokasi_text'] = $lokasi_text;
		return (new LaporanResponseTimeTahunanExcel($data))->download($filename.'.xlsx');
    }

    public function laporanWaktuPelayanan($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

		$jenis_resep = $request->jenis_resep;

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanWaktuPelayananController')->get($date_start,$date_end,$farmasi_ids, $jenis_resep);

		$filename = 'Laporan Waktu Pelayanan__'.$farmasi_names.'__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
		$data['farmasi'] = $farmasi_names;
		$data['jenis_resep'] = $jenis_resep;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
		return (new LaporanWaktuPelayananExcel($data))->download($filename.'.xlsx');
    }

    public function laporanKesesuaianDokterFornasBulanan($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
		$jenis_resep = $request->jenis_resep;


		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanKesesuaianDokterFornasBulananController')->get($date_start,$date_end, $jenis_resep);

        
        if($jenis_resep == 'fornas') $jenis_resep = 'Fornas';
        else $jenis_resep= 'Formularium RS';

		$filename = 'Laporan Kesesuaian '.$jenis_resep.' Dokter Menulis Resep - Bulanan __'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;

        $data['jenis_resep'] = $jenis_resep;
		return (new LaporanKesesuaianDokterFornasBulananExcel($data))->download($filename.'.xlsx');
    }

    public function laporanKesesuaianDokterFornasHarian($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
		$jenis_resep = $request->jenis_resep;

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanKesesuaianDokterFornasHarianController')->get($date_start,$date_end, $jenis_resep);

        if($jenis_resep == 'fornas') $jenis_resep = 'Fornas';
        else $jenis_resep= 'Formularium RS';

		$filename = 'Laporan Kesesuaian '.$jenis_resep.' Dokter Menulis Resep - Harian __'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;

		if($jenis_resep == 'Fornas') $query_jenis_resep = 'is_fornas';
		else $query_jenis_resep = 'is_formularium_rs';

        $data['jenis_resep'] = $jenis_resep;
        $data['jenis_resep_query'] = $query_jenis_resep;

		return (new LaporanKesesuaianDokterFornasHarianExcel($data))->download($filename.'.xlsx');
    }

    public function laporanTelaahResep($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanTelaahResepController')->get($date_start,$date_end);

		$filename = 'Laporan Telaah Resep__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
		return (new LaporanTelaahResepExcel($data))->download($filename.'.xlsx');
    }

    public function laporanPersediaanFarmasi($farmasi_slug, Request $request)
    {
		$date = Carbon::createFromFormat('d/m/Y', $request->tanggal)->startOfDay();

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];


        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];


		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPersediaanFarmasiController')->get($date,$item_template_ids,$farmasi_ids);

		$filename = 'Laporan Sisa Stok__'.$date->format('d-m-Y');
        $data['date'] = $date;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new LaporanPersediaanFarmasiExcel($data))->download($filename.'.xlsx');
    }



    public function laporanPerbekalanFarmasi($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		
		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

        if ($request->lokasi_id == 'all') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap', 'rawat-jalan', 'igd']);
            $lokasi_ids = [];
        } elseif ($request->lokasi_id == 'all-ri') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-rj') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-igd') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } else {
            $lokasi_ids = $request->lokasi_id;
            $lokasi_ids = explode(',',$lokasi_ids);
        }

        $lokasi_ids = array_filter($lokasi_ids, function($value) { return !is_null($value) && $value !== ""; });
        $sumber_dana_id = 0;
        if (isset($request->sumber_dana_id)) $sumber_dana_id = $request->sumber_dana_id;

        $jenis_pembayaran_ids = '';
        if (isset($request->jenis)) {
            $jenis_pembayaran_ids = implode(",", $request->jenis);
        }

        $params['date_start'] = $date_start;
        $params['date_end'] = $date_end;
        $params['item_template_ids'] = $item_template_ids;
        $params['farmasi_ids'] = $farmasi_ids;
        $params['lokasi_ids'] = $lokasi_ids;
        $params['sumber_dana_id'] = $sumber_dana_id;
        $params['jenis_pembayaran_ids'] = $jenis_pembayaran_ids;

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPerbekalanFarmasiController')->get($params);

		$filename = 'Laporan Mutasi Stok__'.$kategori_names.'__'.$farmasi_names.'__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new LaporanPerbekalanFarmasiExcel($data))->download($filename.'.xlsx');
    }

    public function laporanRekapitulasiMutasiBarang($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
        $master_kode_bidang_parent_ids = MasterKodeBidang::with([])
            ->where(function ($query) use ($request) {
                $query->whereIn('id', $request->master_kode_bidang_ids)
                    ->whereNotNull('parent_id');
            })
            ->get(['parent_id'])->pluck('parent_id')->toArray();
        $master_kode_bidang = MasterKodeBidang::with([])
            ->where(function ($query) use ($request, $master_kode_bidang_parent_ids) {
                $query->whereIn('id', array_unique(array_merge($request->master_kode_bidang_ids, $master_kode_bidang_parent_ids)));
            })
            ->get();
        $item_template = ItemsTemplate::with([])
            ->when(!empty($request->master_kode_bidang_ids), function ($query) use ($request) {
                $query->whereIn('kode_bidang_id', $request->master_kode_bidang_ids);
            })
            ->when(!empty($request->master_kode_rekening_ids), function ($query) use ($request) {
                $query->whereIn('kode_rekening_id', $request->master_kode_rekening_ids);
            })
            ->get();
        $params['date_start'] = $date_start;
        $params['date_end'] = $date_end;
        $params['item_template_ids'] = $item_template->pluck('id')->toArray();;
        $params['farmasi_ids'] = $request->farmasi_ids;
        $params['sumber_dana_id'] = $request->sumber_dana_ids;
        $params['sumber_dana_id'] = $request->sumber_dana_ids;
        $params['katalog_id'] = $request->katalog_idss;

		$data_laporan = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPerbekalanFarmasiController')->get($params);
        
        # adjust column
        $data_log_pengadaan = LogPengadaan::with('pengadaan')->whereIn('item_id', array_pluck($data_laporan, 'item_id'))->get();
        $data_laporan = collect($data_laporan);
        $sumber_dana_apbd_id = [4];
        foreach ($data_laporan->whereIn('item_id', $data_log_pengadaan->pluck('item_id')) as $item) {
            $item->log_pengadaan = $data_log_pengadaan->where('item_id', $item->item_id)->first();
            $item->item_template = $item_template->where('id', $item->item_template_id)->first();
            $item->kode_bidang_id = $item->item_template->kode_bidang_id;
            $item->sumber_dana_id = $item->log_pengadaan->pengadaan->sumber_dana_id;
            $item->katalog_id = $item->log_pengadaan->pengadaan->katalog_id;

            # perhitungan
            $item->keadaan_awal_jumlah = $item->stok_awal;
            $item->keadaan_awal_subtotal = $item->keadaan_awal_jumlah * $item->harga;

            $item->bertambah_apbd_jumlah = 0;
            $item->bertambah_non_apbd_jumlah = 0;
            if (in_array($item->sumber_dana_id, $sumber_dana_apbd_id)) {
                $item->bertambah_apbd_jumlah += $item->penerimaan;
            } else {
                $item->bertambah_non_apbd_jumlah += $item->penerimaan;
                if ($item->penyesuaian > 0) {
                    $item->bertambah_non_apbd_jumlah += $item->penyesuaian;
                }
            }
            $item->bertambah_apbd_subtotal = $item->bertambah_apbd_jumlah * $item->harga;
            $item->bertambah_non_apbd_subtotal = $item->bertambah_non_apbd_jumlah * $item->harga;

            $item->berkurang_jumlah = $item->pemakaian;
            if ($item->penyesuaian < 0) {
                $item->berkurang_jumlah += abs($item->penyesuaian);
            }
            $item->berkurang_subtotal = $item->berkurang_jumlah * $item->harga;

            $item->keadaan_akhir_jumlah = $item->stok_akhir;
            $item->keadaan_akhir_subtotal = $item->keadaan_akhir_jumlah * $item->harga;
        }
        $data['data'] = $data_laporan;

		$filename = 'Laporan Rekapitulasi Mutasi Barang '.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['request'] = $request->all();
        $data['master_kode_bidang'] = $master_kode_bidang;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['farmasi_list'] = Farmasi::find($request->farmasi_ids);

		return (new LaporanRekapitulasiMutasiBarang($data))->download($filename.'.xlsx');
    }

    public function mutasiStokEmergensi($farmasi_slug, Request $request)
    {
		$date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];


        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];


		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\MutasiStokEmergensiController')->get($date_start,$date_end,$item_template_ids,$farmasi_ids);

		$filename = 'Mutasi Stok Farmasi__'.$date_start->format('d-m-Y').'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new MutasiStokEmergensiExcel($data))->download($filename.'.xlsx');
    }

    public function laporanStokEmergensi($farmasi_slug, Request $request)
    {
		$date = Carbon::createFromFormat('d/m/Y', $request->tanggal)->startOfDay();

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

        if ($request->lokasi_id == 'all') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap', 'rawat-jalan', 'igd']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-ri') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-rj') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-igd') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } else {
            $lokasi_ids = $request->lokasi_id;
            $lokasi_ids = explode(',',$lokasi_ids);
        }

        $lokasi_ids = array_filter($lokasi_ids, function($value) { return !is_null($value) && $value !== ""; });

        $sumber_dana_id = 0;
        if (isset($request->sumber_dana_id)) {
            $sumber_dana_id = $request->sumber_dana_id;
        }
        $jenis_pembayaran_ids = '';
        if (isset($request->jenis)) {
            $jenis_pembayaran_ids = implode(",", $request->jenis);
        }

        $params['date'] = $date;
        $params['item_template_ids'] = $item_template_ids;
        $params['farmasi_ids'] = $farmasi_ids;
        $params['lokasi_ids'] = $lokasi_ids;
        $params['sumber_dana_id'] = $sumber_dana_id;
        $params['jenis_pembayaran_ids'] = $jenis_pembayaran_ids;


		$data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanStokEmergensiController')->get($params);

		$filename = 'Laporan Persediaan Stok Rumah Sakit__'.$kategori_names.'__'.$farmasi_names.'__'.$date->format('d-m-Y');
        $data['date'] = $date;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new LaporanStokEmergensiExcel($data))->download($filename.'.xlsx');
    }



    public function rekapPenggunaanBarang($farmasi_slug, Request $request)
    {
        $date_start = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
        $date_end = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

        if ($request->lokasi_id == 'all') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap', 'rawat-jalan', 'igd']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-ri') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-rj') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-jalan']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } elseif ($request->lokasi_id == 'all-igd') {
            $lokasi_items = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['igd']);
            $lokasi_ids = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->formBeautyLokasiToId($lokasi_items);
        } else {
            $lokasi_ids = $request->lokasi_id;
            $lokasi_ids = explode(',',$lokasi_ids);
        }

        $lokasi_ids = array_filter($lokasi_ids, function($value) { return !is_null($value) && $value !== ""; });

        $sumber_dana_id = 0;
        if (isset($request->sumber_dana_id)) {
            $sumber_dana_id = $request->sumber_dana_id;
        }
        $jenis_pembayaran_ids = '';
        if (isset($request->jenis)) {
            $jenis_pembayaran_ids = implode(",", $request->jenis);
        }

        $params['date_start'] = $date_start;
        $params['date_end'] = $date_end;
        $params['item_template_ids'] = $item_template_ids;
        $params['farmasi_ids'] = $farmasi_ids;
        $params['lokasi_ids'] = $lokasi_ids;
        $params['sumber_dana_id'] = $sumber_dana_id;
        $params['jenis_pembayaran_ids'] = $jenis_pembayaran_ids;


		$data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\RekapPenggunaanBarangController')->get($params);

		$filename = 'Laporan Rekap Penggunaan Barang__'.$kategori_names.'__'.$farmasi_names.'__'.$date_start.'__'.$date_end->format('d-m-Y');
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new RekapPenggunaanBarangExcel($data))->download($filename.'.xlsx');
    }


    public function laporanPenggunaanBarang($farmasi_slug, Request $request)
    {
    	$date_start = Carbon::createFromFormat('d/m/Y', '01/01/'.$request->tahun)->startOfDay();
		$date_end = Carbon::createFromFormat('d/m/Y', '31/12/'.$request->tahun)->endOfDay();
		$tahun = $request->tahun;

		$kategori_kriteria = $request->kategori_kriteria;
		$kategori_ids = $request->kategori;

		$get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
		$kategori_names = $get_data['kategori_names'];
		$item_template_ids = $get_data['item_template_ids'];


        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];


		$data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPenggunaanBarangController')->get($date_start,$date_end,$item_template_ids,$farmasi_ids);

		$filename = 'Laporan Nilai Penggunaan Barang__'.$kategori_names.'__'.$farmasi_names.'__'.$tahun;
        $data['tahun'] = $tahun;
        $data['farmasi_names'] = $farmasi_names;
        $data['kategori_names'] = $kategori_names;

		return (new LaporanPenggunaanBarangExcel($data))->download($filename.'.xlsx');
    }

    public function laporanBarangTelahExpired($farmasi_slug, Request $request)
    {
    	$today = Carbon::now()->format('d-m-Y');
        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

        $temp_data = $this->getTemplateIdsFromFilterKategori("inklusi",$request->kategori);
        $item_template_ids = $temp_data['item_template_ids'];
        $produsen_ids = $request->produsen_ids ?? [];
        $supplier_ids = $request->supplier_ids ?? [];
        $sumber_dana_ids = $request->sumber_dana_ids ?? [];
        
		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBarangTelahExpiredController')->get($farmasi_ids,$item_template_ids,$produsen_ids,$supplier_ids,$sumber_dana_ids);

		$filename = 'Laporan Barang Telah Expired__'.$farmasi_names.'__'.$today;
        $data['farmasi_names'] = $farmasi_names;

		return (new LaporanBarangTelahExpiredExcel($data))->download($filename.'.xlsx');
    }

    public function laporanBarangMendekatiExpired($farmasi_slug, Request $request)
    {
    	$today = Carbon::now()->format('d-m-Y');
        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

		$batas_hari = $request->batas_hari;

        $temp_data = $this->getTemplateIdsFromFilterKategori("inklusi",$request->kategori);
        $item_template_ids = $temp_data['item_template_ids'];
        $produsen_ids = $request->produsen_ids ?? [];
        $supplier_ids = $request->supplier_ids ?? [];
        $sumber_dana_ids = $request->sumber_dana_ids ?? [];

		$data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBarangMendekatiExpiredController')->get($farmasi_ids,$batas_hari,$item_template_ids,$produsen_ids,$supplier_ids,$sumber_dana_ids);

		$filename = 'Laporan Barang Mendekati Expired__'.$farmasi_names.'__'.$today;
        $data['farmasi_names'] = $farmasi_names;

		return (new LaporanBarangMendekatiExpiredExcel($data))->download($filename.'.xlsx');
    }

    public function laporanPelayananKefarmasianJatim(Request $request)
    {
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPelayananKefarmasianJatimController')->get($request);
        $data['triwulan'] = $request->triwulan;
        $data['tahun'] = $request->tahun;
        return (new PelayananKefarmasianJatim($data))->download('data_pelayanan_kefarmasian.xlsx');
    }

    public function laporanPenggunaanObat(Request $request)
    {
        $data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPenggunaanObatController')->get($request);
        $data['triwulan'] = $request->triwulan;
        $data['tahun'] = $request->tahun;
        return (new LaporanPenggunaanObat($data))->download('laporan_penggunaan_obat_triwulan.xlsx');
    }

    public function laporanPelayananObatJkn(Request $request)
    {
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPelayananObatJknController')->get($request);
        return (new LaporanPelayananObatJknView($data))->download('laporan_pelayanan_obat_jkn_triwulan.xlsx');
    }

    public function laporanPenerimaanBarangHabisPakai(Request $request)
    {

        $get_data = $this->getTemplateIdsFromFilterKategori($request->kategori_kriteria,$request->kategori);
        $kategori_names = $get_data['kategori_names'];
        $item_template_ids = $get_data['item_template_ids'];


        $get_data = $this->getSupplierIdsFromFilterFarmasi($request->supplier_kriteria,$request->supplier_ids);
        $supplier_names = $get_data['supplier_names'];
        $supplier_ids = $get_data['supplier_ids'];
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPenerimaanBarangHabisPakaiController')->get($request,$item_template_ids,$supplier_ids);
        $data['penyedia'] = $supplier_names;
        $data['kategori'] = $kategori_names;
        return (new LaporanPenerimaanBarangHabisPakai($data))->download('laporan_penerimaan_barang_habis_pakai.xlsx');
    }

    public function laporanBPKSumberDana(Request $request)
    {
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBpkSumberDanaController')->get($request);
        return (new LaporanBpkSumberDana($data))->download('laporan_bpk_sumber_dana.xlsx');
    }

    public function laporanBPKPemakaian(Request $request)
    {
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBpkPemakaianController')->get($request);
        return (new LaporanBPKPemakaian($data))->download('laporan_bpk_pemakaian.xlsx');
    }

    public function laporanBPKPenerimaan(Request $request)
    {
        $data = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBpkPenerimaanController')->get($request);
        return (new LaporanBPKPenerimaan($data))->download('laporan_bpk_penerimaan.xlsx');
    }

    public function getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids)
    {
        if(empty($kategori_ids)){
            $kategori_ids = [];
            $prefix_kategori_names = '';
            $kategori_names = 'Semua';
            $item_template_ids = ItemsTemplate::pluck('id')->toArray();
        }
        else
        {
            if($kategori_kriteria == 'eksklusi'){
                $prefix_kategori_names = 'Selain - ';
                $kategori = Kategori::whereIn('id',$kategori_ids)->get();
                $item_template_ids_exclude = ItemsKategori::whereIn('kategori_id',$kategori_ids)->pluck('item_template_id')->toArray();
                $item_template_ids = ItemsTemplate::whereNotIn('id',$item_template_ids_exclude)->pluck('id')->toArray();
            }
            else if($kategori_kriteria == 'inklusi'){
                $prefix_kategori_names = '';
                $kategori = Kategori::whereIn('id',$kategori_ids)->get();
                $item_template_ids = ItemsKategori::whereIn('kategori_id',$kategori_ids)->pluck('item_template_id')->toArray();
            }

            $kategori_names = $prefix_kategori_names.implode(",", $kategori->pluck('nama')->toArray());
        }
        $data['item_template_ids'] = $item_template_ids;
        $data['kategori_names'] = $kategori_names;

        return $data;
    }

    public function getFarmasiIdsFromFilterFarmasi($farmasi_kriteria, $farmasi_ids)
    {
        if(empty($farmasi_ids)){
            $farmasi_names = 'Semua Farmasi';
            $farmasi_ids = Farmasi::pluck('id')->toArray();
        }
        else
        {
            if($farmasi_kriteria == 'eksklusi'){
                $prefix_farmasi_names = 'Selain - ';
                $farmasi = Farmasi::whereIn('id',$farmasi_ids)->get();
                $farmasi_ids = Farmasi::whereNotIn('id',$farmasi_ids)->pluck('id')->toArray();
            }
            else if($farmasi_kriteria == 'inklusi'){
                $prefix_farmasi_names = '';
                $farmasi = Farmasi::whereIn('id',$farmasi_ids)->get();
                $farmasi_ids = Farmasi::whereIn('id',$farmasi_ids)->pluck('id')->toArray();
            }

            $farmasi_names = $prefix_farmasi_names.implode(",", $farmasi->pluck('nama')->toArray());
        }
        $data['farmasi_ids'] = $farmasi_ids;
        $data['farmasi_names'] = $farmasi_names;

        return $data;
    }

    private function getSupplierIdsFromFilterFarmasi($supplier_kriteria, $supplier_ids)
    {
        if(empty($supplier_ids)){
            $supplier_names = 'Semua Penyedia';
            $supplier_ids = Perusahaan::pluck('id')->toArray();
        }
        else
        {
            if($supplier_kriteria == 'eksklusi'){
                $prefix_supplier_names = 'Selain - ';
                $supplier = Perusahaan::whereIn('id',$supplier_ids)->get();
                $supplier_ids = Perusahaan::whereNotIn('id',$supplier_ids)->pluck('id')->toArray();
            }
            else if($supplier_kriteria == 'inklusi'){
                $prefix_supplier_names = '';
                $supplier = Perusahaan::whereIn('id',$supplier_ids)->get();
                $supplier_ids = Perusahaan::whereIn('id',$supplier_ids)->pluck('id')->toArray();
            }

            $supplier_names = $prefix_supplier_names.implode(",", $supplier->pluck('nama')->toArray());
        }
        $data['supplier_ids'] = $supplier_ids;
        $data['supplier_names'] = $supplier_names;

        return $data;
    }


    public function laporanRealisasi(Request $request)
    {
        try {
            $triwulan = $request->triwulan;
            $tahun = $request->tahun;
            if($request->triwulan != 'all') {
                $date_start = Carbon::parse((($triwulan - 1) * 3 + 1) . '/1/' . $tahun)->startOfQuarter();
                $date_end = $date_start->copy()->endOfQuarter();
                $date_start_year_ago = $date_start->copy()->subQuarter()->startOfQuarter();
                $date_end_year_ago = $date_start_year_ago->copy()->endOfQuarter();
                $konstanta = 5;
                $interval_month = $date_end->diffInMonths($date_start);
            }else{
                $date_start = Carbon::parse(  '1/1/' . $tahun)->startOfYear();
                $date_end = $date_start->copy()->endOfYear();
                $date_start_year_ago = $date_start->copy()->subYear()->startOfYear();
                $date_end_year_ago = $date_end->copy()->subYear()->endOfYear();
                $konstanta = 15;
                $interval_month = $date_end->diffInMonths($date_start) + 1;
            };

            $kategori_kriteria = $request->kategori_kriteria;
		    $kategori_ids = $request->kategori;

            $get_data = $this->getTemplateIdsFromFilterKategori($kategori_kriteria,$kategori_ids);
            $kategori_names = $get_data['kategori_names'];
            $item_template_ids = $get_data['item_template_ids'];

            $farmasi_ids = $this->getFarmasiIdsFromFilterFarmasi('inklusi', $request->farmasi_id);
            $farmasi_ids = $farmasi_ids['farmasi_ids'];

            $sumber_dana_id = $request->sumber_dana_id;

            $params['date_start_year_ago'] = $date_start_year_ago;
            $params['date_end_year_ago'] = $date_end_year_ago;
            $params['date_start'] = $date_start;
            $params['date_end'] = $date_end;
            $params['item_template_ids'] = $item_template_ids;
            $params['farmasi_ids'] = $farmasi_ids;
            $params['sumber_dana_id'] = $sumber_dana_id;

            $data = app(\App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanRealisasiController::class)->get($params);

            $filename = 'Laporan Realisasi__'.$date_end->year;
            $data['tahun'] = $date_end->year;
            $data['date_start'] = $date_start;
            $data['date_end'] = $date_end;
            $data['interval'] = $date_end->diff($date_start)->days;
            $data['interval_month'] = $interval_month;
            $data['konstanta'] = $konstanta;
            return (new LaporanRealisasi($data))->download($filename.'.xlsx');
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function laporanPenghapusanBarang($farmasi_slug, Request $request)
    {
		$tanggal_awal = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$tanggal_akhir = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();

        $get_data = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $farmasi_names = $get_data['farmasi_names'];
        $farmasi_ids = $get_data['farmasi_ids'];

        $temp_data = $this->getTemplateIdsFromFilterKategori("inklusi",$request->kategori);
        $item_template_ids = $temp_data['item_template_ids'];
        $produsen_ids = $request->produsen_ids ?? [];
        $supplier_ids = $request->supplier_ids ?? [];
        $sumber_dana_ids = $request->sumber_dana_ids ?? [];

        $date_start = $tanggal_awal->copy()->format('Ymd');
        $date_end = $tanggal_akhir->copy()->format('Ymd');

		$data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanPenghapusanBarangController')->get($tanggal_awal,$tanggal_akhir,$farmasi_ids,$item_template_ids,$produsen_ids,$supplier_ids,$sumber_dana_ids);
		$filename = 'Laporan Penghapusan Barang__'.$farmasi_names.'__'.$date_start.'-'.$date_end;
        $data['farmasi_names'] = $farmasi_names;
        $data['date_start'] = $tanggal_awal;
        $data['date_end'] = $tanggal_akhir;

		return (new LaporanPenghapusanBarangExcel($data))->download($filename.'.xlsx');
    }

    public function laporanTransaksiFarmasi($farmasi_slug, Request $request)
    {
        $data['tanggal_awal'] = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$data['tanggal_akhir'] = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();


        $get_data = $this->getFarmasiIdsFromFilterFarmasi('inklusi',$request->farmasi_ids);
        $data['farmasi_names'] = $get_data['farmasi_names'];
        $data['farmasi_ids'] = $get_data['farmasi_ids'];
        
        $temp_data = $this->getTemplateIdsFromFilterKategori("inklusi",$request->kategori);
        $data['item_template_ids'] = $temp_data['item_template_ids'];
        $data['kategori_names'] = $temp_data['kategori_names'];

        $tipe_laporan = $request->tipe_laporan;
        
        $lokasi_id = $request->lokasi_id;
        $data['lokasi_ids'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processLokasi($lokasi_id);
        if($lokasi_id == 'all') $data['lokasi_names'] = "Semua";
        else if($lokasi_id == 'all-rj') $data['lokasi_names'] = "Semua Rawat Jalan";
        else if($lokasi_id == 'all-ri') $data['lokasi_names'] = "Semua Rawat Inap";
        else if($lokasi_id == 'all-igd') $data['lokasi_names'] = "Semua IGD";

        $jenis_resep = $request->jenis_resep;
        $data['jenis_resep'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processResepJenis($jenis_resep);
        if($jenis_resep == '0') $data['jenis_resep_name'] = 'Non Racikan';
        else if($jenis_resep == '1') $data['jenis_resep_name'] = 'Racikan';
        else $data['jenis_resep_name'] = 'Semua';

        $no_rm = $request->no_rm;
        $data['no_rm'] = $no_rm;

        // $sumber_dana_id = $request->sumber_dana_ids ?? [];
        // if(empty($sumber_dana_id)) $sumber_dana_ids = SumberDana::get()->pluck('id')->toArray();
        // else $sumber_dana_ids = $sumber_dana_id;
        // $data['sumber_dana_ids'] = $sumber_dana_ids;

        $asuransi_ids = $request->asuransi_ids;
        $asuransi_tipe_id = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processAsuransi($asuransi_ids);
        $data['asuransi_tipe_id'] = $asuransi_tipe_id;
        $asuransi_names = PembayaranPerusahaanType::whereIn('id',$asuransi_tipe_id)->get()->pluck('nama')->toArray();
        $data['asuransi_names'] = implode(',',$asuransi_names);

        $data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanTransaksiFarmasiController')->getData($data);
        $date_start = $data['tanggal_awal']->copy()->format('Ymd');
        $date_end = $data['tanggal_akhir']->copy()->format('Ymd');
        $filename = 'Laporan Transaksi Farmasi__'.$data['farmasi_names'].'__'.$date_start.'-'.$date_end;
        $data['farmasi_names'] = $data['farmasi_names'];
        
        $alphabet = range('A', 'Z');
        if($tipe_laporan == 'bpjs'){
            $data['view'] = 'farmasi.laporan.laporan-transaksi-farmasi-bpjs-excel';
            $max_col_number = 24;
            
        }
        else{
            $max_col_number = 16;
            $data['view'] = 'farmasi.laporan.laporan-transaksi-farmasi-umum-excel';
        }
        $max_column = $alphabet[$max_col_number];

        $max_row = count($data['data'])+11;
        $data['cellBorder'][] = "A10:".$max_column.$max_row;
        $data['cellCenterTextVertical'][] = "A10:".$max_column.$max_row;
        $data['cellCenterText'][] = "A1:".$max_column."11";
        

        for ($i = 0; $i <= $max_col_number; $i++) {
            if ($i > 6) $data['numberFormat'][] = $alphabet[$i];
            if ($i == 0) $array['width'] = 6;
            else if ($i == 1) $array['width'] = 22;
            else if ($i == 2) $array['width'] = 10;
            else if ($i > 5) $array['width'] = 8;
            else if ($i > 2) $array['width'] = 14;
            $array['col'] = $alphabet[$i];
            $data['cellWidth'][] = $array;
        }

		return (new TemplateGeneralExcel($data))->download($filename.'.xlsx');
    }

    public function laporanRealisasiPengadaan($farmasi_slug, Request $request)
    {
        $data['tanggal_awal'] = Carbon::createFromFormat('d/m/Y', $request->tanggal_awal)->startOfDay();
		$data['tanggal_akhir'] = Carbon::createFromFormat('d/m/Y', $request->tanggal_akhir)->endOfDay();
        
        $temp_data = $this->getTemplateIdsFromFilterKategori("inklusi",$request->kategori);
        $data['item_template_ids'] = $temp_data['item_template_ids'];
        $data['kategori_names'] = $temp_data['kategori_names'];

        $data['data'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanRealisaiPengadaanController')->getData($data);
        
        $date_start = $data['tanggal_awal']->copy()->format('Ymd');
        $date_end = $data['tanggal_akhir']->copy()->format('Ymd');


        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('formularium-rs')->id;
        $kategori_ekatalog = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('e-katalog')->id ?? 0;
       
        $data['array_formularium_rs'] = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_formularium);
        $data['array_generik'] = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        $data['array_ekatalog'] = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_ekatalog);
       
        $filename = 'Laporan Realisasi Pengadan__'.$date_start.'-'.$date_end;
        $data['view'] = 'farmasi.laporan.laporan-realisasi-pengadaan';
        $max_column = "N";
        $max_row = count($data['data'])+6;

        $data['cellBorder'][] = "A5:".$max_column.$max_row;
        $data['cellCenterTextVertical'][] = "A1:".$max_column.$max_row;
        $data['cellCenterText'][] = "A1:".$max_column."6";
        $data['cellCenterText'][] = "A1:A".$max_row;
        $temp_array['width'] = 14;
        $temp_array['col'] = "B";
        $data['cellWidth'][] = $temp_array;


		return (new TemplateGeneralExcel($data))->download($filename.'.xlsx');

    }

  
    public function laporanBeritaAcaraPemeriksaan(Request $request)
    {
        $data['sumber_dana_id'] = $request->sumber_dana_id;
        $data['kode_rekening_id'] = $request->kode_rekening_id;
        $data['katalog_id'] = $request->katalog_id;
        $data['kode_bidang_id'] = $request->kode_bidang_id;
        $data['no_berita_acara'] = $request->no_berita_acara;
        $data_temp = $this->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $data['farmasi_ids'] = $data_temp['farmasi_ids'];
        $data['farmasi_names'] = $data_temp['farmasi_names'];

        $data['tanggal'] = Carbon::createFromFormat('d/m/Y',$request->tanggal)->endOfDay();
        $data['jenis_dokumen'] = $request->jenis_dokumen;

        $data['data'] = app(\App\Http\Controllers\Farmasi\Laporan\LaporanController\LaporanBeritaAcaraPemeriksaanController::class)->get($data);
        
        $filename = 'Laporan Berita Acara Pemeriksaan__'.$data['jenis_dokumen'].'__'.$data['tanggal']->copy()->format('dmY');
        
        if($data['jenis_dokumen'] == 'berita-acara')
            return (new LaporanBeritaAcaraPemeriksaaanFormatBA($data))->download($filename.'.xlsx');
        else
            return (new LaporanBeritaAcaraPemeriksaanFormatLampiran($data))->download($filename.'.xlsx');
            

    }



}
