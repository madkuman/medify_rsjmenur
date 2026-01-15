<?php

namespace App\Console\Commands\LabPK\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use App\Exports\LabPK\KunjunganBerdasarkanGenderDanUsiaExcel;

class KunjunganBerdasarkanGenderDanUsiaGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labpk:laporan-kunjungan-berdasarkan-gender-dan-usia {jenis_laporan=bulanan} {date=0} {date_end=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Lab PK Kunjungan Gender dan Usia Format : YYYY-MM (2020-04)';

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
        $arguments = $this->arguments();
        $jenis_laporan = $arguments['jenis_laporan'];
        $date = $arguments['date'];
        $date_end = $arguments['date_end'];

        if ($jenis_laporan == 'tahunan') {
            if ($date == 0) {
                $end = Carbon::now()->endOfYear();
            } else {
                $end = Carbon::parse($date."-01-01")->endOfYear();
            }
            $start = $end->copy()->subYear(4)->startOfYear();
        } else if ($jenis_laporan == 'mingguan') {
            if ($date == 0) {
                $start = Carbon::now()->startOfMonth();
            } else {
                $start = Carbon::parse($date)->startOfDay();
            }
            if ($date_end == 0) {
                $end = Carbon::now()->endOfMonth();
            } else {
                $end = Carbon::parse($date_end)->endOfDay();
            }
        } else {
            if($date == 0) $start = Carbon::now()->startOfYear();
            else $start = Carbon::parse($date)->startOfYear(); 
    
            if($date == 0) $end = Carbon::now()->subMonth()->endOfMonth();
            else $end = Carbon::parse($date)->endOfMonth();
        }

        echo 'Generating '.$start->format('d-m-Y')." - ".$end->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/labpk/kunjungan-berdasarkan-gender-dan-usia';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;
       
        $data['data'] = app('App\Http\Controllers\LabPK\Laporan\ReadKunjunganBerdasarkanGenderDanUsiaController')->get($jenis_laporan, $start,$end);

        if ($jenis_laporan == 'tahunan') {
            $data['periode_string'] = "Tahunan | Tahun : ". indonesian_date($end->copy(),'Y');
        } else if ($jenis_laporan == 'mingguan') {
            $data['periode_string'] = "Mingguan | Tanggal : ". indonesian_date($start->copy()). " sd " .indonesian_date($end->copy());
        } else {
            $data['periode_string'] = "Bulanan | Bulan : ". indonesian_date($end->copy(),'F Y');
        }

        if ($jenis_laporan == 'tahunan') {
            $date_string = $end->format('Y');
        } else if ($jenis_laporan == 'mingguan') {
            $date_string = $start->format('Y-m-d').' - '.$end->format('Y-m-d');
        } else {
            $date_string = $end->format('Y-m');
        }
        $filename = 'Kunjungan Berdasarkan Gender dan Usia - '.$jenis_laporan.' - '.$date_string;
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$timestamp_now.$format;

        $xls = (new KunjunganBerdasarkanGenderDanUsiaExcel($data))->store($filename_stored);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'lab-pk-kunjungan-berdasarkan-gender-dan-usia';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
