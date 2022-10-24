<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\ICD9;

class SyncICD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'icd:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nyamain CODE ICD9 dan ICD10 dari INACBG';

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
        $icd_9 = ICD9::all();
        echo "DELETING ICD9\n";
        foreach($icd_9 as $item)
        {
            $query = "select 1 from mrconso where code = '".$item->code_icd."'and cbg_use_ind = '1'";
            $search = DB::connection('kasus')->select($query);
            if(empty($search))
            {
                echo $item->code_icd."\n";
                $item->delete();
            }
        }
        echo "DONE\n";
        echo "========================================\n";

        $icd_10 = ICD10::all();
        echo "DELETING ICD10\n";
        foreach($icd_10 as $item)
        {
            $query = "select 1 from mrconso where code = '".$item->code_icd."'and cbg_use_ind = '1'";
            $search = DB::connection('kasus')->select($query);
            if(empty($search))
            {
                echo $item->code_icd."\n";
                $item->delete();
            }
        }
        echo "DONE\n";

        echo "BEGIN CHECK MEDIFY ICD10\n";
        $query = "select code, str from mrconso where id > 4600 and cbg_use_ind = '1'";
        $icd = DB::connection('kasus')->select($query);
        $count = 0;
        foreach($icd as $item)
        {
            $count++;
            if($count%500 == 0)
            {
                //echo 'Count : '.$count."\n";
            }

            $icd_10_medify = ICD10::where('code_icd',$item->code)->first();
            if(empty($icd_10_medify->id))
            {

                echo $item->code."\n";
                $new_icd = new ICD10;
                $new_icd->code_icd = $item->code;
                $new_icd->long_desc = $item->str;
                $new_icd->save();
            }
        }
        echo "DONE\n";
    }
}
