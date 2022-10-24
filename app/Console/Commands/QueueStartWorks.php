<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class QueueStartWorks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:start-work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue start work';

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
        Artisan::call('queue:work', ['--once' => 'default']);
    }
}
