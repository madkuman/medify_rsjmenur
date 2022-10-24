<?php

namespace App\Console\Commands\Kasus\Update;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Covid19Status;
use Carbon\Carbon;

class Covid19StatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:update-covid19-status {start_id=0} {end_id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        if($arguments['start_id'] != 0)
            $kasus_id_start = $arguments['start_id'];
        else
            $kasus_id_start = Kasus::first()->id;
        
        if($arguments['end_id'] != 0)
            $kasus_id_end = $arguments['end_id'];
        else
            $kasus_id_end = Kasus::orderBy('id','desc')->first()->id;

        echo "updating tipe kasus start from :".$kasus_id_start." -- ".$kasus_id_end." \n";

        $start = $kasus_id_start;
        $end = $kasus_id_end;
        $chunk = 10000;

        while($start<=$kasus_id_end)
        {

            $kasus_ids = [];
            if($start + $chunk < $kasus_id_end) $end = $start+$chunk;
            else $end = $kasus_id_end;

            echo "get kasus start from :".$start." -- ".$end;
            $kasus_ids = AlatBantu::where('type','covid')->whereBetween('kasus_id',[$start,$end])->orderBy('kasus_id')->pluck('kasus_id')->toArray();
            $kasus_ids = array_unique($kasus_ids);

            echo " --- found :".count($kasus_ids);

            foreach($kasus_ids as $kasus_id)
            {
                $this->updateCovid19Status($kasus_id);
            }
            echo " -- DONE ==============\n";
            $start = $end+1;
        }
    }

    public function updateCovid19Status($kasus_id)
    {
        $asesmen = AlatBantu::where('type','covid')->where('kasus_id',$kasus_id)->orderBy('id','asc')->get();

        // $status = Covid19Status::where('kasus_id',$kasus_id)->get();
        // if(count($status) > 0) return 0;
        $status_baru = ['suspek', 'kontak erat', 'konfirmasi', 'probable', 'pelaku perjalanan', 'discarded', 'kematian'];
        $covid_status = Covid19Status::where('kasus_id',$kasus_id)->latest()->first();
        if (in_array($covid_status->status ?? null, $status_baru)) {
            return 0;
        }

        foreach ($asesmen as $key => $item) {
            $status = null;
            if (empty($item->presentase)) continue;

            if ($item->presentase == 1) $status = 'suspek';
            elseif ($item->presentase == 2) $status = 'kontak erat';
            elseif ($item->presentase == 3) $status = 'kontak erat';
            elseif ($item->presentase == 4) $status = 'konfirmasi';
            elseif ($item->presentase == 5) $status = 'probable';
            elseif ($item->presentase == 6) $status = 'pelaku perjalanan';
            elseif ($item->presentase == 0) $status = 'discarded';

            if(!is_null($status))
            {
                $covid = new Covid19Status;
                $covid->status = $status;
                $covid->kasus_id = $kasus_id;
                $covid->created_by = $item->created_by;
                $covid->updated_from = 'form';
                $covid->keterangan = 'Berdasarkan Skrining Pasien COVID19';
                $covid->save();
            }
        }
        $status = Covid19Status::where('kasus_id', $kasus_id)->whereNotIn('status', $status_baru)->where('updated_from', 'form')->delete();
    }
}
