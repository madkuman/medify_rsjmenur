<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ThirdParty\BPJS\JKN\UpdateTaskId;
use App\Models\RawatJalan\Transaksi;

class UpdateTaskJKNId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-task-jkn-id {kodebooking} {taskid} {waktu}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengupdate task id pada JKN Mobile';

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
        //
        $kodebooking = $this->argument('kodebooking');
        $taskid = $this->argument('taskid');
        $waktu = $this->argument('waktu');
        $data = [
            'kodebooking' => $kodebooking,
            'taskid' => $taskid,
            'waktu' => $waktu,
        ];
        $returned = app(\App\Http\Controllers\ThirdParty\BPJS\JKN\Antrean\PostController::class)->updateTaskId($data);
        $returned = json_decode($returned);
        $metadata = isset($returned->metadata) ? $returned->metadata : $returned->metaData;
        if ($metadata->code != "200") {
            $data_log['kodebooking'] = $kodebooking;
            $data_log['response'] = json_encode($returned);

            app(\App\Http\Controllers\ThirdParty\LogErrorJkn\CreateController::class)->create($data_log);
        } else {
            $data_log['kodebooking'] = $kodebooking;
            $data_log['task_id'] = $taskid;
            $data_log['waktu'] = $waktu;
            $data_log['response'] = json_encode($returned);

            app(\App\Http\Controllers\ThirdParty\LogJkn\CreateController::class)->create($data_log);
        }
        $transaksi = Transaksi::find($kodebooking);
        $transaksi->task_id_jkn = $taskid;
        $transaksi->save();
    }
}
