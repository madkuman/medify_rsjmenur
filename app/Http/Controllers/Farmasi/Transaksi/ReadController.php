<?php

namespace App\Http\Controllers\Farmasi\Transaksi;

use App\Models\Farmasi\JenisAntrian;
use App\Models\Farmasi\ScreenAntrian;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PembayaranPerusahaanType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LoketAntrian;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DateTime;

class ReadController extends Controller
{
	public function getAll($farmasi_id)
    {
        $transaksi = TransaksiObat::where('farmasi_id', $farmasi_id)->latest()->get();
    	return $transaksi;
    }

    // public function getByAjax($farmasi_id)
    // {
    //     $transaksi = TransaksiObat::with(['pasien_detail','ori_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('farmasi_id', $farmasi_id)->orderBy('created_at','desc')->get();
    //     return $transaksi;
    // }

    public function getPerPage($farmasi_id, $limit, $offset)
    {
        $transaksi = TransaksiObat::with(['pasien_detail', 'ori_detail', 'final_detail','lokasi', 'pembayaran_detail', 'lokasi'])->where('farmasi_id', $farmasi_id)->whereNull('transaksi_asal_id')->latest()->limit($limit)->offset($offset)->get();
        return $transaksi;
    }

    public function getBydate($req)
    {
        $transaksi = $this->bydate($req)->get();
        return $transaksi;
    }

