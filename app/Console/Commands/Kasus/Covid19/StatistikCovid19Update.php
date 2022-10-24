<?php

namespace App\Console\Commands\Kasus\Covid19;

use App\Models\Hospital\MasterStatusPulang;
use App\Models\Keuangan\TarifMaster;
use Illuminate\Console\Command;
use App\Models\Kasus\Covid19Status;
use App\Models\Kasus\Covid19Statistik;
use App\Models\Kasus\Kasus;
use App\Models\LabPK\Transaksi as TransaksiLabPK;
use Carbon\Carbon;
use DB;

class StatistikCovid19Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:covid19-statistik-update {start_date=now}';

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
        $start_date = $arguments['start_date'];

        if ($start_date == 'now') $start = Carbon::today();
        else $start = Carbon::createFromFormat('d-m-Y', $start_date)->startOfDay();

        $start_temp = $start->copy()->startOfDay();
        $end = $start_temp->copy()->endOfDay();
        $tanggal = $start_temp->format('Y-m-d');
        $this->getData('hari', $start_temp, $end, $tanggal);

        $start_temp = $start->copy()->startOfMonth();
        $end = $start_temp->copy()->endOfMonth();
        $tanggal = $start_temp->format('Y-m-d');
        $this->getData('bulan', $start_temp, $end, $tanggal);

        $start_temp = Carbon::minValue();
        $end = Carbon::maxValue();
        $tanggal = $start_temp->format('Y-m-d');
        $this->getData('all', $start_temp, $end, $tanggal);

        $this->dalamPerawatanKonfirmasi();
        $this->dalamPerawatanDiscarded();
        $this->dalamPerawatanSuspek();
        $this->dalamPerawatanKontakErat();
        $this->dalamPerawatanPelakuPerjalanan();
        $this->dalamPerawatanProbable();
    }

    private function getData($type, $start, $end, $tanggal)
    {
        $this->diperiksa($type, $start, $end, $tanggal);
        $this->dirawat($type, $start, $end, $tanggal);
        $this->isolasiMandiri($type, $start, $end, $tanggal);
        $this->tesSwab($type, $start, $end, $tanggal);
        $this->dalamPerawatan($type, $start, $end, $tanggal);
        $this->krsMeninggal($type, $start, $end, $tanggal);
        $this->krsSembuh($type, $start, $end, $tanggal);


        $this->konfirmasi($type, $start, $end, $tanggal);
        $this->discarded($type, $start, $end, $tanggal);
        $this->suspek($type, $start, $end, $tanggal);
        $this->kontakErat($type, $start, $end, $tanggal);
        $this->pelakuPerjalanan($type, $start, $end, $tanggal);
        $this->probable($type, $start, $end, $tanggal);

        $this->krsStatus($type, $start, $end, $tanggal);
        $this->krsMeninggalStatus($type, $start, $end, $tanggal);
    }

    private function diperiksa($jenis_durasi, $start, $end, $tanggal)
    {
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid() . "
            )table1
        WHERE covid_status IS NOT NULL
        AND created_at <= '" . $end->toDateTimeString() . "'
        AND created_at >= '" . $start->toDateTimeString() . "'
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('diperiksa', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function dirawat($jenis_durasi, $start, $end, $tanggal)
    {
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid() . "
            )table1
        WHERE covid_status IS NOT NULL
        AND created_at <= '" . $end->toDateTimeString() . "'
        AND created_at >= '" . $start->toDateTimeString() . "'
        AND ( 
                lama_perawatan > 1   
                OR tipe_ri = 1
                OR lama_perawatan IS NULL
            ) 
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('dirawat', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function isolasiMandiri($jenis_durasi, $start, $end, $tanggal)
    {
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid() . "
            )table1
        WHERE covid_status IS NOT NULL
        AND created_at <= '" . $end->toDateTimeString() . "'
        AND created_at >= '" . $start->toDateTimeString() . "'
        AND krs_at IS NOT NULL
        AND lama_perawatan < 1
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('isolasi-mandiri', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function konfirmasi($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'konfirmasi');
        $this->createStatistik('konfirmasi', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function discarded($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'discarded');
        $this->createStatistik('discarded', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function tesSwab($jenis_durasi, $start, $end, $tanggal)
    {
        $tarif_swab = TarifMaster::where('slug', 'swab-covid')->first();
        if (!empty($tarif_swab)) {
            $tarif_swab = $tarif_swab->id;
            if ($jenis_durasi != 'all') {
                $query = "
                SELECT COUNT(1) AS total FROM (
                    SELECT kasus_id AS total FROM `transaksi` t, `transaksi_detail` td
                    WHERE td.`transaksi_id` = t.`id`
                    AND td.`tarif_id` = '" . $tarif_swab . "'
                    AND t.created_at <= '" . $end->toDateTimeString() . "'
                    AND t.created_at >= '" . $start->toDateTimeString() . "'
                    AND t.deleted_at IS NULL
                    GROUP BY t.`kasus_id`
                )table1
                ";
                $data = DB::connection('lab_pk')->select($query);
                $value = $data[0]->total;
            } else {
                $query = "
                SELECT COUNT(1) AS total FROM (
                    SELECT kasus_id AS total FROM `transaksi` t, `transaksi_detail` td
                    WHERE td.`transaksi_id` = t.`id`
                    AND td.`tarif_id` = '" . $tarif_swab . "'
                    AND t.deleted_at IS NULL
                    GROUP BY t.`kasus_id`
                )table1
                ";
                $data = DB::connection('lab_pk')->select($query);
                $value = $data[0]->total;
            }
            $this->createStatistik('tes-swab', $jenis_durasi, $start, $end, $tanggal, $value);
        }
    }

    private function dalamPerawatan($jenis_durasi, $start, $end, $tanggal)
    {
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid() . "
            )table1
        WHERE covid_status IS NOT NULL
        AND created_at <= '" . $end->toDateTimeString() . "'
        AND created_at >= '" . $start->toDateTimeString() . "'
        AND krs_at IS NULL
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('dalam-perawatan', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function krsMeninggal($jenis_durasi, $start, $end, $tanggal)
    {
        $status =  ["'konfirmasi'", "'kontak erat'", "'suspek'", "'pelaku perjalanan'", "'probable'", "'kematian'"];
        $meninggal = MasterStatusPulang::where('slug', 'meninggal')->first()->id;
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid($status) . "
            )table1
        WHERE covid_status IS NOT NULL
        AND krs_at <= '" . $end->toDateTimeString() . "'
        AND krs_at >= '" . $start->toDateTimeString() . "'
        AND krs_at IS NOT NULL
        AND krs_status = ".$meninggal."
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('krs-meninggal', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function krsSembuh($jenis_durasi, $start, $end, $tanggal)
    {
        $status =  ["'konfirmasi'", "'kontak erat'", "'suspek'", "'pelaku perjalanan'", "'probable'"];
        $meninggal = MasterStatusPulang::where('slug', 'meninggal')->first()->id;
        $query = "
        SELECT COUNT(1) AS total
        FROM
            (
                " . $this->getQueryKasusJoinCovid($status) . "
            )table1
        WHERE covid_status IS NOT NULL
        AND krs_at <= '" . $end->toDateTimeString() . "'
        AND krs_at >= '" . $start->toDateTimeString() . "'
        AND krs_at IS NOT NULL
        AND krs_status != ".$meninggal."
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;

        $this->createStatistik('krs-sembuh', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function suspek($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'suspek');

        $this->createStatistik('suspek', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function kontakErat($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'kontak erat');

        $this->createStatistik('kontak-erat', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function pelakuPerjalanan($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'pelaku perjalanan');

        $this->createStatistik('pelaku-perjalanan', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function probable($jenis_durasi, $start, $end, $tanggal)
    {
        $value = $this->getQueryLastStatusCovid($start, $end, 'probable');

        $this->createStatistik('probable', $jenis_durasi, $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanKonfirmasi()
    {
        $value = $this->getQueryDalamPerawatan('konfirmasi');
        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');


        $this->createStatistik('dalam-perawatan-konfirmasi', 'current', $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanDiscarded()
    {
        $value = $this->getQueryDalamPerawatan('discarded');
        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');

        $this->createStatistik('dalam-perawatan-discarded', 'current', $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanSuspek()
    {
        $value = $this->getQueryDalamPerawatan('suspek');

        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');

        $this->createStatistik('dalam-perawatan-suspek', 'current', $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanKontakErat()
    {
        $value = $this->getQueryDalamPerawatan('kontak erat');

        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');

        $this->createStatistik('dalam-perawatan-kontak-erat', 'current', $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanPelakuPerjalanan()
    {
        $value = $this->getQueryDalamPerawatan('pelaku perjalanan');

        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');

        $this->createStatistik('dalam-perawatan-pelaku-perjalanan', 'current', $start, $end, $tanggal, $value);
    }

    private function dalamPerawatanProbable()
    {
        $value = $this->getQueryDalamPerawatan('probable');

        $start = Carbon::now();
        $end = Carbon::now();
        $tanggal = Carbon::now()->format('Y-m-d');

        $this->createStatistik('dalam-perawatan-probable', 'current', $start, $end, $tanggal, $value);
    }



    private function krsStatus($jenis_durasi, $start, $end, $tanggal)
    {
        $statuses = ['konfirmasi', 'kontak erat', 'suspek', 'pelaku perjalanan', 'probable', 'kematian'];
        foreach ($statuses as $status) {
            $value = $this->getQueryLastStatusCovidKrs($start, $end, $status);
            $status = str_replace(' ', '-', $status);
            if ($status == 'kematian') {
                $status = 'meninggal';
            }
            $this->createStatistik('krs-' . $status, $jenis_durasi, $start, $end, $tanggal, $value);
        }
    }



    private function krsMeninggalStatus($jenis_durasi, $start, $end, $tanggal)
    {
        $statuses = ['konfirmasi', 'kontak erat', 'suspek', 'pelaku perjalanan', 'probable'];
        foreach ($statuses as $status) {
            $value = $this->getQueryLastStatusCovidKrsMeninggal($start, $end, $status);
            $status = str_replace(' ', '-', $status);
            $this->createStatistik('krs-meninggal-' . $status, $jenis_durasi, $start, $end, $tanggal, $value);
        }
    }



    public function createStatistik($jenis_statistik, $jenis_durasi, $start, $end, $tanggal, $value)
    {
        $stat = Covid19Statistik::where('jenis_statistik', $jenis_statistik)->where('jenis_durasi', $jenis_durasi)->where('tanggal', $tanggal)->first();
        if (!empty($stat)) $stat->delete();

        $stat = new Covid19Statistik;
        $stat->jenis_statistik = $jenis_statistik;
        $stat->jenis_durasi = $jenis_durasi;
        $stat->start_date = $start;
        $stat->end_date = $end;
        $stat->tanggal = $tanggal;
        $stat->value = $value ?? 0;
        $stat->save();
    }

    private function getQueryLastStatusCovid($start, $end, $status)
    {
        $query = "
                SELECT IFNULL(count(1),0) as total
                FROM 
                    kasus k,
                    covid19_status c,
                    (
                        SELECT kasus_id, id FROM `covid19_status` WHERE 
                        id IN (select MAX(cs.id) from covid19_status as cs join kasus as k on k.id = cs.kasus_id group by k.id)
                    ) table1
                WHERE 
                    k.`id` = table1.kasus_id
                    AND c.`id` = table1.id
                    AND k.created_at <= '" . $end->toDateTimeString() . "'
                    AND k.created_at >= '" . $start->toDateTimeString() . "'
                    AND c.status = '" . $status . "'
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;
        return $value;
    }

    private function getQueryLastStatusCovidKrs($start, $end, $status)
    {
        $meninggal = MasterStatusPulang::where('slug', 'meninggal')->first()->id;
        $query = "
                SELECT IFNULL(count(1),0) as total
                FROM 
                    kasus k,
                    covid19_status c,
                    (
                        SELECT kasus_id, id FROM `covid19_status` WHERE 
                        id IN (select MAX(cs.id) from covid19_status as cs join kasus as k on k.id = cs.kasus_id group by k.id)
                    ) table1
                WHERE 
                    k.`id` = table1.kasus_id
                    AND c.`id` = table1.id
                    AND k.krs_at <= '" . $end->toDateTimeString() . "'
                    AND k.krs_at >= '" . $start->toDateTimeString() . "'
                    AND c.status = '" . $status . "'
                    AND krs_status != ".$meninggal."
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;
        return $value;
    }

    private function getQueryLastStatusCovidKrsMeninggal($start, $end, $status)
    {
        $meninggal = MasterStatusPulang::where('slug', 'meninggal')->first()->id;
        $query = "
                SELECT IFNULL(count(1),0) as total
                FROM 
                    kasus k,
                    covid19_status c,
                    (
                        SELECT kasus_id, id FROM `covid19_status` WHERE 
                        id IN (select MAX(cs.id) from covid19_status as cs join kasus as k on k.id = cs.kasus_id group by k.id)
                    ) table1
                WHERE 
                    k.`id` = table1.kasus_id
                    AND c.`id` = table1.id
                    AND k.krs_at <= '" . $end->toDateTimeString() . "'
                    AND k.krs_at >= '" . $start->toDateTimeString() . "'
                    AND c.status = '" . $status . "'
                    AND krs_status = ".$meninggal."
        ";
        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;
        return $value;
    }

    private function getQueryDalamPerawatan($status)
    {
        $query = "
                SELECT IFNULL(count(1),0) as total
                FROM 
                    kasus k,
                    covid19_status c,
                    (
                        SELECT kasus_id, id FROM `covid19_status` WHERE 
                        id IN (select MAX(cs.id) from covid19_status as cs join kasus as k on k.id = cs.kasus_id group by k.id)
                    ) table1
                WHERE 
                    k.`id` = table1.kasus_id
                    AND c.`id` = table1.id
                    AND k.krs_at IS NULL
                    AND k.mrs_at IS NOT NULL
                    AND k.tipe_rj = 0
                    AND ( 
                        k.lama_perawatan > 1   
                        OR k.lama_perawatan IS NULL
                        OR k.tipe_ri = 1
                    ) 
                    AND c.status = '" . $status . "'
        ";

        $data = DB::connection('kasus')->select($query);
        $value = $data[0]->total;
        return $value;
    }


    private function getQueryKasusJoinCovid($status = 0)
    {
        if ($status == 0) $status = ["'konfirmasi'", "'discarded'", "'kontak erat'", "'suspek'", "'pelaku perjalanan'"];
        $query = "SELECT kasus.*, table2.status AS covid_status FROM kasus
        LEFT JOIN
        (
            SELECT k.`id`, c.`status`
            FROM 
                kasus k,
                covid19_status c,
                (
                    SELECT kasus_id ,MAX(id) id FROM `covid19_status` 
                    WHERE status IN (" . implode(',', $status) . ") 
                    GROUP BY kasus_id
                ) table1
            WHERE 
                k.`id` = table1.kasus_id
                AND c.`id` = table1.id
        ) table2
        ON kasus.id = table2.id";
        return $query;
    }
}
