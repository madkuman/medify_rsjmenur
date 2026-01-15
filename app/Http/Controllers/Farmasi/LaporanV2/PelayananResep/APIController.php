<?php

namespace App\Http\Controllers\Farmasi\LaporanV2\PelayananResep;

use App\Models\Farmasi\TransaksiObat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Hospital\Lokasi;
use Carbon\Carbon;
use DB;

class APIController extends Controller
{
    public function rowTitle()
    {
        $deskripsi = [
            'jumlah-pasien' => 'Jumlah Pasien',
            'jumlah-pasien-wanita' => 'Jumlah Pasien Wanita',
            'jumlah-pasien-pria' => 'Jumlah Pasien Pria',
            'jumlah-r' => 'Jumlah R/',
            'jumlah-resep' => 'Jumlah Resep',
            'jumlah-r-non-racikan' => 'Jumlah R/ Non Racikan',
            'jumlah-resep-obat-non-racikan' => 'Jumlah Resep Obat Non Racikan',
            'jumlah-r-racikan' => 'Jumlah R/ Racikan',
            'jumlah-resep-obat-racikan' => 'Jumlah Resep Obat Racikan',
            'jumlah-obat-generik' => 'Jumlah Obat Generik',
            'jumlah-obat-non-generik-formularium' => 'Jumlah Obat Non Generik Formularium',
            'jumlah-obat-non-generik-non-formularium' => 'Jumlah Obat Non Generik Non Formularium',
            'jumlah-resep-sesuai-fornas' => 'Jumlah Resep Sesuai FORNAS',
            'jumlah-resep-tidak-sesuai-fornas' => 'Jumlah Resep Tidak Sesuai FORNAS',
            'jumlah-resep-sesuai-formularium-rs' => 'Jumlah Resep Sesuai Formularium RS',
            'jumlah-resep-tidak-sesuai-formularium-rs' => 'Jumlah Resep Tidak Sesuai Formularium RS',
        ];
        return $deskripsi;
    }

    public function rowData()
    {
        $deskripsi = [
            'jumlah-pasien',
            'jumlah-pasien-wanita',
            'jumlah-pasien-pria' ,
            'jumlah-r',
            'jumlah-resep',
            'jumlah-r-non-racikan',
            'jumlah-resep-obat-non-racikan' ,
            'jumlah-r-racikan',
            'jumlah-resep-obat-racikan',
            'jumlah-obat-generik',
            'jumlah-obat-non-generik-formularium',
            'jumlah-obat-non-generik-non-formularium',
            'jumlah-resep-sesuai-fornas',
            'jumlah-resep-tidak-sesuai-fornas',
            'jumlah-resep-sesuai-formularium-rs',
            'jumlah-resep-tidak-sesuai-formularium-rs'
        ];
        return $deskripsi;
    }
    
    public function getTotalData(Request $request)
    {
        $row_data = $this->rowData();
        $col_number = 3;

        $total_data = count($row_data) * $col_number;

        $params['status'] = 200;
        $params['data'] = $total_data;
        return $params;
    }

    public function getData(Request $request)
    {
        $row_data = $this->rowData();
        $title_data = $this->rowTitle();
        $departemen = ['igd','rawat-jalan','rawat-inap'];
        $col_number = count($departemen);
        $total_data = count($row_data) * $col_number;

        $data_fetched = $request->data_fetched ?? 0;
        $date_start = Carbon::parse($request->tanggal_awal)->startOfDay();
        $date_end = Carbon::parse( $request->tanggal_akhir)->endOfDay();

        $perusahaan_pembayaran_id = $request->perusahaan_pembayaran_id ?? [];
        $kategori_id = $request->kategori_id ?? [];
        $farmasi_ids = $request->farmasi_id ?? [];
        $farmasi_kriteria = $request->farmasi_kriteria ?? "inklusi";

        $row_ke = floor($data_fetched / 3);
        $col_ke = $data_fetched % 3;

        $current_slug = $row_data[$row_ke];
        $current_departemen = $departemen[$col_ke];
        $data_return['data'] = $this->getDataMapping($current_slug,$current_departemen,$farmasi_kriteria,$farmasi_ids,$perusahaan_pembayaran_id,$kategori_id,$date_start,$date_end);
        $data_return['title'] = $title_data[$current_slug];
        $data_return['row_ke'] = $row_ke;
        return json_encode($data_return);
    }

    private function getLokasiBasedDepartemen($current_departemen)
    {
        $data = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($current_departemen)->pluck('id')->toArray();
        $data_text = implode(",",$data);
        return $data_text;
    }

