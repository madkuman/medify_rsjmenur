<?php

namespace App\Console\Commands\Radiologi\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Exports\Radiologi\HistoriPemeriksaanPasienHarian;
use File;

class HistoriPemeriksaanPasienHarianGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'radiologi:laporan-histori-pemeriksaan-pasien-harian {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Radiologi Histori HARIAN Format : dd-mm-yyyy';

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

        if($date == 0) $start = Carbon::now()->subDay()->startOfDay();
        else $start = Carbon::parse($date);
         
        $end = $start->copy()->endOfDay();

        echo 'Generating '.$start->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/radiologi/histori-pemeriksaan-pasien-harian';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;
       
        $data = app('App\Http\Controllers\Radiology\Laporan\ReadHistoriHarianController')->get($start,$end);

        $data['tanggal'] = $start->copy()->format('d F Y');

        $filename = 'Histori Pemeriksaan Pasien Harian - '.$start->copy()->format('Y-m-d');
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$timestamp_now.$format;


        $xls = (new HistoriPemeriksaanPasienHarian($data))->store($filename_stored);
        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'radiologi-histori-pemeriksaan-pasien-harian';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
