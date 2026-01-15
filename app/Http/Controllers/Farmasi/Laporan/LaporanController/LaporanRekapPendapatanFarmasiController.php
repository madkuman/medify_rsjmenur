<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use App\Exports\General\TemplateGeneralExcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Pasien\PembayaranPerusahaanType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use File;

class LaporanRekapPendapatanFarmasiController extends Controller
{
    public function view()
    {
        $data['pharmacy'] = Farmasi::get();
        $data['lokasi_beauty'] = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->getAsalPelayanan();
        $data['asuransi_tipe'] = PembayaranPerusahaanType::get();
        return view('farmasi.laporan.view.laporan-rekap-pendapatan-farmasi', $data);
    }

    public function getHeader(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal ?? Carbon::now()->startOfYear()->format('m-Y');
        $tanggal_akhir = $request->tanggal_akhir ?? Carbon::now()->format('m-Y');
        $lokasi_id = $request->lokasi_id ?? 'all';
        $resep_jenis = $request->resep_jenis ?? 'all';
        $farmasi_ids = $request->farmasi_ids ?? [];
        $asuransi_tipe_id = $request->asuransi_tipe_id ?? [];

        if (!empty($asuransi_tipe_id)) $total_data = PembayaranPerusahaanType::whereIn('id', $asuransi_tipe_id)->select('id')->count();
        else $total_data = PembayaranPerusahaanType::select('id')->count();
        $tanggal_awal = Carbon::createFromFormat('m-Y', $tanggal_awal)->startOfDay();
        $tanggal_akhir = Carbon::createFromFormat('m-Y', $tanggal_akhir)->startOfDay();

        $tanggal_awal_temp = $tanggal_awal->copy();
        $bulan = [];
        while ($tanggal_awal_temp->lte($tanggal_akhir)) {
            $bulan[] = $tanggal_awal_temp->format('M');
            $tanggal_awal_temp->addMonth();
        }

        $return['data'] = $total_data;
        $return['header'] = $bulan;


        return json_encode($return);
    }


    public function getData(Request $request)
    {
        $tanggal_awal = $request->tanggal_awal ?? Carbon::now()->startOfYear()->format('m-Y');
        $tanggal_akhir = $request->tanggal_akhir ?? Carbon::now()->format('m-Y');
        $lokasi_id = $request->lokasi_id ?? 'all';
        $resep_jenis = $request->resep_jenis ?? 'all';
        $farmasi_ids = $request->farmasi_ids ?? [];
        $asuransi_tipe_id = $request->asuransi_tipe_id ?? [];
        $limit = $request->data_fetched;

        $tanggal_awal = Carbon::createFromFormat('m-Y', $tanggal_awal)->startOfDay();
        $tanggal_akhir = Carbon::createFromFormat('m-Y', $tanggal_akhir)->startOfDay();

        $lokasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processLokasi($lokasi_id);
        $lokasi_id = implode(',', $lokasi_id_array);

        $farmasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processFarmasi($farmasi_ids);
        $farmasi_id = implode(',', $farmasi_id_array);

        $resep_jenis = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processResepJenis($resep_jenis);
        $asuransi_tipe_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processAsuransi($asuransi_tipe_id);
        $asuransi_tipe_id = $asuransi_tipe_id_array[$limit];
        $tanggal_awal_temp = $tanggal_awal->copy();
        $bulan = [];
        $db_name = config('app.db_name');
        $all_data = [];
        while ($tanggal_awal_temp->lte($tanggal_akhir)) {
            $tanggal_awal_temp_1 = $tanggal_awal_temp->copy()->startOfMonth();
            $tanggal_awal_temp_2 = $tanggal_awal_temp->copy()->endOfMonth();
            $query = 'SELECT SUM( resep_detail.subtotal) as total
            FROM resep_detail
            LEFT JOIN resep ON resep.id = resep_detail.resep_id
            LEFT JOIN `transaksi_obat` ON `transaksi_obat`.resep_final = resep.id
            LEFT JOIN `' . $db_name . '_patients`.pasien_pembayaran ON pasien_pembayaran.id = transaksi_obat.metode_pembayaran_id
            LEFT JOIN `' . $db_name . '_patients`.`pembayaran_perusahaan` ON pasien_pembayaran.perusahaan_id = pembayaran_perusahaan.id
            WHERE 
                transaksi_obat.paid_at >= "' . $tanggal_awal_temp_1->format('Y-m-d H:i:s') . '"
                AND transaksi_obat.paid_at <= "' . $tanggal_awal_temp_2->format('Y-m-d H:i:s') . '"
                AND lokasi_id IN (' . $lokasi_id . ')
                AND transaksi_obat.farmasi_id IN (' . $farmasi_id . ')
                AND resep_detail.tipe IN (' . $resep_jenis . ')
                AND pembayaran_perusahaan.type IN (' . $asuransi_tipe_id . ')
            ';

            $result = DB::connection('farmasi')->select($query);
            $all_data[] = $result[0]->total;
            $tanggal_awal_temp->addMonth();
        }

        $return['data'] = $all_data;
        $return['nama_asuransi'] = PembayaranPerusahaanType::find($asuransi_tipe_id)->nama;


        return json_encode($return);
    }

