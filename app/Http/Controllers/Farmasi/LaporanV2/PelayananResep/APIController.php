<?php

namespace App\Http\Controllers\Farmasi\LaporanV2\PelayananResep;

use App\Models\Farmasi\TransaksiObat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
        $date_start = Carbon::parse($request->tanggal_awal)->startOfDay();
        $date_end = Carbon::parse( $request->tanggal_akhir)->endOfDay();

        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('formularium-rs')->id;
        $item_template_ids_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        $item_template_ids_non_generik_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikFormularium($kategori_generik,$kategori_formularium);
        $item_template_ids_non_generik_non_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikNonFormularium($kategori_generik,$kategori_formularium);

        $get_data = app('App\Http\Controllers\Farmasi\Laporan\PostController')->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $get_data_item = app('App\Http\Controllers\Farmasi\Laporan\PostController')->getTemplateIdsFromFilterKategori('inklusi',$request->kategori);
        $farmasi_ids = $get_data['farmasi_ids'];
        $item_template_ids = $get_data_item['item_template_ids'];
        $lokasi = '';

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
            $lokasi = Lokasi::whereIn('id',$lokasi_ids)->first()->id;
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

        if($jenis_pembayaran){
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)
                ->wherehas('pembayaran_detail', function ($subquery) use ($jenis_pembayaran){
                    $subquery->from(config('app.db_name') . '_patients.pasien_pembayaran')->select('id','perusahaan_id')->whereIn('perusahaan_id', $jenis_pembayaran);
                })
                ->get()->pluck('id')->toArray();
        }else{
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)->get()->pluck('id')->toArray();
        }

        $params['status'] = 200;
        $params['data'] = 14;
        $params['date_start'] = $date_start->toDateTimeString();
        $params['date_end'] = $date_end->toDateTimeString();
        $params['lokasi_departemen'] = $lokasi_departemen;
        $params['lokasi'] = $lokasi;
        $params['farmasi_ids'] = implode(",", $farmasi_ids);
        $params['transaksi_ids'] = implode(",",$transaksi_ids);
        $params['item_template_ids'] = implode(",",$item_template_ids);
        $params['item_template_ids_generik'] = implode(",",$item_template_ids_generik);
        $params['item_template_ids_non_generik_formularium_arr'] = implode(",",$item_template_ids_non_generik_formularium_arr);
        $params['item_template_ids_non_generik_non_formularium_arr'] = implode(",",$item_template_ids_non_generik_non_formularium_arr);
        return json_encode($params);
    }

    public function getData(Request $request)
    {
        $request_ke = $request->datafetched;
        $date_start = Carbon::parse($request->tanggal_awal)->startOfDay();
        $date_end = Carbon::parse( $request->tanggal_akhir)->endOfDay();

        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('formularium-rs')->id;
        $item_template_ids_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        $item_template_ids_non_generik_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikFormularium($kategori_generik,$kategori_formularium);
        $item_template_ids_non_generik_non_formularium = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikNonFormularium($kategori_generik,$kategori_formularium);

        $get_data = app('App\Http\Controllers\Farmasi\Laporan\PostController')->getFarmasiIdsFromFilterFarmasi($request->farmasi_kriteria,$request->farmasi_ids);
        $get_data_item = app('App\Http\Controllers\Farmasi\Laporan\PostController')->getTemplateIdsFromFilterKategori('inklusi',$request->kategori);
        $farmasi_ids = $get_data['farmasi_ids'];
        $item_template_ids = $get_data_item['item_template_ids'];
        $lokasi = '';

        if ($request->lokasi_id != 'all' && $request->lokasi_id != 'all-ri' && $request->lokasi_id != 'all-rj' && $request->lokasi_id !== 'all-igd') {
            $lokasi_ids = $request->lokasi_id;
            $lokasi_ids = explode(',',$lokasi_ids);
            $lokasi = Lokasi::whereIn('id',$lokasi_ids)->get()->pluck('id');
        }elseif ($request->lokasi_id == 'all-ri')
        {
            $lokasi = Lokasi::whereHas('departemen',function ($q){
                $q->select('id')->where('slug','rawat-inap');
            })->get()->pluck('id');
        }elseif ($request->lokasi_id == 'all-rj')
        {
            $lokasi = Lokasi::whereHas('departemen',function ($q){
                $q->select('id')->where('slug','rawat-jalan');
            })->get()->pluck('id');
        }
        elseif ($request->lokasi_id == 'all-igd')
        {
            $lokasi = Lokasi::whereHas('departemen',function ($q){
                $q->select('id')->where('slug','igd');
            })->get()->pluck('id');
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

        if($jenis_pembayaran){
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)
                ->wherehas('pembayaran_detail', function ($subquery) use ($jenis_pembayaran){
                    $subquery->from(config('app.db_name') . '_patients.pasien_pembayaran')->select('id','perusahaan_id')->whereIn('perusahaan_id', $jenis_pembayaran);
                })
                ->get()->pluck('id')->toArray();
        }else{
            $transaksi_ids = TransaksiObat::whereBetween('created_at',[$date_start->copy()->startOfDay(),$date_end->copy()->endOfDay()])
                ->whereIn('farmasi_id',$farmasi_ids)->get()->pluck('id')->toArray();
        }

        if(empty($lokasi)) {
            $rajal = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-jalan')->pluck('lokasi.id')->toArray());
            $ranap = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-inap')->pluck('lokasi.id')->toArray());
            $igd = implode(",", Lokasi::leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'igd')->pluck('lokasi.id')->toArray());
        }else{
            $rajal = implode(",", Lokasi::whereIn('lokasi.id',$lokasi)->leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-jalan')->pluck('lokasi.id')->toArray());
            $ranap = implode(",", Lokasi::whereIn('lokasi.id',$lokasi)->leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'rawat-inap')->pluck('lokasi.id')->toArray());
            $igd = implode(",", Lokasi::whereIn('lokasi.id',$lokasi)->leftJoin('lokasi_departemen', 'lokasi_departemen.id', '=', 'lokasi.lokasi_departemen_id')->where('lokasi_departemen.slug', '=', 'igd')->pluck('lokasi.id')->toArray());
            $rajal = !empty($rajal) ? $rajal : -1;
            $ranap = !empty($ranap) ? $ranap : -1;
            $igd = !empty($igd) ? $igd : -1;
        }
        $start = $date_start->toDateTimeString();
        $end = $date_end->toDateTimeString();
        $farmasi_ids = implode(",", $farmasi_ids);
        $transaksi_ids = implode(",",$transaksi_ids);
        $item_template_ids = implode(",",$item_template_ids);
        $item_template_ids_generik = implode(",",$item_template_ids_generik);
        $item_template_ids_non_generik_formularium = implode(",",$item_template_ids_non_generik_formularium_arr);
        $item_template_ids_non_generik_non_formularium = implode(",",$item_template_ids_non_generik_non_formularium_arr);

        $array_data = [];
        if ($request_ke == 0)
        {
            $igd_dilayani = $this->jumlahPasien($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahPasien($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahPasien($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahPasien($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahPasien($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahPasien($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 1;
            $new_item->golongan = 'Jumlah Pasien';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }elseif ($request_ke == 1)
        {
            $igd_dilayani = $this->jumlahPasienWanita($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahPasienWanita($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahPasienWanita($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahPasienWanita($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahPasienWanita($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahPasienWanita($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 2;
            $new_item->golongan = 'Jumlah Pasien Wanita';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 2)
        {
            $igd_dilayani = $this->jumlahPasienPria($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahPasienPria($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahPasienPria($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahPasienPria($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahPasienPria($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahPasienPria($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 3;
            $new_item->golongan = 'Jumlah Pasien Pria';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 3)
        {
            $igd_dilayani = $this->jumlahResep($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahResep($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahResep($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahResep($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahResep($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahResep($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 4;
            $new_item->golongan = 'Jumlah Resep';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 4)
        {
            $igd_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 5;
            $new_item->golongan = 'Jumlah R/';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 5)
        {
            $igd_dilayani = $this->jumlahObatNonRacikan($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObatNonRacikan($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObatNonRacikan($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObatNonRacikan($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObatNonRacikan($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObatNonRacikan($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 6;
            $new_item->golongan = 'Jumlah Obat Non Racikan';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 6)
        {
            $igd_dilayani = $this->jumlahObatRacikan($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObatRacikan($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObatRacikan($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObatRacikan($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObatRacikan($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObatRacikan($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 7;
            $new_item->golongan = 'Jumlah Obat Racikan';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 7)
        {
            $igd_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_generik,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 8;
            $new_item->golongan = 'Jumlah Obat Generik';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 8)
        {
            $igd_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_non_generik_formularium,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 9;
            $new_item->golongan = 'Jumlah Obat Non Generik Formularium';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 9)
        {
            $igd_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahObat($start,$end,$igd,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahObat($start,$end,$rajal,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahObat($start,$end,$ranap,$farmasi_ids,$item_template_ids_non_generik_non_formularium,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 10;
            $new_item->golongan = 'Jumlah Obat Non Generik Non Formularium';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 10)
        {
            $igd_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 1');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 1');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 1');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 1');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 1');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 1');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 11;
            $new_item->golongan = 'Jumlah Resep Sesuai FORNAS';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 11)
        {
            $igd_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 0');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 0');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 0');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 0');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_fornas = 0');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_fornas = 0');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 12;
            $new_item->golongan = 'Jumlah Resep Tidak Sesuai FORNAS';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 12)
        {
            $igd_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 1');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 1');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 1');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 1');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 1');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 1');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 13;
            $new_item->golongan = 'Jumlah Resep Sesuai Formularium RS';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }
        elseif ($request_ke == 13)
        {
            $igd_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 0');
            $igd_dilayani = DB::connection('farmasi')->select($igd_dilayani);
            $igd_tidak_dilayani = $this->jumlahResepKategori($start,$end,$igd,$farmasi_ids,$item_template_ids,$transaksi_ids,'igd_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 0');
            $igd_tidak_dilayani = DB::connection('farmasi')->select($igd_tidak_dilayani);
            $rajal_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 0');
            $rajal_dilayani = DB::connection('farmasi')->select($rajal_dilayani);
            $rajal_tidak_dilayani = $this->jumlahResepKategori($start,$end,$rajal,$farmasi_ids,$item_template_ids,$transaksi_ids,'rajal_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 0');
            $rajal_tidak_dilayani = DB::connection('farmasi')->select($rajal_tidak_dilayani);
            $ranap_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_dilayani','AND t.paid_at IS NOT NULL','AND rd.is_formularium_rs = 0');
            $ranap_dilayani = DB::connection('farmasi')->select($ranap_dilayani);
            $ranap_tidak_dilayani = $this->jumlahResepKategori($start,$end,$ranap,$farmasi_ids,$item_template_ids,$transaksi_ids,'ranap_tidak_dilayani','AND t.paid_at IS NULL','AND rd.is_formularium_rs = 0');
            $ranap_tidak_dilayani = DB::connection('farmasi')->select($ranap_tidak_dilayani);
            $new_item = new \StdClass();
            $new_item->no = 14;
            $new_item->golongan = 'Jumlah Resep Tidak Sesuai Formularium RS';
            $new_item->igd_dilayani = $igd_dilayani[0]->igd_dilayani ?? 0;
            $new_item->igd_tidak_dilayani = $igd_tidak_dilayani[0]->igd_tidak_dilayani ?? 0;
            $new_item->igd_total = $new_item->igd_dilayani + $new_item->igd_tidak_dilayani;
            $new_item->rajal_dilayani = $rajal_dilayani[0]->rajal_dilayani ?? 0;
            $new_item->rajal_tidak_dilayani = $rajal_tidak_dilayani[0]->rajal_tidak_dilayani ?? 0;
            $new_item->rajal_total = $new_item->rajal_dilayani + $new_item->rajal_tidak_dilayani;
            $new_item->ranap_dilayani = $ranap_dilayani[0]->ranap_dilayani ?? 0;
            $new_item->ranap_tidak_dilayani = $ranap_tidak_dilayani[0]->ranap_tidak_dilayani ?? 0;
            $new_item->ranap_total = $new_item->ranap_dilayani + $new_item->ranap_tidak_dilayani;
            $new_item->total = $new_item->igd_total + $new_item->rajal_total + $new_item->ranap_total;

            $array_data[] = $new_item;
        }

        return json_encode([
            'status' => 200,
            'data' => $array_data
        ]);


    }

    public function jumlahPasien($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 0 
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 1
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahPasienWanita($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 0
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 1
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender <> 1
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahPasienPria($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 0
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.pasien_id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				INNER JOIN ".config('app.db_name')."_patients.pasien pasien ON t.pasien_id = pasien.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 1
				AND item.item_template_id IN ($item_template_ids)
				AND pasien.gender = 1
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahResep($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 0
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(DISTINCT(t.id)) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND t.is_racikan = 1
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahObat($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND rd.tipe = 0
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND rd.tipe = 1
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahObatNonRacikan($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND rd.tipe = 0
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahObatRacikan($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				AND rd.tipe = 1
				AND item.item_template_id IN ($item_template_ids)
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }

    public function jumlahResepKategori($start,$end,$departemen,$farmasi_ids,$item_template_ids,$transaksi_ids,$variable,$status,$kategori)
    {
        return "
    		SELECT SUM(jumlah.value) AS $variable FROM (
	    		SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN items_farmasi item ON rd.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				$kategori
				AND item.item_template_id IN ($item_template_ids)
				AND rd.tipe = 0
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
                UNION
                SELECT COUNT(rd.id) AS value
				FROM transaksi_obat t 
				INNER JOIN resep r ON t.resep_final = r.id
				INNER JOIN resep_detail rd ON r.id = rd.resep_id
				INNER JOIN racikan_detail racikan ON rd.id = racikan.resep_detail_id
				INNER JOIN items_farmasi item ON racikan.obat_id = item.id
				WHERE t.created_at >= '$start'
				AND t.created_at <= '$end'
				$status
				AND t.lokasi_id IN ($departemen)
				AND t.farmasi_id IN ($farmasi_ids)
				$kategori
				AND item.item_template_id IN ($item_template_ids)
				AND rd.tipe = 1
                AND t.deleted_at IS NULL
                AND t.id IN($transaksi_ids)
				)jumlah";
    }
}
