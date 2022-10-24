<?php

namespace App\Console\Commands\Pasien\Laporan;

use Illuminate\Console\Command;
use Carbon\Carbon;
use MPDF;
use App\Exports\Pasien\SurveilansPTM;
use File;

class GenerateSurveilansPTM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasien:laporan-generate-surveilans-ptm {type} {start_date} {end_date} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Laporan Surveilans PTM';

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
        $type = $arguments['type'];
        $start_date = $arguments['start_date'];
        $end_date = $arguments['end_date'];
        if($type == 'rawat-inap') $type = 1;
        else $type = 2;

        $start = Carbon::createFromFormat('d-m-Y',$start_date)->startOfDay();
        $end = Carbon::createFromFormat('d-m-Y',$end_date)->endOfDay();

        $start_format_view = $start->format('d M y');
        $end_format_view = $end->format('d M y');
        $data['start'] = $start_format_view;
        $data['end'] = $end_format_view;

        if ($type == 1) {
            $data['surveilans_type'] = "RAWAT INAP";
            $slug = 'RawatInap';
        } else {
            $data['surveilans_type'] = "RAWAT JALAN";
            $slug = 'RawatJalan';
        }

        $filename = 'LaporanSurveilansPTM_'.$slug.'_'.$start_date.'_'.$end_date.'.xlsx';
        $path = public_path().'/downloads/laporan/pasien/pasien-surveilans-ptm';
        $path_download = url('/').'/downloads/laporan/pasien/pasien-surveilans-ptm';
        $check_file = file_exists($path.'/'.$filename);

        if ($check_file) {
            echo 'Exist';
        } else {

            $items = app('App\Http\Controllers\Pasien\Laporan\LaporanSurveilansPTM')->get($start,$end,$type);
            $data['data'] = $items;
            $path = public_path().'/downloads/laporan/pasien-surveilans-ptm';

            $xls = (new SurveilansPTM($data))->store($filename);

            //move file
            File::move(storage_path('app/'.$filename), $path.'/'.$filename);

        }

        //echo $path.'/'.$filename;
    }
}
