<?php

namespace App\Console\Commands\Pasien\Laporan;

use App\Exports\Pasien\LaporanSensusRawatInap;
use Carbon\Carbon;
use File;
use Illuminate\Console\Command;

class GenerateSensusRawatInap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasien:laporan-generate-sensus-rawat-inap {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate laporan sensus rawat inap per bulan, format : YYYY-MM (2021-09)';

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
        ini_set('max_execution_time', 50000); 

        try {
            echo "start\n";
            $arguments = $this->arguments();
            $date = $arguments['date'];
            if($date == 0) $date = Carbon::now();
            else $date = Carbon::createFromFormat("Y-m",$date);

            $data = app(\App\Http\Controllers\Pasien\Laporan\LaporanSensusRawatInapController::class)->get($date);
    
            echo 'Generating '.$date."\n";
    
            $base_path = '/downloads/laporan/pasien/sensus-rawat-inap';
            $path = public_path().$base_path;
            if(!file_exists($path))
                mkdir($path, 0777, true);
    
            $filename = 'Laporan Sensus Rawat Inap '.$date->format('Y-m');
            $timestamp_now = Carbon::now()->timestamp;
            $format = '.xlsx';
    
            $laporan = new LaporanSensusRawatInap($data);
    
            $filename_stored = $filename.'-'.$timestamp_now.$format;
    
            $xls = $laporan->store($filename_stored);
            File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);
    
            $laporan_data = [];
            $laporan_data['slug'] = 'pasien-laporan-sensus-rawat-inap';
            $laporan_data['start_date'] = $date->startOfMonth()->toDateTimeString();
            $laporan_data['end_date'] = $date->endOfMonth()->toDateTimeString();
            $laporan_data['file_name'] = $filename;
            $laporan_data['file_path'] = $base_path.'/'.$filename_stored;
    
            app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);
    
            echo 'done --'.$filename."\n";
    
            return 1;
        } catch(\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return 0;
        }
    }
}
