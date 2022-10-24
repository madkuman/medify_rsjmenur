<?php

namespace App\Console\Commands\BPJS\Aplicare;

use App\Models\RawatInap\Ruangan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:aplicare-reset {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Applicare - Reset Ruangan';

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
        if (!$this->option('force')) {
            $confirm = $this->confirm('sebaiknya tidak dijalankan pada waktu diatas menit 45, dan dibawah menit 15. jalankan?', false);
            if (!$confirm) {
                $this->info('Byee...');
                return;
            }
        }
        $format_bar = 'Progress: [%bar%] %percent%% ';

        $referensi_ruang = [];
        $offset = 0;
        $limit = 100;
        do {
            $referensi_ruang_json = app(\App\Http\Controllers\ThirdParty\BPJS\Applicare\ReadController::class)->getData([
                'start' => $offset,
                'limit' => $limit,
            ]);
            $offset += $limit;
            $referensi_ruang_now = json_decode($referensi_ruang_json)->response->list;
            $referensi_ruang = array_merge($referensi_ruang, $referensi_ruang_now);
        } while (count($referensi_ruang_now) == $limit);

        $progressBar = $this->output->createProgressBar(count($referensi_ruang));
        $this->info('-- deleting kamar');
        $progressBar->setFormat($format_bar);

        foreach ($referensi_ruang as $ruang) {

            $param = [
                'kodekelas' => $ruang->kodekelas,
                'koderuang' => $ruang->koderuang,
            ];
            app(\App\Http\Controllers\BPJS\API\Applicare\DeleteController::class)->deleteRuanganBatch($param);

            $progressBar->advance();
        }

        $progressBar->finish();

        $data_ruangan = Ruangan::with('bangsal:id,nama')->whereHas('bangsal', function ($query) {
            $query->select(DB::raw(1))
                ->whereNull('deleted_at');
        })->get();

        foreach ($data_ruangan as $ruangan) {
            echo "\n";
            if (!empty($ruangan->kelas_applicare)) {
                echo "creating ";
                $param = [];
                $param['kelas'] = $ruangan->kelas_applicare;
				$param['kode_ruang'] = $ruangan->kode_applicare;
				$param['nama_ruang'] = $ruangan->nama_applicare;
				$param['tersedia'] = empty($ruangan->count_empty) ? 0 : $ruangan->count_empty;
				$param['kapasitas'] = $ruangan->count_bed;
                echo json_encode($param);
				$res_applicare = app(\App\Http\Controllers\BPJS\API\Applicare\CreateController::class)->createRuangan($param);
            } else {
                echo "ruangan $ruangan->id ".$ruangan->bangsal->nama." $ruangan->nama belum setting aplicare";
            }
        }
        $this->info("\n-- done");
    }
}
