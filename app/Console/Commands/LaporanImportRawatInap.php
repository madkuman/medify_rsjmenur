<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\LaporanTransaksi;
use App\Models\RawatInap\LaporanTransaksiDiagnosis;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use DB;
use Carbon\Carbon;

class LaporanImportRawatInap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rawatinap:importlaporan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Laporan Transaksi Rawat Inap dari Transaksi';

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
        $tanggal_2_hari_lalu = $today->copy()->subDays(2);
        $transaksi_all = Transaksi::get();
        $laporan = LaporanTransaksi::count();
        $kasus_rawat_inap_all = Transaksi::select('kasus_id')->distinct()->pluck('kasus_id')->toArray();
        if($laporan != 0)
        {
            $kasus_krs_null = Kasus::whereIn('id',$kasus_rawat_inap_all)->whereNull('krs_at')->pluck('id')->toArray();
            $kasus_krs_2_hari_lalu = Kasus::whereIn('id',$kasus_rawat_inap_all)->where('krs_at','>',$tanggal_2_hari_lalu)->pluck('id')->toArray();
            $kasus_merge = array_merge($kasus_krs_2_hari_lalu, $kasus_krs_null);
            $kasus_id = $kasus_merge;
        }
        else $kasus_id = $kasus_rawat_inap_all;
        $current_count = 0;
        $max_count = count($transaksi_all);
        $chunk = 200;

        while($current_count < $max_count){

            DB::connection('rawatinap')->beginTransaction();

            $kasus_current_id = Kasus::whereIn('id',$kasus_id)->offset($current_count)
                            ->take($chunk)->pluck('id')->toArray();
            $laporan = LaporanTransaksi::whereIn('kasus_id',$kasus_current_id)->delete();
            $laporan_dx = LaporanTransaksiDiagnosis::whereIn('kasus_id',$kasus_current_id)->delete();


            $kasuss = Kasus::with('pasien','diagnosis.icd10.dtd',
                'diagnosisUtama.icd10.dtd','pembayaran.perusahaan','rawat_inap_transaksi_first',
                'rawat_inap_transaksi_last','rawat_inap_transaksi')
            ->whereIn('id',$kasus_current_id)->get();

            $kasus_ids = $kasuss->pluck('id')->toArray();

            $laporans = [];
            $laporans_diagnosis = [];
            foreach($kasuss as $kasus)
            {
                $laporan = new LaporanTransaksi;
                $laporan->kasus_id = $kasus->id;
                $laporan->tempat_tidur_id =  implode(',', $kasus->rawat_inap_transaksi->pluck('tempat_tidur_id')->toArray());  
                $laporan->pasien_id = $kasus->pasien_id;
                $laporan->jenis_kelamin = $kasus->pasien->gender;

                $usia_masuk = !empty($kasus->rawat_inap_transaksi_first) ? $kasus->rawat_inap_transaksi_first->usia_masuk : 0;
                $kedatangan_at = !empty($kasus->rawat_inap_transaksi_first) ? $kasus->rawat_inap_transaksi_first->kedatangan_at : NULL;
                $waktu_masuk = !empty($kasus->rawat_inap_transaksi_first) ? $kasus->rawat_inap_transaksi_first->waktu_masuk : NULL;
                $waktu_keluar = !empty($kasus->rawat_inap_transaksi_last) ? $kasus->rawat_inap_transaksi_last->waktu_keluar : NULL;

                $laporan->usia_masuk_hr = $usia_masuk;
                $laporan->usia_masuk_th = $usia_masuk/365;
                $laporan->pasien_pembayaran_id = $kasus->pasien_pembayaran_id;
                $laporan->no_asuransi = $kasus->pembayaran->no_asuransi;
                $laporan->perusahaan_pembayaran_id = $kasus->pembayaran->perusahaan_id;
                $laporan->perusahaan_pembayaran_tipe_id = $kasus->pembayaran->perusahaan->tipe->id;
                $laporan->kelas_id = $kasus->kelas_id;
                $laporan->kedatangan_at = $kedatangan_at;
                $laporan->waktu_masuk = $waktu_masuk;
                $laporan->waktu_keluar = $waktu_keluar;
                $laporan->krs_at = $kasus->krs_at;
                $laporan->krs_alasan = $kasus->alasan_krs->nama ?? $kasus->krs_alasan;
                $laporan->krs_status = $kasus->status_krs->nama ?? $kasus->krs_status;
                $laporan->total_tagihan = $kasus->tagihan_total;

                $icd_10 = [];
                $dtd = [];
                $icd_10_utama_id = '';
                $dtd_utama_id = '';

                if(count($kasus->diagnosis) > 0)
                {
                    $icd_10 = $kasus->diagnosis->pluck('icd10.id')->toArray();
                    $dtd = $kasus->diagnosis->pluck('icd10.dtd_id')->toArray();

                    foreach($kasus->diagnosis as $dx_item)
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
            

                $laporan = $laporan->toArray();
                $laporans[] = $laporan;
            }
            $current_count+= $chunk;
            LaporanTransaksi::insert($laporans);
            LaporanTransaksiDiagnosis::insert($laporans_diagnosis);
            DB::connection('rawatinap')->commit();
        }
    }
}
