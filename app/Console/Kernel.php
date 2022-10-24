<?php

namespace App\Console;

use App\Console\Commands\UpdateTaskJKNId;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use Carbon\Carbon;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        Commands\TambahTagihanKamar::class,
        Commands\BarangFarmasi::class,
        Commands\FarmasiBarangInit::class,
        Commands\RawatInap\Statistik\DataHarian::class,
        Commands\MappingCaraPulangStatusPulang::class,
        Commands\ApplicareUpdate::class,
        Commands\AutoSepPendaftaranOnline::class,
        Commands\PesanMakanan::class,
        Commands\TindakanSubscribe::class,
        Commands\LaporanImportRawatJalan::class,
        Commands\LaporanImportIGD::class,
        Commands\LaporanImportFarmasi::class,
        Commands\CheckoutRajal::class,
        Commands\CreateNomorPJK::class,
        Commands\LaporanImportRawatJalanRekapHarian::class,
        Commands\SyncICD::class,
        Commands\QueueStartWorks::class,
        Commands\Dev\SqlFileGenerator::class,
        Commands\Kasus\GeneratePenagihanFile::class,
        Commands\Radiologi\Laporan\RekapPemeriksaanPasienBulananGenerate::class,
        Commands\Radiologi\Laporan\RekapPemeriksaanPasienHarianGenerate::class,
        Commands\DataGenerator\FarmasiStokGenerator::class,
        Commands\Farmasi\Update\RecalculateStok::class,
        Commands\ThirdParty\SIRSV3\LaporanCovid19Update::class,
        Commands\UpdateTaskJKNId::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('tagihan:kamar')->dailyAt('13:00');
        // $schedule->command('farmasi:barang')->dailyAt('07:00');
        $schedule->command('kasus:notifgizi')->dailyAt('07:00');
        $schedule->command('kasus:tindakan-subscribe')->dailyAt("00:01");
        $schedule->command('rawatjalan:importlaporan')->twiceDaily(9, 11); //diimpor dua kali bee dia narik data tiap mau pulang
        $schedule->command('rawatjalan:importlaporan')->twiceDaily(13, 15); //diimpor dua kali bee dia narik data tiap mau pulang
        $schedule->command('rawatjalan:importlaporan')->daily(); //diimpor tiap malam juga
        $schedule->command('rawatjalan:importlaporanrekapharian')->dailyAt('22:00'); //diimpor dua kali bee dia narik data tiap mau pulang
        
        $schedule->command('bpjs:applicare-update')->hourly();
        $schedule->command('bpjs:auto-sep-online')->dailyAt("00:10");

        $schedule->command('rawatinap:importlaporan')->twiceDaily(1, 13); //diimpor dua kali bee dia narik data tiap mau pulang
        $schedule->command('farmasi:import-laporan')->daily(); //diimpor tiap malam juga

        $schedule->command('igd:importlaporan')->twiceDaily(9, 11); //diimpor dua kali bee dia narik data tiap mau pulang
        $schedule->command('igd:importlaporan')->twiceDaily(13, 15); //diimpor dua kali bee dia narik data tiap mau pulang
        $schedule->command('igd:importlaporan')->daily(); //diimpor tiap malam juga
        #start queue work
        $schedule->command('queue:start-work')->everyMinute();
        
        $schedule->command('kasus:checkout-rajal')->dailyAt('22:00'); // krs & checkout rawatjalan pembayaran bpjs dan asuransi yang belum tercheckout
        
        $schedule->command('rawatinap:data-harian')->dailyAt('23:59');
        $schedule->command('rawatinap:create-statistik-harian')->dailyAt('23:30');
        $schedule->command('rawatinap:create-statistik-mingguan')->weeklyOn(2, '23:30');
        $schedule->command('rawatinap:create-statistik-bulanan')->monthlyOn(2, '00:00');


        $schedule->command('radiologi:laporan-rekap-pemeriksaan-pasien-bulanan')->monthlyOn(2, '02:45');
        $schedule->command('radiologi:laporan-rekap-pemeriksaan-pasien-harian')->dailyAt('02:00');
        $schedule->command('radiologi:laporan-histori-pemeriksaan-pasien-harian')->dailyAt('02:15');

        $schedule->command('labpa:laporan-rekap-jumlah-pasien-bulanan')->monthlyOn(3, '03:45');
        $schedule->command('labpa:laporan-diagnosa-pasien-bulanan')->monthlyOn(3, '03:45');

        $schedule->command('labpk:laporan-pemeriksaan-laboratorium')->monthlyOn(1, '02:00');
        $schedule->command('labpk:laporan-kunjungan-berdasarkan-gender-dan-usia')->monthlyOn(1, '02:15');
        $schedule->command('labpk:laporan-rekap-jumlah-pasien-bulanan')->monthlyOn(1, '02:30');
        $schedule->command('labpk:laporan-jumlah-penderita')->monthlyOn(1, '02:45');

        $schedule->command('labpk:laporan-data-status-ranap')->monthlyOn(1, '03:00');
        $schedule->command('labpk:laporan-data-status-rajal')->monthlyOn(1, '03:15');
        $schedule->command('labpk:laporan-penerimaan')->monthlyOn(1, '03:30');

        $schedule->command('labpk:laporan-kunjungan-tahunan-per-lokasi')->monthlyOn(1, '03:45');
        $schedule->command('labpk:laporan-kunjungan-tahunan-per-tarif')->monthlyOn(1, '04:00');
        $schedule->command('labpk:laporan-kunjungan-tahunan-per-debitur')->monthlyOn(1, '04:15');


        //$schedule->command('farmasi:stok-log-regenerate')->daily('00:30');
        $schedule->command('farmasi:items-farmasi-update-min-stok')->daily('00:35');
        $schedule->command('farmasi:recalculate-stok')->daily('00:30');

        #THIRDPARTY
        //$schedule->command('third-party-sirs:rekap-pasien-masuk-covid-19-create')->hourly();
        //$schedule->command('third-party-sirs:rekap-pasien-dirawat-dengan-komorbid-update')->hourly();
        //$schedule->command('third-party-sirs:rekap-pasien-dirawat-tanpa-komorbid-update')->hourly();
        //$schedule->command('third-party-sirs:rekap-pasien-keluar-update')->hourly();
        $schedule->command('third-party-sirs:data-tempat-tidur-kirim')->hourly();
        $schedule->command('third-party-sirs:data-tempat-tidur-update')->hourly();
        $schedule->command('third-party-sirs-v3:laporan-covid-19-update')->dailyAt('22:00');

        $schedule->command('thirdparty:jkn-auto-update-task-id-5')->cron('*/5 * * * *');

        #COVID19
        $schedule->command('kasus:covid19-statistik-update')->hourly();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
