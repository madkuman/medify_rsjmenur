<?php

namespace App\Console\Commands\Pasien\Laporan;

use App\Exports\Pasien\LaporanSensusRawatInapRuangan;
use Carbon\Carbon;
use File;
use Illuminate\Console\Command;

class GenerateSensusRawatInapRuangan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasien:laporan-generate-sensus-rawat-inap-ruangan {date=0} {ruangan=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate laporan sensus rawat inap per ruangan per bulan, format : YYYY-MM (2021-09)';

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
            $ruangan = $arguments['ruangan'];
            if($date == 0) $date = Carbon::now();
            else $date = Carbon::createFromFormat("Y-m",$date);

            $data = app(\App\Http\Controllers\Pasien\Laporan\LaporanSensusRawatInapRuanganController::class)->get($date, $ruangan);
    
            echo 'Generating '.$date."\n";
    
            $base_path = '/downloads/laporan/pasien/sensus-rawat-inap-ruangan';
            $path = public_path().$base_path;
            if(!file_exists($path))
                mkdir($path, 0777, true);
    
            $filename = 'Laporan Sensus Rawat Inap Ruangan '.$date->format('Y-m');
            $timestamp_now = Carbon::now()->timestamp;
            $format = '.xlsx';
    
            $laporan = new LaporanSensusRawatInapRuangan($data);
    
            $filename_stored = $filename.'-'.$timestamp_now.$format;
    
            $xls = $laporan->store($filename_stored);
            File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);
    
            $laporan_data = [];
            $laporan_data['slug'] = 'pasien-laporan-sensus-rawat-inap-ruangan';
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
