<?php

namespace App\Console\Commands\Zipper;

use App\Jobs\QueueArtisan;
use App\Models\Hospital\DataArtisanCall;
use App\Models\Hospital\Zipper;
use Illuminate\Console\Command;

class Invoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zipper:invoke {zipper_id} {--limit=500} {--runonce}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'trigger zipper command';

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
        ini_set('max_execution_time', 50000);
        ini_set('memory_limit', '2048M');
        $zipper_id = $this->argument('zipper_id');
        $limit = $this->option('limit');
        $runonce = $this->option('runonce');

        $zipper = Zipper::find($zipper_id);
        if ($zipper == null) {
            echo 'zipper tidak ditemukan';
            return 0;
        }

        $list_function = [
            'farmasi:eresep-kolektif' => [
                'class' => \App\Http\Controllers\Farmasi\Transaksi\CommandGenerateFileController::class,
                'function' => 'invokeZipper',
            ],
        ];
        $selected_function = $list_function[$zipper->slug] ?? null;
        if ($selected_function == null) {
            echo 'zipper tidak dapat diproses';
            return 0;
        }
        $function = $selected_function['function'];
        try {
            $param = [
                'limit' => $limit,
            ];
            $data = app($selected_function['class'])->$function($zipper, $param);
            if (!$runonce && ($data['continue'] ?? false) && $zipper->status != -1) {
                $data = [
                    'param_request' => json_encode(['zipper_id' => $zipper->id]),
                    'command_artisan' => 'zipper:invoke',
                    'created_by' => 1,
                    'created_at' => now(),
                ];
                $data_artisan_call_id = DataArtisanCall::insertGetId($data);
            }
        } catch (\Exception $e) {
            dd($e);
        }

        echo "done";
        return 1;
    }
}
