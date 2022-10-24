<?php

namespace App\Console\Commands\LabPK\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use App\Exports\LabPK\LaporanKunjunganTahunanPerTarifExcel;

class LaporanKunjunganTahunanPerTarifGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labpk:laporan-kunjungan-tahunan-per-tarif {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Kunjungan Tahunan Per Tarif Tahunan : YYYY-MM (2020-04)';

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
        $date = $arguments['date'];

        if($date == 0) $start = Carbon::now()->startOfYear();
        else $start = Carbon::parse($date)->startOfYear(); 

        if($date == 0) $end = Carbon::now()->subMonth()->endOfMonth();
        else $end = Carbon::parse($date)->endOfMonth();

        echo 'Generating '.$start->format('d-m-Y')." - ".$end->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/labpk/laporan-kunjungan-tahunan-per-tarif';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;
       
        $data['data'] = app('App\Http\Controllers\LabPK\Laporan\ReadLaporanKunjunganTahunanPerTarifController')->get($start,$end);

        $data['start_date'] = $start->copy();
        $data['end_date'] = $end->copy();


        $filename = 'Laporan Kunjungan Tahunan Per Tarif - '.$end->copy()->format('Y-m');
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$timestamp_now.$format;

        $xls = (new LaporanKunjunganTahunanPerTarifExcel($data))->store($filename_stored);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'lab-pk-laporan-kunjungan-tahunan-per-tarif';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
