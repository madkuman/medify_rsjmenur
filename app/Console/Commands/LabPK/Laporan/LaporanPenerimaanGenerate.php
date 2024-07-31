<?php

namespace App\Console\Commands\LabPK\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;
use App\Exports\LabPK\LaporanPenerimaanExcel;

class LaporanPenerimaanGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'labpk:laporan-penerimaan {date=0} {date_end=0} {jenis_laporan=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Penerimaan';

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
        $date_end = $arguments['date_end'];
        $jenis_laporan = $arguments['jenis_laporan'];

        if($jenis_laporan == 'harian')
        {
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date_end)->endOfDay(); 
            if($start->copy()->format('Ym') != $end->copy()->format('Ym'))
            {
                $end = $start->copy()->endOfMonth();
            }
        }
        else if($jenis_laporan == 'bulanan')
        {
            if($date == 0) $start = Carbon::now()->startOfYear();
            else $start = Carbon::parse($date)->startOfYear(); 
    
            if($date == 0) $end = Carbon::now()->subMonth()->endOfMonth();
            else $end = Carbon::parse($date)->endOfMonth();
        }
        else if($jenis_laporan == 'tahunan')
        {
            if($date == 0) $end = Carbon::now()->endOfYear();
            else $end = Carbon::parse($date)->endOfYear(); 
    
            $start = $end->copy()->subYears(4)->startOfYear();
        }

        echo 'Generating '.$jenis_laporan.'-'.$start->format('d-m-Y')." - ".$end->format('d-m-Y')."\n";

        $base_path = '/downloads/laporan/labpk/laporan-penerimaan';
        $path = public_path().$base_path;
        $path_download = url('/').$base_path;
       
        $data['data'] = app('App\Http\Controllers\LabPK\Laporan\ReadLaporanPenerimaanController')->get($start,$end,$jenis_laporan);

        
        $data['start_date'] = $start->copy();
        $data['end_date'] = $end->copy();

        $bulan_list = ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGS','SEP','OKT','NOV','DES'];
        if($jenis_laporan == 'tahunan') 
        {
            $temp_start = $start->copy();
            while($temp_start->lte($end))
            {
                $data['header'][] = 'Th '.$temp_start->copy()->format('Y');
                $temp_start->addYear();
            }
            $date_range_filename = $start->copy()->format('Y').'-'.$end->copy()->format('Y');
        }
        else if($jenis_laporan == 'bulanan') 
        {
            $data['header'] = $bulan_list;
            $date_range_filename = $start->copy()->format('Ym').'-'.$end->copy()->format('Ym');
        }
        else if($jenis_laporan == 'harian') 
        {
            $temp_start = $start->copy();
            while($temp_start->lte($end))
            {
                $bulan_text = $bulan_list[$temp_start->copy()->format('n') - 1];
                $data['header'][] = $temp_start->copy()->format('d').' '.$bulan_text;
                $temp_start->addDay();
            }
            $date_range_filename = $start->copy()->format('Ymd').'-'.$end->copy()->format('Ymd');
        }

        $filename = 'Laporan Penerimaan - '.$date_range_filename;
        $timestamp_now = Carbon::now()->timestamp;
        $format = '.xlsx';

        $filename_stored = $filename.'-'.$jenis_laporan.'-'.$timestamp_now.$format;

        $xls = (new LaporanPenerimaanExcel($data))->store($filename_stored);

        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        File::move(storage_path('app/'.$filename_stored), $path.'/'.$filename_stored);

        $laporan_data = [];
        $laporan_data['slug'] = 'lab-pk-laporan-penerimaan';
        $laporan_data['start_date'] = $start->toDateTimeString();
        $laporan_data['end_date'] = $end->toDateTimeString();
        $laporan_data['file_name'] = $filename;
        $laporan_data['file_path'] = $base_path.'/'.$filename_stored;

        $temp = app('App\Http\Controllers\Hospital\Laporan\CreateController')->create($laporan_data);

        echo 'done --'.$filename."\n";
        return 1;
    }
}
