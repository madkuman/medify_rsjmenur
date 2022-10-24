<?php

namespace App\Console\Commands\Kasus;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Bugsnag;
use DB;
use MPDF;
use App\User;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Kolaborator;
use App\Models\Keuangan\MasterTTD;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\Tarif;
use App\Models\Keuangan\Kategori;
use App\Models\Keuangan\TarifKelas;
use App\Models\KamarOperasi\Transaksi as OperasiTransaksi;
use App\Models\KamarOperasi\Tim as OperasiTim;
use App\Models\KamarOperasi\PeranTim as OperasiPeranTim;
use App\Models\Farmasi\Resep;
use App\Models\Farmasi\ResepDetail;
use App\Models\Keuangan\TTD;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\BPJSSEP;
use App\Models\Pasien\Pasien;

class GeneratePenagihanFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:generate-penagihan {--piutang=} {--day=} {--krs_at=} {--krs_range=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRON Generate Penagihan';

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
        DB::connection('kasus')->beginTransaction();
        try
        {  
            ini_set('max_execution_time', 50000);
            ini_set("pcre.backtrack_limit", "5000000");
            setlocale(LC_TIME, 'Indonesian');

            $piutang_id = $this->option('piutang');
            if(is_null($piutang_id))
            {
                $this->generateAutoKasus();
            } else
            {
                $piutang = Piutang::with('detail', 'detail.tipe:id,nama', 'kasusTagihan.detail.radiologi', 
                    'kasusTagihan.detail.labpa', 'kasusTagihan.detail.labpk',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus.identitas', 'pasien',
                    'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_keanggotaan',
                    'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
                    'kasusTagihan.kasus', 'kasusTagihan.kasus.diagnosis', 'kasusTagihan.kasus.diagnosis.lokasi:id,nama', 'kasusTagihan.kasus.diagnosis.icd10:id,code_icd,long_desc',
                    'kasusTagihan.kasus.tindakan_icd9', 'kasusTagihan.kasus.tindakan_icd9.lokasi:id,nama', 'kasusTagihan.kasus.tindakan_icd9.icd9:id,code_icd,long_desc',
                    'kasusTagihan.permintaanJenazah',
                    'kasusTagihan.ketKelahiran')->where('id', $id)->get();
        
                $path = public_path("downloads/print/penagihan/".date('d-m-Y', strtotime($piutang[0]->kasusTagihan->kasus->krs_at))."/");
                if(!file_exists($path))
                    mkdir($path, 0777, true);

                $sep = $piutang[0]->kasusTagihan->kasus->sep->no_sep ?? '-';

                $sep_filename = $sep.'.pdf';
                $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
                $sep_fullname = $path.$sep_filename;

                $piutang = app('App\Http\Controllers\Keuangan\Piutang\ViewController')->printByPiutang($piutang, $piutang_id, $sep_fullname);
            }

            DB::connection('kasus')->commit();        
        }
        catch (\Exception $e) {
            DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }

    private function generateAutoKasus()
    {
        if(!is_null($this->option('krs_at'))){
            $krs_date = $this->option('krs_at');
            $krs_date = Carbon::createFromFormat('Ymd', $krs_date)->toDateString();
            
            $kasuses = Kasus::whereDate('krs_at',$krs_date)->with(['tagihan_checkout'])->get();
        } 
        else if(!is_null($this->option('krs_range'))){
            $krs_range = explode('-', $this->option('krs_range'));
            $krs_start = Carbon::createFromFormat('Ymd', $krs_range[0])->toDateTimeString();
            $krs_end = Carbon::createFromFormat('Ymd', $krs_range[1])->toDateTimeString();

            $kasuses = Kasus::whereBetween('krs_at',[$krs_start, $krs_end])->with(['tagihan_checkout'])->get();
        }else {
            $day = is_null($this->option('day')) ? 10 : $this->option('day');
            $target_date = Carbon::now()->subDays($day)->toDateString(); //LAST custom DAYS
            $kasuses = Kasus::whereNotNull('last_updated_at')->whereDate('last_updated_at', '>', $target_date)
                        ->where(function($q){
                            $q->whereColumn('file_generated_at', '<', 'last_updated_at')
                            ->orWhereNull('file_generated_at');
                        })->with(['tagihan_checkout'])->get();
        }
        $tagihan_ids = $kasuses->pluck('tagihan_checkout')->toArray();
        //$this->error('ha'.var_dump($tagihan_ids));
        $piutangs = Piutang::with('detail', 'detail.tipe:id,nama', 'kasusTagihan.detail.radiologi', 
            'kasusTagihan.detail.labpa', 'kasusTagihan.detail.labpk',
            'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
            'kasusTagihan.kasus.identitas', 'pasien',
            'pasien.tni_pangkat', 'pasien.tni_kotama', 'pasien.tni_satker', 'pasien.tni_keanggotaan',
            'kasusTagihan.detail.radiologi.transaction', 'kasusTagihan.detail.labpa.transaction', 'kasusTagihan.detail.labpk.transaksi',
            'kasusTagihan.kasus', 'kasusTagihan.kasus.diagnosis', 'kasusTagihan.kasus.diagnosis.lokasi:id,nama', 'kasusTagihan.kasus.diagnosis.icd10:id,code_icd,long_desc',
            'kasusTagihan.kasus.tindakan_icd9', 'kasusTagihan.kasus.tindakan_icd9.lokasi:id,nama', 'kasusTagihan.kasus.tindakan_icd9.icd9:id,code_icd,long_desc',
            'kasusTagihan.permintaanJenazah',
            'kasusTagihan.ketKelahiran')->whereIn('kasus_tagihan_id', $tagihan_ids)->get();

        foreach ($piutangs as $piutang) {
            try {
                $path = public_path("downloads/print/penagihan/".date('d-m-Y', strtotime($piutang->kasusTagihan->kasus->krs_at))."/");
                if(!file_exists($path))
                    mkdir($path, 0777, true);

                $sep = $piutang->kasusTagihan->kasus->sep->no_sep ?? '-';

                $sep_filename = $sep.'.pdf';
                $sep_filename = preg_replace('/(\/|\\\)/', ' ', $sep_filename);
                $sep_fullname = $path.$sep_filename;
                
                //KALO BELOM
                $pdf = app('App\Http\Controllers\Keuangan\Piutang\ViewController')->printByPiutang(collect([$piutang]), $piutang->id, $sep_fullname);
                
            } catch (Exception $e) {
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                continue;
            }
        }
    }
}