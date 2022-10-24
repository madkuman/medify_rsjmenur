<?php

namespace App\Http\Controllers\HighLevel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\LogTransaksi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\JenisPasien;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class FarmasiController extends Controller
{
    public function index()
	{
        $farmasi = Farmasi::where('jenis','!=',4)->get();
    	$data['farmasi'] = $farmasi;
        $data['farmasi_id'] = $farmasi->pluck('id')->toArray();


		return view('highlevel.farmasi',$data);
	}

    public function getTransaksiBulanan(Request $request)
    {
        $yearly_end = Carbon::now()->endOfMonth();
        $yearly_start = Carbon::now()->subYear()->startOfMonth();
        $data = [];
        $farmasi = explode(",", $request->farmasi);

        $custom_date = $request->custom_date;
        if(empty($custom_date)) $custom_date = 'bulan';

        if($custom_date == 'bulan'){
            $custom_start_date = Carbon::now()->startOfMonth();
            $custom_end_date = Carbon::now()->endOfMonth();
        }
        elseif($custom_date == 'triwulan'){
            $custom_start_date = Carbon::now()->firstOfQuarter();
            $custom_end_date = Carbon::now()->lastOfQuarter();
        } 
        elseif($custom_date == 'tahun'){
            $custom_start_date = Carbon::now()->startOfYear();
            $custom_end_date = Carbon::now()->endOfYear();
        } 

        if($request->type == 'jumlah'){
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikJumlahTransaksiPerBulan($farmasi,$yearly_start->copy(),$yearly_end->copy());
        }
        elseif($request->type == 'nilai'){
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikNilaiTransaksiPerBulan($farmasi,$yearly_start->copy(),$yearly_end->copy());
        }
        elseif($request->type == 'response-time'){
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikResponseTimeTransaksiPerBulan($farmasi,$yearly_start->copy(),$yearly_end->copy());
        }
        elseif($request->type == 'distribusi-asuransi-pasien')
        {
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikDistribusiAsuransi($farmasi,$custom_start_date,$custom_end_date);
        }
        elseif($request->type == 'rank-obat-top')
        {
            $limit = $request->limit ?? 10;
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikRankTopObat($farmasi,$custom_start_date,$custom_end_date,$limit);
        }
        elseif($request->type == 'jumlah-all')
        {
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikAllDistribusiJumlah($custom_start_date,$custom_end_date);
        }
        elseif($request->type == 'nilai-all')
        {
            $data = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistikAllDistribusiNilai($custom_start_date,$custom_end_date);
        }
        return json_encode($data);
    }

    public function getDistribusiPerusahaanAsuransi($type)
    {
        $query = "
        SELECT ptt.`nama`, COUNT(1) FROM 
            `medify_hospital_farmasi`.`transaksi_obat` t,
            `medify_hospital_patients`.`pasien_pembayaran` pp,
            `medify_hospital_patients`.`pembayaran_perusahaan` pt,
            `medify_hospital_patients`.`pembayaran_perusahaan_tipe` ptt
        WHERE t.`metode_pembayaran_id` = pp.`id`
        AND pp.`perusahaan_id` = pt.`id`
        AND pt.`type` = ptt.`id`
        GROUP BY ptt.`nama`;
        ";
    }
}
