<?php

namespace App\Console\Commands\LabPK\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use App\Exports\LabPK\LaporanJumlahPenderitaExcel;

class LaporanJumlahPenderitaGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labpk:laporan-jumlah-penderita {date=0} {jenis_laporan=0} {date_end=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Jumlah Penderita Bulanan Format : YYYY-MM (2020-04)';

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
        $date_end = $arguments['date_end'] ?? null;
        $jenis_laporan = $arguments['jenis_laporan'];

        if($date != 0 ){
            if($jenis_laporan == 'tahunan') {
                $start = Carbon::parse($date.'-01')->startOfYear();
                $end = Carbon::parse($date.'-12')->endOfYear();
            } elseif($jenis_laporan == 'bulanan') {
                $start = Carbon::parse($date)->startOfMonth();
                $end = $start->copy()->endOfMonth();
            } elseif ($jenis_laporan == 'rentang-tanggal') {
                $start = Carbon::parse($date);
                $end = Carbon::parse($date_end);
            };
        } else {
            $start = Carbon::now()->subMonth()->startOfMonth();
            $end = $start->copy()->endOfMonth();
        }

        echo 'Generating '.$start->format('d-m-Y')." - ".$end->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/labpk/laporan-jumlah-penderita';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;

        $data['data'] = app('App\Http\Controllers\LabPK\Laporan\ReadLaporanJumlahPenderitaController')->get($start,$end);

        $keterangan_waktu = $jenis_laporan == 'tahunan' ? 'Tahun ' . $date : ( $jenis_laporan == 'bulanan' ? 'Bulan ' . indonesian_date($end->copy(),'F Y') : ( $jenis_laporan == 'rentang-tanggal' ? 'Tanggal : ' . indonesian_date($start->copy(),'d F Y') . ' - ' . indonesian_date($end->copy(),'d F Y')  : ''));
        $data['keterangan_waktu'] = $keterangan_waktu;
        $data['bulan'] = indonesian_date($end->copy(),'F Y');


        $filename = 'Laporan Jumlah Penderita - ' .( $jenis_laporan == 'tahunan' ? $date : ($jenis_laporan == 'bulanan' ? $end->copy()->format('Y-m') : ($jenis_laporan == 'rentang-tanggal' ? $start->format('d-m-y') . ' - ' . $end->format('d-m-y') : '' )))  ;
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$timestamp_now.$format;

        $xls = (new LaporanJumlahPenderitaExcel($data))->store($filename_stored);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'lab-pk-laporan-jumlah-penderita';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;
        
        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
