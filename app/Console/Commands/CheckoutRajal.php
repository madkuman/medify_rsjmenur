<?php

namespace App\Console\Commands;

use App\Models\Pasien\PasienPembayaran;
use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\KasusLokasi;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use Auth;
use Carbon\Carbon;
use Bugsnag;

class CheckoutRajal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:checkout-rajal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto checkout & KRS kasus rawat jalan harian';

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
    public function handle(){
        Auth::loginUsingId(1);
        $now = Carbon::now();
        //$threshold = $now->copy()->startOfDay()->subDays(30);

        echo "Get kasus...\n";
        $perusahan_tipe_id = [1,3]; // asuransi dan umum
        $perusahaan_ids = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanByTipe($perusahan_tipe_id)->pluck('id');
        $pembayaran_ids = TransaksiRawatJalan::whereNotNull('kasus_id')->whereNotNull('waktu_pemeriksaan')->where('waktu_pemeriksaan', '<', $now)->groupBy('pasien_pembayaran_id')->pluck('pasien_pembayaran_id')->toArray();
        $pasien_pembayaran_id = PasienPembayaran::whereIn('id',$pembayaran_ids)->whereIn('perusahaan_id',$perusahaan_ids)->get()->pluck('id');
        $kasus_ids = TransaksiRawatJalan::whereIn('pasien_pembayaran_id',$pasien_pembayaran_id)->whereNotNull('kasus_id')->whereNotNull('waktu_pemeriksaan')->where('waktu_pemeriksaan', '<', $now)->groupBy('kasus_id')->pluck('kasus_id')->toArray();
        $kasus = Kasus::whereIn('id', $kasus_ids)->whereNull('krs_at')->where('tipe_rj',1)->where('tipe_ri',0)->whereDoesntHave('TransaksiRawatInap', function($q1){
            $q1->from(config('app.db_name').'_rawat_inap.transaksi')->select('id','kasus_id');
        })->get();
        
        // CREATE REQUEST FOR KRS & CHECKOUT
        echo "Creating request...\n";
        $request = new \Illuminate\Http\Request();
        $request->replace(['from_scheduler' => 1, 'krs_by' => 1, 'alasan_krs' => 1, 'status_krs' => 1, 'gizi' => null, 'rawatinap' => 1, 'operasi' => 1, 'labpa' => 1, 'labpk' => null, 'radiologi' => null, 'farmasi' => null, 'kasir_tujuan' => 3, 'split_piutang' => null]);

        // BEGIN EXEC
        $count = 1;
        $size = count($kasus);
        foreach ($kasus as $key => $item) {
            if(empty($kasus->penunjangRadiologiBelomSelesai) && empty($kasus->penunjang_labpkBelomSelesai) && empty($kasus->transaksi_farmasiBelomSelesai)) {
                echo "Checking out " . $count . " item of " . $size . "...\n";
                try {
                    $exec_krs = app('App\Http\Controllers\Kasus\Pengaturan\PostController')->dataKRS($item->nomor_kasus, $request);
                    if (!empty($item->daftar_tagihan_belum_checkout)) {
                        foreach ($item->daftar_tagihan_belum_checkout as $tagihan) {
                            $request->merge(['tagihan_id' => $tagihan->id]);
                            $exec_checkout = app('App\Http\Controllers\Kasus\Tagihan\PostController')->checkout($request, $item->nomor_kasus);
                        }
                    }
                } catch (Exception $e) {
                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                }
                $count++;
            }
        }
        // Kasus::whereIn('id', $kasus)->update([
        //     'krs_at'        => Carbon::now()->toDateTimeString(),
        //     'krs_by'        => 1,
        //     'krs_alasan'    => 'Selesai Pelayanan',
        //     'krs_status'    => 'Membaik'
        // ]);
        echo "done.";
    }
}