    private function getDataMapping($slug,$current_departemen,$farmasi_kriteria,$farmasi_ids,$perusahaan_pembayaran_id,$kategori_ids,$tanggal_awal,$tanggal_akhir)
    {
        $lokasi_ids = $this->getLokasiBasedDepartemen($current_departemen);
        $query_data['lokasi'] = "AND transaksi_obat.lokasi_id IN ($lokasi_ids)";
        $query_data['lokasi'] = "AND transaksi_obat.lokasi_id IN ($lokasi_ids)";

        $query_data['tanggal_awal'] = $tanggal_awal->startOfDay()->format('Y-m-d H:i:s');
        $query_data['tanggal_akhir'] = $tanggal_akhir->endOfDay()->format('Y-m-d H:i:s');

        $query_data['farmasi'] = '';
        if(!empty($farmasi_ids))
        {
            if($farmasi_kriteria == 'eksklusi') $farmasi_kriteria = 'NOT IN';
            else $farmasi_kriteria = 'IN';
            $farmasi_id_text = implode(",",$farmasi_ids);
            $query_data['farmasi'] = "AND transaksi_obat.farmasi_id $farmasi_kriteria ($farmasi_id_text)";
        }
        
        $query_data['asuransi'] = '';
        if(!empty($perusahaan_pembayaran_id))
        {
            $perusahaan_pembayaran_text = implode(",",$perusahaan_pembayaran_id);
            $query_data['asuransi'] = "AND pembayaran_perusahaan.id IN ($perusahaan_pembayaran_text)";
        }
         
        $query_data['item_template'] = '';
        $item_template_ids = [];
        if(!empty($kategori_ids))
        {
            $item_template_ids = ItemsKategori::whereIn('kategori_id',$kategori_ids)->pluck('item_template_id')->toArray();
            $item_template_text = implode(",",$item_template_ids);
            $query_data['item_template'] = "AND item_template.id IN ($item_template_text)";
        }
         
        $data_final = [];
        $data_final['dilayani'] = 0;
        $data_final['tidak_dilayani'] = 0;
        $data_final['all'] = 0;
        $query_data['is_fornas'] = $this->helperQueryFornas("none");
        $query_data['is_racikan'] = $this->helperQueryRacikan("none");
        $query_data['is_formularium_rs'] = $this->helperQueryFormularium("none");
        $query_data['jenis_kelamin'] = $this->helperQueryJenisKelamin("none");

        if($slug == 'jumlah-pasien'){
            $query_data['selector'] = $this->helperQuerySelect("pasien");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-pasien-wanita'){
            $query_data['jenis_kelamin'] = $this->helperQueryJenisKelamin("2");
            $query_data['selector'] = $this->helperQuerySelect("pasien");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-pasien-pria'){
            $query_data['jenis_kelamin'] = $this->helperQueryJenisKelamin("1");
            $query_data['selector'] = $this->helperQuerySelect("pasien");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-r'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep'){
            $query_data['selector'] = $this->helperQuerySelect("resep");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-r-non-racikan'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_racikan'] = $this->helperQueryRacikan("0");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep-obat-non-racikan'){
            $query_data['selector'] = $this->helperQuerySelect("resep");
            $query_data['is_racikan'] = $this->helperQueryRacikan("0");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-r-racikan'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_racikan'] = $this->helperQueryRacikan("1");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep-obat-racikan'){
            $query_data['selector'] = $this->helperQuerySelect("resep");
            $query_data['is_racikan'] = $this->helperQueryRacikan("1");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        
        else if($slug == 'jumlah-resep-sesuai-fornas'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_fornas'] = $this->helperQueryFornas("1");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep-tidak-sesuai-fornas'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_fornas'] = $this->helperQueryFornas("0");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep-sesuai-formularium-rs'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_fornas'] = $this->helperQueryFormularium("1");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-resep-tidak-sesuai-formularium-rs'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['is_fornas'] = $this->helperQueryFormularium("0");
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-obat-generik'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['item_template'] = $this->helperQueryItemTemplate("generik",$item_template_ids);

            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        
        else if($slug == 'jumlah-obat-non-generik-formularium'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['item_template'] = $this->helperQueryItemTemplate("non_generik_formularium",$item_template_ids);

            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        else if($slug == 'jumlah-obat-non-generik-non-formularium'){
            $query_data['selector'] = $this->helperQuerySelect("resep_detail");
            $query_data['item_template'] = $this->helperQueryItemTemplate("non_generik_non_formularium",$item_template_ids);

            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("1");
            $data_final['dilayani'] = $this->getQuery($query_data);
            
            $query_data['status_dilayani'] = $this->helperQueryStatusDilayani("0");
            $data_final['tidak_dilayani'] = $this->getQuery($query_data);

            $data_final['all'] = $data_final['dilayani']+$data_final['tidak_dilayani'];
        }
        

        return $data_final;
    }

    private function getQuery($query_data)
    {
        $db_name = config('app.db_name');
        $query = "SELECT 
            ".$query_data['selector']."
            FROM resep_detail 
            LEFT JOIN resep ON resep.id = resep_detail.resep_id 
            LEFT JOIN `transaksi_obat` ON `transaksi_obat`.resep_final = resep.id 
            LEFT JOIN `".$db_name."_patients`.pasien_pembayaran ON pasien_pembayaran.id = transaksi_obat.metode_pembayaran_id 
            LEFT JOIN `".$db_name."_patients`.`pembayaran_perusahaan` ON pasien_pembayaran.perusahaan_id = pembayaran_perusahaan.id
            LEFT JOIN `".$db_name."_patients`.pasien ON pasien.id = transaksi_obat.pasien_id 
            LEFT JOIN items_farmasi ON items_farmasi.id = resep_detail.obat_id
            LEFT JOIN item_template ON item_template.id = items_farmasi.item_template_id 
            WHERE transaksi_obat.created_at >= '".$query_data['tanggal_awal']."'
            AND transaksi_obat.created_at <= '".$query_data['tanggal_akhir']."'
            ".$query_data['lokasi']."
            ".$query_data['farmasi']."
            ".$query_data['asuransi']."
            ".$query_data['item_template']."
            ".$query_data['is_fornas']."
            ".$query_data['is_racikan']."
            ".$query_data['is_formularium_rs']."
            ".$query_data['status_dilayani']."
            ".$query_data['jenis_kelamin']."
            ";
            $data_result = DB::connection('farmasi')->select($query);
            return $data_result[0]->total;
    }

    private function helperQueryFornas($filter)
    {
        if($filter != 'none') return "AND transaksi_obat.is_fornas = $filter";
        else return '';
    }

    private function helperQueryRacikan($filter)
    {
        if($filter != 'none') return "AND transaksi_obat.is_racikan = $filter";
        else return '';
    }
    
    private function helperQueryFormularium($filter)
    {
        if($filter != 'none') return "AND transaksi_obat.is_formularium_rs = $filter";
        else return '';
    }

    private function helperQuerySelect($filter)
    {
        if($filter =='pasien') return "COUNT(DISTINCT(transaksi_obat.pasien_id)) AS total";
        else if($filter =='resep') return "COUNT(DISTINCT(transaksi_obat.id)) AS total";
        else if($filter =='resep_detail') return "COUNT(DISTINCT(resep_detail.id)) AS total";
        else return '';
    }

    private function helperQueryStatusDilayani($filter)
    {
        if($filter =='1') return "AND transaksi_obat.paid_at IS NOT NULL";
        else if($filter =='0') return "AND transaksi_obat.paid_at IS NULL";
        else return '';
    }

    private function helperQueryJenisKelamin($filter)
    {
        if($filter !='none') return "AND pasien.gender = $filter";
        else return '';
    }

    private function helperQueryItemTemplate($filter,$item_template_ids)
    {
        $kategori_generik = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('generik')->id;
        $kategori_formularium = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getSingle('formularium-rs')->id;
        
        $temp_kategori_1 = [];
        if($filter =='generik') $temp_kategori_1 = app(\App\Http\Controllers\Farmasi\Kategori\ReadController::class)->getItemTemplateIdByItemKategori($kategori_generik);
        else if($filter =='non_generik_formularium') 
        {
            $item_template_obj = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikFormularium($kategori_generik,$kategori_formularium);
            foreach ($item_template_obj as $key => $value) {
                $temp_kategori_1[] = $value->id;
            }
        }
        else if($filter =='non_generik_non_formularium') 
        {
            $item_template_obj = app(\App\Http\Controllers\Farmasi\ItemTemplate\ReadController::class)->getNonGenerikNonFormularium($kategori_generik,$kategori_formularium);
            foreach ($item_template_obj as $key => $value) {
                $temp_kategori_1[] = $value->id;
            }
        }
        else $temp_kategori_1 = [];

        $new_item_template = [];
        if(!empty($item_template_ids))
        {
            $temp_kategori_2 = $item_template_ids;
            $new_item_template = array_values(array_intersect($temp_kategori_1, $temp_kategori_2));
            
        }
        else $new_item_template = $temp_kategori_1;

        if(!empty($new_item_template))
        {
            $item_template_text = implode(",",$new_item_template);
            $query_data['item_template'] = "AND item_template.id IN ($item_template_text)";
        }
        else
        {
            $query_data['item_template'] = "AND item_template.id IN (0)";
        }

        return $query_data['item_template'];
    }



    public function getTotalDataOld(Request $request)
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

    public function getDataOld(Request $request)
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
