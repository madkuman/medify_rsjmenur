<?php

namespace App\Console\Commands\RawatInap\Statistik;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Console\Command;
use App\Models\RawatInap\Bto;
use App\Models\RawatInap\Bor;
use App\Models\RawatInap\ToiLog;
use App\Models\RawatInap\Statistik;
use App\Models\RawatInap\StatistikHariPerawatan;

use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Bugsnag;
use DB;

class RekapStatistikMain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:create-statistik-main {type} {start_date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::connection('rawatinap')->beginTransaction();
        try
        {
            $arguments = $this->arguments();
            $type = $arguments['type'];
            $start_date = $arguments['start_date'];

            $start = Carbon::createFromFormat('d-m-Y',$start_date)->startOfDay();
            if($type == 'hari') $end = $start->copy()->addDay();
            elseif($type == 'minggu'){ 
                $start->startOfWeek();
                $end = $start->copy()->addWeek();
            }
            else {
                $start->startOfMonth();
                $end = $start->copy()->addMonth();
            }

            $minggu_ke =  $start->copy()->weekOfYear;
            $bulan_ke = $start->copy()->format('m');
            $tahun_ke = $start->copy()->format('Y');

            $this->bor($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->avlos($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->toi($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->bto($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->ndr($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->gdr($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->distribusiIgd($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->distribusiRj($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->jumlah_tt($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->hari_perawatan($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->lama_dirawat($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->pasien_krs($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->pasien_krs_hidup($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->pasien_krs_mati($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->pasien_krs_mati_lebih_48($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);
            $this->pasien_krs_mati_kurang_48($type,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke);

            DB::connection('rawatinap')->commit();
        }
        catch (\Exception $e) {
            DB::connection('rawatinap')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke){
        $stat = new Statistik;
        $stat->jenis_statistik = $jenis_statistik;
        $stat->jenis_durasi = $jenis_durasi;
        $stat->start_date = $start;
        $stat->end_date = $end;
        $stat->value = $value ?? 0;
        $stat->minggu_ke = $minggu_ke;
        $stat->bulan_ke = $bulan_ke;
        $stat->tahun_ke = $tahun_ke;
        $stat->save();
    }

    public function jumlah_tt($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $kasur = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->groupBy('bed_id')->get();
        $value = count($kasur);
        $jenis_statistik = 'jumlah_tt';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function hari_perawatan($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $hari = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->groupBy('bed_id')->groupBy('tanggal')->get();
        $value = count($hari);
        $jenis_statistik = 'hari_perawatan';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function lama_dirawat($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $hari = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->whereNotNull('transaksi_id')->groupBy('bed_id')->groupBy('tanggal')->get();
        $value = count($hari);
        $jenis_statistik = 'lama_dirawat';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function pasien_krs($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $value = Kasus::whereBetween('krs_at',[$start,$end])->count();
        $jenis_statistik = 'pasien_krs';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])
            ->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','L');
            })->count();
        $jenis_statistik = 'pasien_krs_l';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])
            ->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','P');
            })->count();
        $jenis_statistik = 'pasien_krs_p';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function pasien_krs_hidup($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $value = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status','!=',$meninggal)->count();
        $jenis_statistik = 'pasien_krs_hidup';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status','!=',$meninggal)
            ->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','L');
            })->count();
        $jenis_statistik = 'pasien_krs_hidup_l';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status','!=',$meninggal)
            ->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','P');
            })->count();
        $jenis_statistik = 'pasien_krs_hidup_p';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function pasien_krs_mati($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $value = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->count();
        $jenis_statistik = 'pasien_krs_mati';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('krs_status','=',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','L');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_l';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('krs_status','=',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','P');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_p';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function pasien_krs_mati_lebih_48($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $value = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','>',2)->count();
        $jenis_statistik = 'pasien_krs_mati_lebih_48';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','>',2)->where('krs_status',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','L');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_lebih_48_l';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','>',2)->where('krs_status',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','P');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_lebih_48_p';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function pasien_krs_mati_kurang_48($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $value = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','<',2)->count();
        $jenis_statistik = 'pasien_krs_mati_kurang_48';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','<',2)->where('krs_status',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','L');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_kurang_48_l';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

        $value =  Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','<',2)->where('krs_status',$meninggal)->whereHas('identitas',function($q){
                $q->where('jenis_kelamin','P');
            })->count();
        $jenis_statistik = 'pasien_krs_mati_kurang_48_p';
        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }


    public function bor($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $hari_perawatan = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->whereNotNull('transaksi_id')->count();
        $jumlah_hari = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->count();


        $jenis_statistik = 'bor';
        if($jumlah_hari == 0 || $hari_perawatan == 0) $value = 0;
        else $value = $hari_perawatan/$jumlah_hari;

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);

    }

    public function avlos($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $value = Kasus::whereBetween('mrs_at',[$start,$end])->where('tipe_ri',1)->avg('ranap_los');
        $jenis_statistik = 'avlos';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function toi($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $hari_kosong = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->whereNull('transaksi_id')->count();
        $total_krs = Kasus::where('tipe_ri',1)->whereBetween('krs_at',[$start,$end])->count();

        if($hari_kosong == 0 || $total_krs == 0) $value = 0; 
        else $value = $hari_kosong/$total_krs;

        $jenis_statistik = 'toi';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function bto($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){

        $total_bed = StatistikHariPerawatan::whereBetween('tanggal',[$start,$end])->groupBy('bed_id')->count();
        $total_krs = Kasus::where('tipe_ri',1)->whereBetween('krs_at',[$start,$end])->count();
        if($total_bed == 0 || $total_krs == 0) $value = 0; 
        else $value = $total_krs/$total_bed;

        $jenis_statistik = 'bto';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function ndr($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $total_kasus_48 = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->where('lama_perawatan','>',2)->count();

        $total_krs = Kasus::whereBetween('krs_at',[$start,$end])->count();

        if($total_kasus_48 == 0 || $total_krs == 0) $value = 0; 
        else $value = $total_kasus_48/$total_krs*1000;

        $jenis_statistik = 'ndr';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function gdr($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        $total_krs_meninggal = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->count();
        $total_krs = Kasus::whereBetween('krs_at',[$start,$end])->count();

        if($total_krs == 0 || $total_krs_meninggal == 0) $value = 0; 
        else $value = $total_krs_meninggal/$total_krs*1000;

        $jenis_statistik = 'gdr';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function distribusiIgd($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $total_igd = Kasus::whereBetween('mrs_at',[$start,$end])->where('tipe_ri',1)->where('tipe_igd',1)->count();
        $total_mrs = Kasus::whereBetween('mrs_at',[$start,$end])->where('tipe_ri',1)->count();

        if($total_igd == 0 || $total_mrs == 0) $value = 0; 
        else $value = $total_igd;

        $jenis_statistik = 'distribusi-igd';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

    public function distribusiRj($jenis_durasi,$start,$end,$minggu_ke,$bulan_ke,$tahun_ke){
        $total_rj = Kasus::whereBetween('mrs_at',[$start,$end])->where('tipe_ri',1)->where('tipe_rj',1)->count();
        $total_mrs = Kasus::whereBetween('mrs_at',[$start,$end])->where('tipe_ri',1)->count();

        if($total_rj == 0 || $total_mrs == 0) $value = 0; 
        else $value = $total_rj;

        $jenis_statistik = 'distribusi-rj';

        $this->createStatistik($jenis_statistik,$jenis_durasi,$start,$end,$value,$minggu_ke,$bulan_ke,$tahun_ke);
    }

}
