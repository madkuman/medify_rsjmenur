<?php

namespace App\Console\Commands\Radiologi\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Exports\Radiologi\RekapPemeriksaanPasienBulanan;
use File;

class RekapPemeriksaanPasienBulananGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'radiologi:laporan-rekap-pemeriksaan-pasien-bulanan {date=0} {type=empty}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Radiologi Rekap Bulanan Format : YYYY-MM (2020-04)';

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
        $type = $arguments['type'];

        if($date == 0) $start = Carbon::now()->subMonth()->startOfMonth();
        else $start = Carbon::parse($date); 

        if($type == 'empty') $layanan_array = config('const.layanan-array');
        else $layanan_array[0] = $type;

        echo 'Generating '.$date.' '.$type."\n";

        $end = $start->copy()->endOfMonth();

        $base_path = '/downloads/laporan/radiologi/rekap-pemeriksaan-pasien-bulanan';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;

        foreach($layanan_array as $layanan){
            $data['data'] = app('App\Http\Controllers\Radiology\Laporan\ReadRekapBulananController')->get($start,$end,$layanan);

            $data['bulan'] = $start->copy()->format('F Y');
            $data['layanan'] = config('const.name-'.$layanan);
            $data['total_tanggal'] = $start->copy()->daysInMonth;
            $filename = 'Rekap Pemeriksaan Pasien Bulanan - '.$start->copy()->format('Y-m').' - '.$data['layanan'];
            $timestamp_now = Carbon::now()->timestamp;
            $format = '.xlsx';

            $filename_stored = $filename.'-'.$timestamp_now.$format;

            $xls = (new RekapPemeriksaanPasienBulanan($data))->store($filename_stored);
            File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);
            $laporan_data = [];
            $laporan_data['slug'] = 'radiologi-rekap-pemeriksaan-pasien-bulanan';
            $laporan_data['start_date'] = $start->toDateTimeString();
            $laporan_data['end_date'] = $end->toDateTimeString();
            $laporan_data['file_name'] = $filename;
            $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

            $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

            echo 'done --'.$filename."\n";
        }

        return 1;
    }
}
