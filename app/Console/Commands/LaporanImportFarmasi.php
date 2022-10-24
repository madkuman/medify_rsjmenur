<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KasusLokasi;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use Auth;
use Carbon\Carbon;
use Bugsnag;

class LaporanImportFarmasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:import-laporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import transaksi, distribusi, penghapusan, pengadaan farmasi';

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
    public function handle(){
        Auth::loginUsingId(1);
        app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->fillTabelLaporanTransaksi();
        app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->fillTabelLaporanDistribusi();
        app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->fillTabelLaporanPenghapusan();
        app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->fillTabelLaporanPengadaan();
    }
}