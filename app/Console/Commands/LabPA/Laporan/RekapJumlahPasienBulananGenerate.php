<?php

namespace App\Console\Commands\LabPA\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Exports\LabPA\RekapJumlahPasienBulanan;
use File;

class RekapJumlahPasienBulananGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labpa:laporan-rekap-jumlah-pasien-bulanan {date=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Lab PA Diagnosa Bulanan Format : YYYY-MM (2020-04)';

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

        if($date == 0) $start = Carbon::now()->subMonth()->startOfMonth();
        else $start = Carbon::parse($date)->startOfMonth(); 

        $end = $start->copy()->endOfMonth();

        echo 'Generating '.$start->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/labpa/rekap-jumlah-pasien-bulanan';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;
       
        $data = app('App\Http\Controllers\LabPA\Laporan\ReadRekapJumlahPasienBulananController')->get($start,$end);

        $data['bulan'] = $start->copy()->format('F Y');


        $filename = 'Rekap Jumlah Pasien Bulanan - '.$start->copy()->format('Y-m-d');
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$timestamp_now.$format;

        $xls = (new RekapJumlahPasienBulanan($data))->store($filename_stored);
        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'lab-pa-rekap-jumlah-pasien-bulanan';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
