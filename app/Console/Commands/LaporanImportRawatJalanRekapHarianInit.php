<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;
use App\Models\RawatJalan\LaporanRekapHarian;
use DB;

class LaporanImportRawatJalanRekapHarianInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatjalan:importlaporanrekapharianinit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menjalankan import rekap harian Init';

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
        $transaksi_start = Transaksi::orderBy('created_at', 'asc')->first();
        $transaksi_end = Transaksi::orderBy('created_at', 'desc')->first();
        $start = Carbon::parse($transaksi_start->created_at)->startOfDay();
        $end = Carbon::parse($transaksi_end->created_at)->startOfDay();

        while ($start < $end) {
            $today = $start->copy()->startOfDay();
            $endOfDay = $start->copy()->endOfDay();
            echo 'waktutunggu-'.$start->format('d/m').'        ';
            $transaksi = Transaksi::whereBetween('ordered_at', [$today, $endOfDay])->first();
            if (!empty($transaksi->id)) {
                echo 'querying-'.$start->format('d/m').'    ';
                $query = '
                SELECT AVG(selisih) AS average, COUNT(1) AS total, poliklinik_id
                    FROM (
                        SELECT 
                            transaksi.id, transaksi.ordered_at, transaksi.waktu_pemeriksaan, transaksi.`poliklinik_id`,
                            IF( 
                                CAST(transaksi.`ordered_at` AS TIME) < CAST("08:00:00" AS TIME), 
                                IF(
                                    TIMESTAMPDIFF(MINUTE, CAST("08:00:00" AS TIME), CAST(transaksi.waktu_pemeriksaan AS TIME)) < 0,
                                    0,
                                    TIMESTAMPDIFF(MINUTE, CAST("08:00:00" AS TIME), CAST(transaksi.waktu_pemeriksaan AS TIME))
                                ), 
                                TIMESTAMPDIFF(MINUTE, transaksi.`ordered_at`, transaksi.waktu_pemeriksaan) 
                            ) AS selisih 
                        FROM 
                            `'.config('app.db_name').'_rawat_jalan`.`transaksi`
                        WHERE 
                            transaksi.waktu_pemeriksaan IS NOT NULL
                            AND transaksi.ordered_at >= "' . $today . '"
                            AND transaksi.ordered_at <= "' . $endOfDay . '"
    
    
                    ) transaksi
                    GROUP BY poliklinik_id
                ';
                $data = DB::connection('rawatjalan')->select($query);
                $array_data = [];

                foreach ($data as $item) {
                    $temp = new LaporanRekapHarian;
                    $temp->poliklinik_id = $item->poliklinik_id;
                    $temp->type = 'waktu-tunggu';
                    $temp->data = json_encode($item);
                    $temp->tanggal_rekap = $today;
                    array_push($array_data, $temp->toArray());
                }

                LaporanRekapHarian::insert($array_data);
            }

            echo 'jambuka-'.$start->format('d/m').'        ';
            $poliklinik = Poliklinik::all();
            $array_data = [];
            foreach ($poliklinik as $poli) {
                $transaksi_first = Transaksi::where('poliklinik_id', $poli->id)->whereBetween('waktu_pemeriksaan', [$today, $endOfDay])->orderBy('waktu_pemeriksaan', 'asc')->first();
                if (!empty($transaksi_first)) {
                    $waktu_pemeriksaan = Carbon::parse($transaksi_first->waktu_pemeriksaan);
                    $jam_buka = $today->copy()->startOfDay()->addHours(8);

                    $data = new \stdClass;
                    $data->waktu_buka = $transaksi_first->waktu_pemeriksaan;
                    $data->selisih_waktu = $jam_buka->diffInMinutes($waktu_pemeriksaan);

                    $temp = new LaporanRekapHarian;
                    $temp->poliklinik_id = $poli->id;
                    $temp->type = 'jam-buka';
                    $temp->data = json_encode($data);
                    $temp->tanggal_rekap = $today;
                    array_push($array_data, $temp->toArray());
                }
            }
            LaporanRekapHarian::insert($array_data);


            echo 'done-'.$start->format('d/m')."\n";
            $start->addDay();
        }
    }
}