    public function downloadExcel(Request $request)
    {
        $data['json'] = json_decode($request->data);
        $data['view'] = 'farmasi.laporan.laporan-rekap-pendapatan-farmasi-excel';

        $tanggal_awal = $request->tanggal_awal ?? Carbon::now()->startOfYear()->format('m-Y');
        $tanggal_akhir = $request->tanggal_akhir ?? Carbon::now()->format('m-Y');
        $lokasi_text = $request->lokasi_text ?? 'Semua';
        $resep_jenis = $request->resep_jenis ?? 'Semua';
        $farmasi_ids = $request->farmasi_ids ?? 'Semua';
        $asuransi_tipe_id = $request->asuransi_tipe_id ?? 'Semua';


        $farmasi_name = 'Semua';
        if($farmasi_ids != 'Semua')
        {
            $farmasi_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processFarmasi($farmasi_ids);
            $farmasi_name = Farmasi::whereIn('id',$farmasi_id_array)->pluck('nama')->toArray();
            $farmasi_ids = implode(",",$farmasi_name);
        }

        $asuransi_name = 'Semua';
        if($asuransi_tipe_id != 'Semua')
        {
            $asuransi_tipe_id_array = app('App\Http\Controllers\Farmasi\Laporan\LaporanController\HelperDataController')->processAsuransi($asuransi_tipe_id);
            $asuransi_name = PembayaranPerusahaanType::whereIn('id',$asuransi_tipe_id_array)->pluck('nama')->toArray();
            $asuransi_name = implode(",",$asuransi_name);
        }

        if($resep_jenis == 'all') $resep_jenis = 'Semua';
        
        $data['tanggal_awal'] = $tanggal_awal;
        $data['tanggal_akhir'] = $tanggal_akhir;
        $data['asuransi'] = $asuransi_name;
        $data['resep_jenis'] = $resep_jenis;
        $data['lokasi'] = $lokasi_text;
        $data['farmasi'] = $farmasi_name;

        $base_path = '/downloads/laporan/farmasi';
        $path = public_path() . $base_path;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $filename = 'laporan-rekap-pendapatan-farmasi';
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';
        $filename_stored = $filename . '-' . $timestamp_now . $format;
        $total_column_number = count($data['json'][0]);
        $alphabet = range('A', 'Z');

        for ($i = 0; $i < $total_column_number; $i++) {
            if ($i > 1) $data['numberFormat'][] = $alphabet[$i];
            $array['width'] = 13;
            $array['col'] = $alphabet[$i];
            $data['cellWidth'][] = $array;
        }

        $data['cellWidth'][0]['width'] = 5;

        $start_row = 7;
        $length_data = count($data['json'][0])-1;
        $max_row = $start_row+count($data['json'])-1;

        $data['cellBorder'][] = $alphabet[0].$start_row.":".$alphabet[$length_data].$max_row;
        $data['cellCenterText'][] = $alphabet[0]."1:".$alphabet[$length_data]."5";
        

        $xls = (new TemplateGeneralExcel($data))->store($filename_stored);

        File::move(storage_path('app/' . $filename_stored), $path . '/' . $filename_stored);
        $return['url'] = $base_path . '/' . $filename_stored;
        $return['filename'] = $filename_stored;
        return json_encode($return);
    }
}
