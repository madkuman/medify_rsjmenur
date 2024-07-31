<?php

namespace App\Console\Commands;

use App\Models\Hospital\DataArtisanCall;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class QueueArtisanCallCustom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:artisan_call {id=null} {--tries=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Artisan Call Custom by own (aabecede)';

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
        $id = $this->argument('id');
        $tries = $this->option('tries');
        $data = DataArtisanCall::selectRaw('*');
        //get ongoing process
        $ongoing_process = DataArtisanCall::selectRaw('count(1) as counter')->where('status', 2)->first()->counter ?? 0;

        $explode_id = [];
        if(!empty($id)){
            $explode_id = explode(',', $id);

            if($explode_id[0] == 'null'){
                $explode_id = [];
            }
        }
        // dd($explode_id);
        if(count($explode_id) > 0){
            $data = $data->whereIn('id', $explode_id);
        }
        else{
            $data = $data->whereStatus(0)
                    ->where('try_error', '<', 3);
        }

        //max limit yg boleh di run =  max_concurent  - process
        $limit = config('medify.general.data_artisan_call.max_concurent', 5) - $ongoing_process;
        $data->orderBy('id')->limit($limit);
        
        $data = $data->get();

        $plucked_id = $data->pluck('id');
        DataArtisanCall::whereIn('id', $plucked_id)->update([
            'proses_at' => now(),
            'status' => 2, #handle biar gak duplicate run in progres
            'error' => null #remove errornya
        ]);

        // dd($plucked_id, $limit);

        if(count($data) > 0){

            foreach ($data as $key => $value) {
                // $value->proses_at = now();
                // $value->status = 2; #handle biar gak duplicate run in progres
                // $value->error = null; #remove errornya
                // $value->save();
                try {
                    $param = (array)json_decode($value->param_request);
                    $command_artisan = $value->command_artisan;
                    Artisan::call($command_artisan, $param);
                    $value->status = 1;
                    $value->done_at = now();
                } catch (\Throwable $th) {
                    $error = [
                        'message' => $th->getMessage(),
                        'file_name' => $th->getFile(),
                        'line' => $th->getLine(),
                    ];
                    $value->status = -1;
                    $value->try_error++;
                    $value->error = json_encode($error);
                }
                $value->save();
            }
        }
        else{
            $data = DataArtisanCall::whereStatus(-1)
                ->where(function ($query) use ($tries) {
                    if ($tries == 0) {
                        $query->where('max_tries','>',DB::raw('try_error'));
                    } else {
                        $query->where('try_error', '<', $tries);
                    }
                })
                ->orderBy('try_error', 'asc')
                ->limit($limit)
                ->get();
            $plucked_id = $data->pluck('id');
            DataArtisanCall::whereIn('id', $plucked_id)->update([
                'proses_at' => now(),
                'status' => 2, #handle biar gak duplicate run in progres
                'error' => null #remove errornya
            ]);
            foreach ($data as $key => $value) {
                // $value->proses_at = now();
                // $value->status = 2; #handle biar gak duplicate run in progres
                // $value->error = null; #remove errornya
                // $value->save();
                try {
                    $param = (array)json_decode($value->param_request);
                    $param['artisan_call_id'] = $value->id;
                    $command_artisan = $value->command_artisan;
                    Artisan::call($command_artisan, $param);
                    $value->status = 1;
                    $value->done_at = now();
                } catch (\Throwable $th) {
                    $error = [
                        'message' => $th->getMessage(),
                        'file_name' => $th->getFile(),
                        'line' => $th->getLine(),
                    ];
                    $value->status = -1;
                    $value->try_error++;
                    $value->error = json_encode($error);
                }
                $value->updated_by = 1;
                $value->save();
            }
        }

        if(count($data ?? []) == 0){
            echo "NO PROSES\n";
        }

    }
}
