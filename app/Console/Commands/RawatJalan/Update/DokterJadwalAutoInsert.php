<?php

namespace App\Console\Commands\RawatJalan\Update;

use Illuminate\Console\Command;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use App\User;

class DokterJadwalAutoInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dokter:jadwal-auto-insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert jadwal dokter, berdasarkan spesialis dan poli';

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
        $dokters = User::whereNotNull('dokter_id')->where('profesi',1)->get();
        $dokter_jadwals = [];
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        foreach($dokters as $dokter)
        {
            $poliklinik = Poliklinik::where('profesi_spesialis_id',$dokter->specialty)->get();
            foreach($poliklinik as $poli)
            {
                foreach($days as $day_index => $day)
                {
                    $jadwal = [];
                    $jadwal['dokter_id'] = $dokter->dokter_id;
                    $jadwal['poliklinik_id'] = $poli->id;
                    $jadwal['hari'] = $day;
                    $jadwal['hari_order'] = $day_index;
                    $jadwal['jam_buka'] = '08:00:00';
                    $jadwal['jam_tutup'] = '15:00:00';
                    $jadwal['nama_dokter'] = $dokter->name;
                    $jadwal['nama_poli'] = $poli->name;
                    $dokter_jadwals[] = $jadwal;
                }
            }
        }

        DokterJadwal::insert($dokter_jadwals);
    }
}
