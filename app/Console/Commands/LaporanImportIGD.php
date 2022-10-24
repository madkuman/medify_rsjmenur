<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\IGD\Transaksi;
use App\Models\IGD\LaporanTransaksi;
use App\Models\IGD\LaporanTransaksiDiagnosis;
use App\Models\Kasus\Diagnosis;
use DB;
use Carbon\Carbon;

class LaporanImportIGD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'igd:importlaporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Laporan Transaksi IGD dari Transaksi';

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
        $today = Carbon::today();
        $max_count = Transaksi::latest('id')->first()->id;
        $last_laporan_id = LaporanTransaksi::latest('transaksi_id')->first();
        $first_transaksi_today = Transaksi::where('created_at','>=',$today)->first();

        if(empty($last_laporan_id)) $current_count = 0;
        elseif(!empty($first_transaksi_today)) $current_count = $first_transaksi_today->id;
        else $current_count = $last_laporan_id->id;
        $chunk = 200;
        // echo "starting...\n";

        /*DELETE LAPORAN TRANSAKSI HARI INI AGAR DATA TERUPDATE*/
        LaporanTransaksi::where('transaksi_id','>=',$current_count)->delete();
        while($current_count < $max_count){

            DB::connection('igd')->beginTransaction();
            $transaksis = Transaksi::with('pasien','kasus.diagnosis.icd10.dtd',
                'kasus.diagnosisUtama.icd10.dtd','pasien_pembayaran.perusahaan')->where('id','>=',$current_count)->where('id','<=',$current_count+$chunk)->get();
            
            $laporans = [];
            $laporans_diagnosis = [];
            foreach($transaksis as $transaksi)
            {
                $laporan = new LaporanTransaksi;
                $laporan->transaksi_id = $transaksi->id;
                $laporan->kasus_id = $transaksi->kasus_id;
                $laporan->ruangan_id = $transaksi->ruangan_id;
                $laporan->pasien_id = $transaksi->pasien_id;
                $laporan->jenis_kelamin = $transaksi->pasien->gender;
                $laporan->usia_masuk_hr = $transaksi->usia_masuk;
                $laporan->usia_masuk_th = $transaksi->usia_masuk/365;
                $laporan->pasien_pembayaran_id = $transaksi->pasien_pembayaran_id;
                $laporan->no_asuransi = $transaksi->pasien_pembayaran->no_asuransi;
                $laporan->perusahaan_pembayaran_id = $transaksi->pasien_pembayaran->perusahaan_id;
                $laporan->perusahaan_pembayaran_tipe_id = $transaksi->pasien_pembayaran->perusahaan->tipe->id;
                $laporan->no_sep = $transaksi->nomor_sep;
                $laporan->waktu_masuk = $transaksi->waktu_masuk;
                $laporan->waktu_masuk = $transaksi->waktu_masuk;
                $laporan->is_pasien_baru = $transaksi->is_pasien_baru == 1 ? 1 : 0;

                if(!empty($laporan->kasus)){
                    $laporan->krs_at = $transaksi->kasus->krs_at;
                    $laporan->krs_alasan = $transaksi->kasus->alasan_krs->nama ?? $transaksi->kasus->krs_alasan;
                    $laporan->krs_status = $transaksi->kasus->status_krs->nama ?? $transaksi->kasus->krs_status;
                    $laporan->kelas_id = $transaksi->kasus->kelas_id;
                    // $laporan->is_pasien_baru = $transaksi->kasus->is_baru == 1 ? 1 : 0;

                    $icd_10 = [];
                    $dtd = [];
                    $icd_10_utama_id = '';
                    $dtd_utama_id = '';

                    if(count($transaksi->kasus->diagnosis) > 0)
                    {
                        $icd_10 = $transaksi->kasus->diagnosis->pluck('icd10.id')->toArray();
                        $dtd = $transaksi->kasus->diagnosis->pluck('icd10.dtd_id')->toArray();

                        foreach($transaksi->kasus->diagnosis as $dx_item)
                        {
                            $laporan_diagnosis = new LaporanTransaksiDiagnosis;
                            $laporan_diagnosis->kasus_id = $laporan->kasus_id;
                            $laporan_diagnosis->icd10_id = $dx_item->icd_10;
                            $laporan_diagnosis->dtd_id = $dx_item->icd10->dtd_id;
                            $laporan_diagnosis = $laporan_diagnosis->toArray();
                            $laporans_diagnosis[] = $laporan_diagnosis;
                        }

                    }
                    if(!empty($kasus->diagnosisUtama))
                    {
                        $icd_10_utama_id = $kasus->diagnosisUtama->icd10->id;
                        $dtd_utama_id = $kasus->diagnosisUtama->icd10->dtd_id;
                    }

                    $dx = new \stdClass();
                    $icd_10_text = '-';
                    $icd_10_text.= implode('-', $icd_10);
                    $icd_10_text.= '-';
                    $dtd_text = '-';
                    $dtd_text.= implode('-', $dtd);
                    $dtd_text.= '-';
                    $dx->icd_10 = $icd_10_text;
                    $dx->dtd = $dtd_text;
                    $dx->icd_10_utama_id = $icd_10_utama_id;
                    $dx->dtd_utama_id = $dtd_utama_id;


                    $laporan->icd_10_id = $dx->icd_10;
                    $laporan->dtd_id = $dx->dtd;
                    $laporan->icd_10_utama_id = $dx->icd_10_utama_id;
                    $laporan->dtd_utama_id = $dx->dtd_utama_id;
                    $laporan->total_tagihan = $transaksi->kasus->tagihan_total;
                }
                else
                {
                    $laporan->krs_at = NULL;
                    $laporan->krs_alasan = NULL;
                    $laporan->krs_status = NULL;
                    $laporan->kelas_id = NULL;
                    $laporan->is_pasien_baru = 0;
                    $laporan->icd_10_id = '';
                    $laporan->dtd_id = '';
                    $laporan->icd_10_utama_id = '';
                    $laporan->dtd_utama_id = '';
                    $laporan->total_tagihan = 0;
                }

                $laporan = $laporan->toArray();
                unset($laporan["kasus"]); 

                $laporans[] = $laporan;
            }
            $current_count+= $chunk;
            LaporanTransaksiDiagnosis::insert($laporans_diagnosis);
            LaporanTransaksi::insert($laporans);
            DB::connection('igd')->commit();

            // echo "processed ".$current_count." of ".$max_count."...\n";
        }

        // echo "done.";
    }
}
