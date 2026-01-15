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

class TambahTagihanKamar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tagihan:kamar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tambah Tagihan Kamar dan Biaya Keperawatan Setiap Hari';

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
        try {
            DB::connection('kasus')->beginTransaction();
            Auth::loginUsingId(1);
            $transaksi = Transaksi::whereNull('waktu_keluar')->whereNotNull('kedatangan_at')->whereIn('status', [1, 2])->get();
            foreach ($transaksi as $item) {
                $tipe_default = TarifTipe::where('slug', 'default')->first();
                $kasus = $item->kasus;
                $this->addTagihan($kasus, $item->tempat_tidur->ruangan->tarif, $tipe_default);
                $tarif_lain = $item->tempat_tidur->ruangan->tarif_lain;
                foreach ($tarif_lain as  $t) {
                    $this->addTagihan($kasus, $t->tarif, $tipe_default);
                }
            }
            DB::connection('kasus')->commit();
        } catch (\Exception $e) {
            DB::connection('kasus')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
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
        if (!empty($kasus->active_sep))
            $data['sep_id'] = $kasus->active_sep->id;
        else
            $data['sep_id'] = null;

        $saveToTagihan = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
    }
}
