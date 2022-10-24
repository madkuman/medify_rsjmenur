<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Keuangan\Tarif;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\Ruangan;
use App\Models\Keuangan\TarifTipe;
use App\User;
use Auth;
use Carbon\Carbon;
use Bugsnag;
use DB;

class TambahTagihanKamarDateSpecific extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tagihan:kamar-specific {--tanggal=} {--bulan=} {--tahun=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tambah Tagihan Kamar dan Biaya Keperawatan Pada Tanggal Tertentu';

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
        Auth::loginUsingId(1);
        $tanggal = is_null($this->option('tanggal')) ? Carbon::now()->day : $this->option('tanggal');
        $bulan = is_null($this->option('bulan')) ? Carbon::now()->month : $this->option('bulan');
        $tahun = is_null($this->option('tahun')) ? Carbon::now()->year : $this->option('tahun');
        $date = $tahun.'-'.$bulan.'-'.$tanggal;
        $start_date = Carbon::createFromFormat('Y-m-d', $date);
        $start_date->hour(13);
        $start_date->minute(00);
        $start_date->second(00);
        $transaksi = Transaksi::whereNull('waktu_keluar')->whereNotNull('kedatangan_at')->whereIn('status',[1,2])->get();
        foreach($transaksi as $item)
        {
            try
            {
                DB::connection('kasus')->beginTransaction();
                $tipe_default = TarifTipe::where('slug','default')->first();
                $kasus = $item->kasus;
                $detail = $this->addTagihan($kasus, $item->tempat_tidur->ruangan->tarif, $tipe_default);
                $detail->created_at = $start_date;
                $detail->updated_at = $start_date;
                $detail->save();
                $tarif_lain = $item->tempat_tidur->ruangan->tarif_lain;
                foreach ($tarif_lain as  $t) {
                    $detail = $this->addTagihan($kasus, $t->tarif, $tipe_default);
                    $detail->created_at = $start_date;
                    $detail->updated_at = $start_date;
                    $detail->save();
                }
                DB::connection('kasus')->commit();
            }
            catch (\Exception $e) {
                DB::connection('kasus')->rollback();
                app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            }
        }
echo 'done';
    }

    public function addTagihan($kasus, $tarif, $tipe_default)
    {
        $data['kasus_id'] = $kasus->id;
        $data['tarif_kelas_id'] = $tarif->kelas->id ?? $kasus->lokasi->lokasi->ruangan->kelas;
        $data['tarif_tipe_id'] = $tipe_default->id;
        $data['desc'] = $tarif->master->deskripsi;
        $data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;
        $data['lokasi'] = $kasus->lokasi->lokasi->id;
        $data['unit_price'] = $tarif->harga;
        $data['qty'] = 1;
        $data['daftar_harga_id'] = null;
        $data['tarif_id'] = $tarif->id;
        if(!empty($kasus->active_sep))
            $data['sep_id'] = $kasus->active_sep->id;
        else
            $data['sep_id'] = null;

        $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
        return $saveToTagihan;
    }
}
