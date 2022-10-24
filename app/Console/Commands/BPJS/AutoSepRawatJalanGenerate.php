<?php

namespace App\Console\Commands\BPJS;

use Illuminate\Console\Command;

class AutoSepRawatJalanGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:auto-sep-rawat-jalan-generate {pasien_id} {pasien_pembayaran_id} {poliklinik_id} {debug} {index_dokter=0}';

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
        $pasien_id = $arguments['pasien_id'];
        $pasien_pembayaran_id = $arguments['pasien_pembayaran_id'];
        $poliklinik_id = $arguments['poliklinik_id'];
        $index_dokter = $arguments['index_dokter'];
        $debug = $arguments['debug'];

        app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->generate('rawatjalan',$pasien_id,$pasien_pembayaran_id,$poliklinik_id,$index_dokter,$debug);
    }
}
