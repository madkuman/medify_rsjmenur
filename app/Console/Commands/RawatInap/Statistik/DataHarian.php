<?php

namespace App\Console\Commands\RawatInap\Statistik;

use Illuminate\Console\Command;

use App\Models\RawatInap\Transaksi;
use App\Models\Kasus\Kasus;
use App\Models\RawatInap\TempatTidur;
use Auth;
use Carbon\Carbon;
use DB;

class DataHarian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:data-harian';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data harian LOS, Hari Perawatan, Lama Dirawatan';

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
            $this->los();
            $this->hari_perawatan();
            $this->lama_perawatan();
            DB::connection('rawatinap')->commit();
            return "berhasil";

        }
        catch (\Exception $e) {
            DB::connection('rawatinap')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    public function los()
    {
        $query = Transaksi::whereNotNull('tempat_tidur_id')
                ->whereNull('waktu_keluar')
                ->whereNotNull('kedatangan_at')
                ->with('kasus')
                ->get();

        foreach ($query as $q) {
            $q->los += 1;
            $q->kasus->ranap_los += 1;
            $q->kasus->save();
           
            $q->save();
        }
    }

    public function lama_perawatan(){

        $now = Carbon::today();
        $kasus_igd = Kasus::where('tipe_igd',1)->whereNull('krs_at')->get();
        foreach($kasus_igd as $k)
        {
            $start_time = $k->created_at;
            $jam = $start_time->diffInHours($now);
            $day = $jam/24;

            $k->lama_perawatan = $day;
            $k->save();
        }

        $kasus_igd = Kasus::where('tipe_ri',1)->whereNull('krs_at')->whereNotNull('mrs_at')->get();
        foreach($kasus_igd as $k)
        {
            if(empty($k->mrs_at)) $start_time = $k->created_at;
            else $start_time = $k->mrs_at;

            if(empty($start_time)) dd($k->id);

            $jam = $start_time->diffInHours($now);
            $day = $jam/24;

            $k->lama_perawatan = $day;
            $k->save();
        }
    }

    public function hari_perawatan()
    {
        $query = Transaksi::where('status',1)->whereNotNull('tempat_tidur_id')->whereNull('waktu_keluar')->get();
        $tanggal = Carbon::today()->startOfDay();
        $bed_used_array = [];
        foreach($query as $transaksi)
        {
            array_push($bed_used_array, $transaksi->tempat_tidur_id);
            $hari_perawatan = app('App\Http\Controllers\RawatInap\StatistikHariPerawatan\CreateController')->create($tanggal, $transaksi->tempat_tidur_id, $transaksi->id);
        }

        $bed_unused_array = TempatTidur::whereNotIn('id',$bed_used_array)
            ->where('is_hitung_statistik',1)
            ->pluck('id')->toArray();
        foreach($bed_unused_array as $bed)
        {
            $hari_perawatan = app('App\Http\Controllers\RawatInap\StatistikHariPerawatan\CreateController')->create($tanggal, $bed, null);
        }
    }
}
