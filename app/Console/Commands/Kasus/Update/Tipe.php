<?php

namespace App\Console\Commands\Kasus\Update;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;

class Tipe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:update-tipe {start_id=0} {end_id=0} ';

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
        $chunk = 100;

        while($start<$kasus_id_end)
        {
            $kasus_ids = [];
            if($start + $chunk < $kasus_id_end) $end = $start+$chunk;
            else $end = $kasus_id_end;

            echo "get kasus start from :".$start." -- ".$end." \n";
            $kasus_ids = Kasus::whereBetween('id',[$start,$end])->orderBy('id')->pluck('id')->toArray();
            echo "get kasus done \n";

            $lokasi = Lokasi::whereIn('kasus_id',$kasus_ids)->with('lokasi','kasus')->get();
            echo "get lokasi done \n";
            foreach($lokasi as $item)
            {
                $temp_kasus = Kasus::find($item->kasus_id);
                if($item->lokasi->lokasi_departemen_id == 2){
                    $temp_kasus->tipe_rj = 1;
                }
                elseif($item->lokasi->lokasi_departemen_id == 3){
                    $temp_kasus->tipe_ri = 1;
                }
                elseif($item->lokasi->lokasi_departemen_id == 1){
                    $temp_kasus->tipe_igd = 1;
                }
                elseif($item->lokasi->lokasi_departemen_id == 4){
                    $temp_kasus->tipe_mc = 1;
                    
                }
                $temp_kasus->save();
                echo "update kasus ".$item->kasus_id." done \n";
            }

            echo "DONE : ".$start." --- ".$end."================================== \n";
            $start = $end+1;
        }
    }
}