    public function bydate($req)
    {
        if($req->tanggal_awal) {
            $tgl_awal = str_replace("/", "-", $req->tanggal_awal);
            $tgl_awal = strtotime($tgl_awal);
            $tgl_awal = date('m/d/Y', $tgl_awal);

            $min_date = Carbon::parse($tgl_awal);
        } else $min_date = Carbon::today()->startOfDay();

        if($req->tanggal_akhir){
            $tgl_akhir = str_replace("/", "-", $req->tanggal_akhir);
            $tgl_akhir = strtotime($tgl_akhir);
            $tgl_akhir = date('m/d/Y', $tgl_akhir);

            $max_date = Carbon::parse($tgl_akhir);
            $max_date = $max_date->copy()->endOfDay();
        } else $max_date = Carbon::today()->endOfDay();

        $val = [];
        if ($req->status == 2){
            $val[] = 0;
            $val[] = 1;
        }
        else if ($req->status == 1) $val[] = 1;
        else $val[] = 0;

        $stat = [];
        if ($req->status_ditelaah == 2){
            $stat[] = 0;
            $stat[] = 1;
        }
        else if ($req->status_ditelaah == 1) $stat[] = 1;
        else $stat[] = 0;

        $cito =[];
        if($req->cito == 1)$cito[] =1;
        else{
            $cito[] =0;
            $cito[] =1;
        }
        $is_video =[];
        if($req->is_video == 1)$is_video[] =1;
        else{
            $is_video[] =0;
            $is_video[] =1;
        }
        $transaksi = TransaksiObat::with(['pasien_detail','ori_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('farmasi_id', $req->farmid)->whereBetween('created_at', [$min_date, $max_date])->whereIn('status', $val)->whereIn('status_ditelaah', $stat)->whereIn('cito',$cito)->whereIn('is_video',$is_video);
        if($req->jenis_pembayaran){
            $perusahaan_ids = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanByTipe($req->jenis_pembayaran)->pluck('id');
            $pasien_pembayaran_ids = $transaksi->get()->pluck('metode_pembayaran_id');
            if(!empty($pasien_pembayaran_ids)){
                $pasien_pembayaran_id = PasienPembayaran::whereIn('id',$pasien_pembayaran_ids)->whereIn('perusahaan_id',$perusahaan_ids)->get()->pluck('id');
                $transaksi = TransaksiObat::with(['pasien_detail','ori_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('farmasi_id', $req->farmid)
                    ->whereBetween('created_at', [$min_date, $max_date])
                    ->whereIn('status', $val)
                    ->whereIn('status_ditelaah', $stat)
                    ->whereIn('cito',$cito)
                    ->whereIn('metode_pembayaran_id',$pasien_pembayaran_id);
            }
        }
        // dd($transaksi->get());
        return $transaksi;
    }

    public function getSingle($slug)
    {   
        $day = Carbon::now();
        $transaksi = TransaksiObat::with(['pasien_detail','final_detail.resep_detail.log','lokasi','pembayaran_detail', 'dokter', 'final_detail.resep_detail.racikan.obat_detail.item_detail'])->where('slug',$slug)->first();
        //$transaksi->fyi = TransaksiObat::where('pasien_id',$transaksi->pasien_id)->whereDate('paid_at',date('Y-m-d', strtotime($transaksi->created_at)))->first();
        if(!empty($transaksi->pasien_id))
        $transaksi->fyi = TransaksiObat::with('kasus')->where('pasien_id',$transaksi->pasien_id)->whereDate('paid_at', '>=', $day->copy()->startOfDay())->first();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $transaksi;
    }

    public function getSingleOnly($slug)
    {   
        $transaksi = TransaksiObat::with(['pasien_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('slug',$slug)->first();
        return $transaksi;
    }

    // UNTUK KEBUTUHAN CEK PEMAKAIAN OBAT
    public function getFromPasienIdForResep($pasien_id)
    {   
        $transaksi = TransaksiObat::with(['final_detail','final_detail.resep_detail','final_detail.resep_detail.obat_detail'])->where('pasien_id',$pasien_id)->orderBy('created_at','desc')->get();
        return $transaksi;
    }

    public function getUnconfirmed($id)
    {
        $transaksi = TransaksiObat::with(['pasien_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('farmasi_id', $id)->where('status', 0)->whereNull('transaksi_asal_id')->latest()->limit(10)->get();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();

        return $transaksi;
    }

    public function filteredData($limit, $offset, $tgl_awal, $tgl_akhir, $no_resep, $no_rm, $status, $pasien_id, $farmasi_id, $status_ditelaah)
    {   
        $transaksi = TransaksiObat::with(['pasien_detail','ori_detail','final_detail','lokasi','pembayaran_detail', 'dokter'])->where('farmasi_id', $farmasi_id);
        
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
        
        $transaksi = $transaksi->whereBetween('created_at', [$min_date, $max_date]);

        /*if(!is_null($harga_min)) {
            $transaksi = $transaksi->where('total_biaya_obat', '>=', $harga_min);
        }

        if(!is_null($harga_max)) {
            $transaksi = $transaksi->where('total_biaya_obat', '<=', $harga_max);
        }*/

        if(!is_null($pasien_id)) {
            $transaksi = $transaksi->where('pasien_id', $pasien_id);
        }

        if(!is_null($no_resep)) {
            $transaksi = $transaksi->whereHas('final_detail', function($fin) use($no_resep){
                $fin->where('nomor_resep', $no_resep);
            });
        }

        if(!is_null($no_rm)) {
            $transaksi = $transaksi->whereHas('pasien_detail', function($pas) use($no_rm){
                $pas->from(config('app.db_name').'_patients.pasien')->where('no_rm', $no_rm);
            });
        }

        if($status != 2) {
            $transaksi = $transaksi->where('status', $status);
        }

        if(!is_null($status_ditelaah)) {
            $transaksi = $transaksi->where('status_ditelaah', $status_ditelaah);
        }

        $count = $transaksi->orderBy('created_at','desc')->get()->count();

        if(isset($limit))
            $transaksi = $transaksi->limit($limit)->offset($offset);
        $transaksi = $transaksi->get();
        $transaksi->count = $count;

        return $transaksi;
    }

    public function getLaporanTransaksi($tgl_awal,$tgl_akhir,$shift=null,$farmasi_id,$flag=null)
    {
        $transaksi = TransaksiObat::with('final_detail','pasien_detail','pembayaran_detail.perusahaan')->where('farmasi_id', $farmasi_id);
        if($flag == 1)
        {
            $transaksi = $transaksi->where('pasien_id',null);
        }
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

        $transaksi = $transaksi->whereBetween('created_at', [$min_date, $max_date]);
        if($shift != null)
            if(count($shift) > 0)
                $transaksi = $transaksi->whereIn('shift_id',$shift);

        $transaksi = $transaksi->get();


        $transaksi_return = [];
        foreach($transaksi as $item)
        {
            $temp['nomor_resep'] = (!empty($item->final_detail->nomor_resep)) ? $item->final_detail->nomor_resep : '-';
            $temp['nama_pasien'] = (!empty($item->pasien_detail->name)) ? $item->pasien_detail->name : 'Pasien Bebas';
            $temp['jenis_pasien'] = (!empty($item->pembayaran_detail->perusahaan->nama)) ? $item->pembayaran_detail->perusahaan->nama : 'Pasien Bebas';
            $temp['biaya_obat'] = $item->total_biaya_obat - $item->embalase;
            $temp['embalase'] = $item->embalase;
            $temp['total_biaya_obat'] = $item->total_biaya_obat;
            $temp['slug'] = $item->slug;

            array_push($transaksi_return, $temp);
        }

        usort($transaksi_return, function($a, $b) {
            return $a['jenis_pasien'] <=> $b['jenis_pasien'];
        });



        return $transaksi_return;

    }

    public function getStatistik($id)
    {
        //Statistik per bulan
        $day = Carbon::now();
        $current_month = $day->copy()->month;
        $start_month = $day->copy()->subMonths(3)->month;
        
        $months = [];
        for ($i=0 ;$i <4 ; $i++) {
            $months[$i] = $start_month+$i;
            if($months[$i]>12)
                $months[$i]-=12;
        }

        $transaksi = TransaksiObat::where('farmasi_id',$id)->whereDate('paid_at', '>=', $day->copy()->startOfDay());
        $count = $transaksi->count();

        $transaksi = TransaksiObat::where('farmasi_id',$id)
                ->whereDate('paid_at', '>=', $day->copy()->subMonths(3)->startOfMonth())
                ->whereDate('paid_at', '<=', $day->copy()->endOfMonth())
                    ->groupBy('month')
                    ->orderBy('year', 'ASC')
                    ->orderBy('month', 'ASC')
                    ->get(array(
                            DB::raw('MONTH(created_at) as month'),
                            DB::raw('YEAR(created_at) as year'),
                            DB::raw('COUNT(*) as "transaksi_count"')
                        ))->toArray();

        $transaksi = array_combine( array_map(function($trans){
                            return $trans['month'];
                        }, $transaksi),
                    $transaksi);
        $j=0;
        foreach ($months as $i => $value) {
            if(!empty($transaksi) && array_key_exists($value, $transaksi)){
                $data[$i] = $transaksi[$value];
            }else{
                $data[$i]['month'] = $i;
                $data[$i]['transaksi_count'] = 0;
            }
        }

        $data['count'] = $count;
        return $data;
    }

    public function ajaxGetTransaksi($slug)
    {
        $day = Carbon::now();
        $transaksi = TransaksiObat::where('slug',$slug)->with('final_detail', 'pasien_detail', 'kasus_detail', 'kasus_detail.identitas', 'final_detail.resep_detail')->first();
        //$transaksi->fyi = TransaksiObat::where('pasien_id',$transaksi->pasien_id)->whereDate('paid_at',date('Y-m-d', strtotime($transaksi->created_at)))->first();
        $transaksi->fyi = TransaksiObat::where('pasien_id',$transaksi->pasien_id)->whereDate('paid_at', '>=', $day->copy()->startOfDay())->first();
        $transaksi->loket_antrian = LoketAntrian::all();
        // $transaction = Transaction::orderBy($order_by, 'desc')->get();
        return json_encode($transaksi);
    }


    public function getLaporanTransaksiSortedResep($tgl_awal,$tgl_akhir,$shift=null,$farmasi_id,$flag=null)
    {
        $transaksi = TransaksiObat::with('final_detail','pasien_detail','pembayaran_detail.perusahaan')->where('farmasi_id', $farmasi_id)->where('status', 1);
        if($flag == 1)
        {
            $transaksi = $transaksi->where('pasien_id',null);
        }
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

        $transaksi = $transaksi->whereBetween('created_at', [$min_date, $max_date]);
        if($shift != null && count($shift) > 0)
            $transaksi = $transaksi->whereIn('shift_id',$shift);

        $transaksi = $transaksi->get();


        $transaksi_return = [];
        foreach($transaksi as $item)
        {
            $temp['nomor_resep'] = (!empty($item->final_detail->nomor_resep)) ? $item->final_detail->nomor_resep : '-';
            $angka = preg_replace('/[^0-9]/', '', $temp['nomor_resep']);
            $huruf = preg_replace('/[^A-Za-z?!]/', '', $temp['nomor_resep']);
            // dd($angka, $huruf, $temp['nomor_resep']);
            $temp['nomor_resep_formatted'] = strtolower($huruf).$angka;
            $temp['nomor_resep_huruf'] = strtoupper($huruf);
            $temp['nama_pasien'] = (!empty($item->pasien_detail->name)) ? $item->pasien_detail->name : ((!empty($item->nama_pasien)) ? $item->nama_pasien : '-');
            $temp['jenis_pasien'] = (!empty($item->pembayaran_detail->perusahaan->nama)) ? $item->pembayaran_detail->perusahaan->nama : 'Pasien Bebas';
            $temp['biaya_obat'] = $item->total_biaya_obat - $item->embalase;
            $temp['embalase'] = $item->embalase;
            $temp['total_biaya_obat'] = $item->total_biaya_obat;
            $temp['slug'] = $item->slug;

            array_push($transaksi_return, $temp);
        }

        usort($transaksi_return, function($a, $b) {
            return strcmp($a['nomor_resep_formatted'], $b['nomor_resep_formatted']);
        });



        return $transaksi_return;

    }

    

    public function getKemoterapi($farmasi_id, $tgl_min, $tgl_max)
    {
        $transaksi = TransaksiObat::with('pasien_detail', 'lokasi', 'kasus', 'final_detail','final_detail')
                    ->where('farmasi_id', $farmasi_id)
                    ->whereBetween('paid_at', array($tgl_min,$tgl_max))
                    ->orderBy('paid_at','desc')
                    ->whereHas('final_detail', function ($q) {
                        $q->where('is_kemo', 1);
                    })
                    ->get();
        return $transaksi;
    }

    public function getStatistikJumlahTransaksiPerBulan($farmasi_ids,$month_start,$month_end){
        $current_month = $month_start;
        $data = [];
        $index = 1;
        $select_query = "SELECT * FROM";
        $iteration = $month_start->diffInMonths($month_end);
        for($i=1;$i<=$iteration;$i++)
        {
            $index = $i;
            $current_month_start = $current_month->copy()->startOfMonth();
            $current_month_end = $current_month->copy()->endOfMonth();

            $select_query.= "
            (
                SELECT IFNULL(COUNT(1),0) AS transaksi_$index FROM `transaksi_obat`
                    WHERE paid_at <= '".$current_month_end->toDateTimeString()."'
                    AND paid_at >= '".$current_month_start->toDateTimeString()."'
                    AND farmasi_id IN (".implode(",", $farmasi_ids).")
            )table_$index";
            if($i != $iteration)
            {
                $select_query.=",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }
        $transaksi = DB::connection('farmasi')->select($select_query);

        $new_data = [];
        foreach($data as $index =>$item)
        {   
            $variable = "transaksi_".$item;
            $value = $transaksi[0]->$variable;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = $value;
            $new_data[] = $object;
        }
        return $new_data;
    }

    public function getStatistikNilaiTransaksiPerBulan($farmasi_ids,$month_start,$month_end){
        $current_month = $month_start;
        $data = [];
        $index = 1;
        $select_query = "SELECT * FROM";
        $iteration = $month_start->diffInMonths($month_end);
        for($i=1;$i<=$iteration;$i++)
        {
            $index = $i;
            $current_month_start = $current_month->copy()->startOfMonth();
            $current_month_end = $current_month->copy()->endOfMonth();

            $select_query.= "
            (
                SELECT IFNULL(SUM(total_biaya_obat),0) AS transaksi_$index FROM `transaksi_obat`
                    WHERE paid_at <= '".$current_month_end->toDateTimeString()."'
                    AND paid_at >= '".$current_month_start->toDateTimeString()."'
                    AND farmasi_id IN (".implode(",", $farmasi_ids).")
            )table_$index";
            if($i != $iteration)
            {
                $select_query.=",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }
        $transaksi = DB::connection('farmasi')->select($select_query);

        $new_data = [];
        foreach($data as $index =>$item)
        {   
            $variable = "transaksi_".$item;
            $value = $transaksi[0]->$variable;
            $value = $value/1000000;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = number_format((float)$value, 1, '.', '');
            $new_data[] = $object;
        }
        return $new_data;
    }

    public function getStatistikResponseTimeTransaksiPerBulan($farmasi_ids,$month_start,$month_end){
        $current_month = $month_start;
        $data = [];
        $index = 1;
        $select_query = "SELECT * FROM";
        $iteration = $month_start->diffInMonths($month_end);
        for($i=1;$i<=$iteration;$i++)
        {
            $index = $i;
            $current_month_start = $current_month->copy()->startOfMonth();
            $current_month_end = $current_month->copy()->endOfMonth();

            $select_query.= "
            (
                SELECT IFNULL(AVG(ratarata),0) AS transaksi_$index FROM
                (
                    SELECT IFNULL(TIMESTAMPDIFF(MINUTE,dikerjakan_at,paid_at),0) AS ratarata FROM `transaksi_obat`
                        WHERE paid_at <= '".$current_month_end->toDateTimeString()."'
                        AND paid_at >= '".$current_month_start->toDateTimeString()."'
                        AND dikerjakan_at <= '".$current_month_end->toDateTimeString()."'
                        AND dikerjakan_at >= '".$current_month_start->toDateTimeString()."'
                        AND farmasi_id IN (".implode(",", $farmasi_ids).")
                )table_inner_$index
            )table_$index";
            if($i != $iteration)
            {
                $select_query.=",";
            }
            $current_month->addMonth();
            $data[$current_month->format('Y-m')] = $index;
        }
        $transaksi = DB::connection('farmasi')->select($select_query);
        $new_data = [];
        foreach($data as $index =>$item)
        {   
            $variable = "transaksi_".$item;
            $value = $transaksi[0]->$variable;

            $object = new \stdClass();
            $object->date = $index;
            $object->value = number_format((float)$value, 1, '.', '');
            $new_data[] = $object;
        }
        return $new_data;
    }

    public function getStatistikDistribusiAsuransi($farmasi_ids,$start,$end)
    {
        $query = "
        SELECT table1.nama as nama, IFNULL(table2.total,0) AS value
        FROM `".config('app.db_name')."._patients`.`pembayaran_perusahaan_tipe` table1
        LEFT JOIN 
        (
            SELECT ptt.`nama`, COUNT(1) as total FROM 
                `".config('app.db_name')."._farmasi`.`transaksi_obat` t,
                `".config('app.db_name')."._patients`.`pasien_pembayaran` pp,
                `".config('app.db_name')."._patients`.`pembayaran_perusahaan` pt,
                `".config('app.db_name')."._patients`.`pembayaran_perusahaan_tipe` ptt
            WHERE t.`metode_pembayaran_id` = pp.`id`
            AND pp.`perusahaan_id` = pt.`id`
            AND pt.`type` = ptt.`id`
            AND t.paid_at <= '".$end->toDateTimeString()."'
            AND t.paid_at >= '".$start->toDateTimeString()."'
            AND t.farmasi_id IN (".implode(",", $farmasi_ids).")
            GROUP BY ptt.`nama`
        )table2
        ON table1.`nama` = table2.nama
        ";
        $data = DB::connection('farmasi')->select($query);

        return $data;
    }

    public function getStatistikRankTopObat($farmasi_ids,$start,$end,$limit)
    {
        $query = "
        SELECT * FROM (
            SELECT 
                SUM(rd.`jumlah`) AS jumlah, it_t.`nama` as obat_nama
            FROM 
                `transaksi_obat` t, 
                `resep` r, 
                `resep_detail` rd, 
                `items_farmasi` it_f, 
                `item_template` it_t
            WHERE 
                t.`resep_final` = r.`id`
                AND r.`id` = rd.`resep_id`
                AND rd.`obat_id` = it_f.`id`
                AND it_f.`item_template_id` = it_t.`id`
                AND t.paid_at <= '".$end->toDateTimeString()."'
                AND t.paid_at >= '".$start->toDateTimeString()."'
                AND t.farmasi_id IN (".implode(",", $farmasi_ids).")
            GROUP BY it_t.`nama`) table1
        ORDER BY jumlah DESC
        LIMIT $limit
        ";
        $data = DB::connection('farmasi')->select($query);
        return $data;
    }

    public function getStatistikAllDistribusiJumlah($start,$end)
    {
        $query = "
        SELECT table1.nama as nama, IFNULL(table2.total,0) AS value
        FROM farmasi table1
        LEFT JOIN 
        (
            SELECT farmasi_id, COUNT(1) AS total 
            FROM transaksi_obat
            WHERE paid_at <= '".$end->toDateTimeString()."'
            AND paid_at >= '".$start->toDateTimeString()."'
            GROUP BY farmasi_id
        )table2
        ON table1.`id` = table2.farmasi_id
        ";
        $data = DB::connection('farmasi')->select($query);

        return $data;
    }


    public function getStatistikAllDistribusiNilai($start,$end)
    {
        $query = "
        SELECT table1.nama as nama, IFNULL(table2.total,0) AS value
        FROM farmasi table1
        LEFT JOIN 
        (
            SELECT farmasi_id, SUM(total_biaya_obat) AS total 
            FROM transaksi_obat
            WHERE paid_at <= '".$end->toDateTimeString()."'
            AND paid_at >= '".$start->toDateTimeString()."'
            GROUP BY farmasi_id
        )table2
        ON table1.`id` = table2.farmasi_id
        ";
        $data = DB::connection('farmasi')->select($query);

        foreach($data as $item)
        {
            $value = $item->value/1000000;
            $item->value = number_format((float)$value, 1, '.', '');
        }

        return $data;
    }

    public function getHistori($pasien_id)
    {
        if($pasien_id == 0) return [];
        $transaksi = TransaksiObat::where('pasien_id',$pasien_id)->with('final_detail.resep_detail','ori_detail.resep_detail')->orderBy('created_at','desc')->get();
        $pasien = Pasien::find($pasien_id);

        $data = [];
        foreach($transaksi as $item)
        {
            $temp = new \stdClass();
            $temp->colspan="4";
            $temp->trclass = "table-warning";
            $temp->nomor = "";
            $temp->nama = $item->created_at->format('d F Y');
            $temp->signa = "";
            $data[] = $temp;

            $count = 1;

            if(!empty($item->final_detail)) $resep_details = $item->final_detail->resep_detail;
            else $resep_details = $item->ori_detail->resep_detail;

            foreach($resep_details as $resep_item)
            {
                $temp = new \stdClass();
                $temp->colspan="1";
                $temp->trclass = "";
                $temp->nomor = $count++;
                $temp->nama = $resep_item->nama_obat;
                $temp->signa = $resep_item->aturan;
                $temp->jumlah = $resep_item->jumlah;
                $temp->satuan = $resep_item->satuan;
                $data[] = $temp;
            }
        }

        $return['data'] = $data;
        $return['pasien'] = $pasien->name;

        return json_encode($return);
    }

    public function getByPasienDate($pasien_id, $tanggal_awal, $tanggal_akhir)
    {
        $transaksi = TransaksiObat::with(['final_detail.resep_detail'])
                    ->where('pasien_id',$pasien_id)
                    ->where('created_at','>=',$tanggal_awal)
                    ->where('created_at','<=',$tanggal_akhir)
                    ->whereNull('paid_at')
                    ->whereNull('deleted_at')
                    ->get();

        return $transaksi;
    }

    public function getById($id)
    {
        $transaksi = TransaksiObat::with(['final_detail.resep_detail', 'pembayaran_detail.perusahaan.tipe', 'lokasi'])
                    ->where('id',$id)
                    ->first();

        return $transaksi;
    }

    public function getByDateNow()
    {
        $min_date = Carbon::today()->startOfDay();
        $max_date = Carbon::today()->endOfDay();
        
        $transaksi = TransaksiObat::whereBetween('created_at', [$min_date, $max_date])->get();

        return $transaksi;
    }

    public function getDataScreen($farmasi_id, $screen_id)
    {
        $screen = ScreenAntrian::find($screen_id);
        $arr_jenis_resep = json_decode($screen->jenis_resep);
        $arr_jenis_antrian = json_decode($screen->jenis_antrian);
        $arr_perusahaan_type = JenisAntrian::whereIn('id',$arr_jenis_antrian)->orderBy('perusahaan_tipe')->pluck('perusahaan_tipe')->toArray();
        if($arr_perusahaan_type[0] == 0) $arr_perusahaan_type = PembayaranPerusahaanType::pluck('id')->toArray();

        $tunai_id = PembayaranPerusahaanType::where('slug','tunai')->pluck('id')->first();
        if(in_array($tunai_id, $arr_perusahaan_type)) $screen_tunai = 1;
        else $screen_tunai = 0;

        $min_date = Carbon::today()->startOfDay();
        $max_date = Carbon::today()->endOfDay();

        $transaksi = TransaksiObat::selectRaw('transaksi_obat.*')->with(['pembayaran_detail.perusahaan.tipe', 'lokasi', 'pasien_detail'])
            ->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaksi_obat.metode_pembayaran_id')
            ->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
            ->where('farmasi_id', $farmasi_id)
            ->whereBetween('transaksi_obat.created_at', [$min_date, $max_date])
            ->where('status','<>',1)
            ->whereNotNull('waktu_check_in')
            ->whereNotNull('nomor_antrian')
            ->whereIn('jenis_resep_antrian', $arr_jenis_resep)
            ->when($screen_tunai == 1, function ($query) use ($arr_perusahaan_type) {
                $query->where(function ($query2) use ($arr_perusahaan_type){
                    $query2->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type)
                        ->orWhereNull('metode_pembayaran_id');
                });
            })
            ->when($screen_tunai != 1, function ($query) use ($arr_perusahaan_type) {
                $query->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type);
            })
            ->orderBy('nomor_antrian')
            // ->take(15)
            ->get();

        return $transaksi;
    }

    public function getDataRealtime($request, $farmasi_id, $screen_id)
    {
        $screen = ScreenAntrian::find($screen_id);
        $arr_jenis_resep = json_decode($screen->jenis_resep);
        $arr_jenis_antrian = json_decode($screen->jenis_antrian);
        $arr_perusahaan_type = JenisAntrian::whereIn('id',$arr_jenis_antrian)->orderBy('perusahaan_tipe')->pluck('perusahaan_tipe')->toArray();
        if($arr_perusahaan_type[0] == 0) $arr_perusahaan_type = PembayaranPerusahaanType::pluck('id')->toArray();

        $tunai_id = PembayaranPerusahaanType::where('slug','tunai')->pluck('id')->first();
        if(in_array($tunai_id, $arr_perusahaan_type)) $screen_tunai = 1;
        else $screen_tunai = 0;

        $min_date = Carbon::today()->startOfDay();
        $max_date = Carbon::today()->endOfDay();
        $transaksi_shown = $request->transaksi_id;
        if (is_null($transaksi_shown)) {
            $transaksi_shown = [];
        }

        $transaksi = TransaksiObat::selectRaw('transaksi_obat.*')->with(['pembayaran_detail.perusahaan.tipe', 'lokasi', 'pasien_detail'])
            ->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaksi_obat.metode_pembayaran_id')
            ->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
            ->where('farmasi_id', $farmasi_id)
            ->whereBetween('transaksi_obat.created_at', [$min_date, $max_date])
            ->whereNotIn('transaksi_obat.id',$transaksi_shown)
            ->where('status','<>',1)
            ->whereNotNull('waktu_check_in')
            ->whereNotNull('nomor_antrian')
            ->whereIn('jenis_resep_antrian', $arr_jenis_resep)
            ->when($screen_tunai == 1, function ($query) use ($arr_perusahaan_type) {
                $query->where(function ($query2) use ($arr_perusahaan_type){
                    $query2->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type)
                        ->orWhereNull('metode_pembayaran_id');
                });
            })
            ->when($screen_tunai != 1, function ($query) use ($arr_perusahaan_type) {
                $query->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type);
            })
            ->orderBy('nomor_antrian')
            ->get();

        foreach ($transaksi as $key => $value) {
            $value->selesai_at = date('d-m-Y H:i:s', strtotime($value->waktu_estimasi_selesai));
        }

        return $transaksi;
    }

    public function getDataRealtimeShown($request, $farmasi_id, $screen_id)
    {
        $screen = ScreenAntrian::find($screen_id);
        $arr_jenis_resep = json_decode($screen->jenis_resep);
        $arr_jenis_antrian = json_decode($screen->jenis_antrian);
        $arr_perusahaan_type = JenisAntrian::whereIn('id',$arr_jenis_antrian)->orderBy('perusahaan_tipe')->pluck('perusahaan_tipe')->toArray();
        if($arr_perusahaan_type[0] == 0) $arr_perusahaan_type = PembayaranPerusahaanType::pluck('id')->toArray();

        $tunai_id = PembayaranPerusahaanType::where('slug','tunai')->pluck('id')->first();
        if(in_array($tunai_id, $arr_perusahaan_type)) $screen_tunai = 1;
        else $screen_tunai = 0;

        $min_date = Carbon::today()->startOfDay();
        $max_date = Carbon::today()->endOfDay();
        $transaksi_shown = $request->transaksi_id;
        if (is_null($transaksi_shown)) {
            $transaksi_shown = [];
        }

        $transaksi = TransaksiObat::selectRaw('transaksi_obat.*')->withTrashed()->with(['pembayaran_detail.perusahaan.tipe', 'lokasi', 'pasien_detail'])
            ->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaksi_obat.metode_pembayaran_id')
            ->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
            ->where('farmasi_id', $farmasi_id)
            ->whereBetween('transaksi_obat.created_at', [$min_date, $max_date])
            ->whereIn('transaksi_obat.id',$transaksi_shown)
            ->whereNotNull('waktu_check_in')
            ->whereNotNull('nomor_antrian')
            ->whereIn('jenis_resep_antrian', $arr_jenis_resep)
            ->when($screen_tunai == 1, function ($query) use ($arr_perusahaan_type) {
                $query->where(function ($query2) use ($arr_perusahaan_type){
                    $query2->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type)
                        ->orWhereNull('metode_pembayaran_id');
                });
            })
            ->when($screen_tunai != 1, function ($query) use ($arr_perusahaan_type) {
                $query->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type);
            })
            // ->where('status','<>',1)
            ->orderBy('nomor_antrian')
            ->get()->toArray();

        return $transaksi;
    }

    public function getDataRealtimeBoxShown($request, $farmasi_id, $screen_id)
    {
        $screen = ScreenAntrian::find($screen_id);
        $arr_jenis_resep = json_decode($screen->jenis_resep);
        $arr_jenis_antrian = json_decode($screen->jenis_antrian);
        $arr_perusahaan_type = JenisAntrian::whereIn('id',$arr_jenis_antrian)->orderBy('perusahaan_tipe')->pluck('perusahaan_tipe')->toArray();
        if($arr_perusahaan_type[0] == 0) $arr_perusahaan_type = PembayaranPerusahaanType::pluck('id')->toArray();

        $tunai_id = PembayaranPerusahaanType::where('slug','tunai')->pluck('id')->first();
        if(in_array($tunai_id, $arr_perusahaan_type)) $screen_tunai = 1;
        else $screen_tunai = 0;

        $min_date = Carbon::today()->startOfDay();
        $max_date = Carbon::today()->endOfDay();

        $transaksi = TransaksiObat::selectRaw('transaksi_obat.*')->with(['loket_antrian'])
            ->leftJoin(config('app.db_name') . '_patients.pasien_pembayaran', 'pasien_pembayaran.id', '=', 'transaksi_obat.metode_pembayaran_id')
            ->leftJoin(config('app.db_name') . '_patients.pembayaran_perusahaan', 'pembayaran_perusahaan.id', '=', 'pasien_pembayaran.perusahaan_id')
            ->where('farmasi_id', $farmasi_id)
            ->whereBetween('transaksi_obat.created_at', [$min_date, $max_date])
            ->whereNotNull('nomor_antrian')
            ->whereIn('jenis_resep_antrian', $arr_jenis_resep)
            ->when($screen_tunai == 1, function ($query) use ($arr_perusahaan_type) {
                $query->where(function ($query2) use ($arr_perusahaan_type){
                    $query2->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type)
                        ->orWhereNull('metode_pembayaran_id');
                });
            })
            ->when($screen_tunai != 1, function ($query) use ($arr_perusahaan_type) {
                $query->whereIn('pembayaran_perusahaan.type', $arr_perusahaan_type);
            })
            ->whereNotNull('loket_id')
            ->where('status_panggil', 0)
            ->first();

        if ($transaksi) {
            $transaksi->status_panggil = 1;
            $transaksi->save();
        }

        return $transaksi;
    }
}