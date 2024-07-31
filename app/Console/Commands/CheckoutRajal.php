<?php

namespace App\Console\Commands;

use App\Models\Pasien\PasienPembayaran;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Kasus\Kasus;
use App\Models\Hospital\Logger;
use App\Models\Kasus\KasusLokasi;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterStatusPulang;
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
    protected $signature = 'kasus:checkout-rajal {id?} {--date_range=0}';

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
        $auto_checkout = config('medify.rawatjalan.auto_krs_dan_checkout.auto_checkout');
        $kasus_id = $this->argument('id');

        //inisiasi daterange 
        $date_range = $this->getDateRange();
        if($date_range == [0,0]){
            echo "Format Daterange Tidak Bisa Diproses\n";
            return;
        }

        #create logger
        $logger = new Logger();
        $logger->slug = 'kasus:checkout-rajal';
        $logger->status = 'start';
        $logger->created_by = 1;
        $logger->param = [
            'date' => now()->toDateTimeString(),
        ];
        $logger->save();

        echo "Get kasus...\n";
        $perusahan_tipe_id = [1,3]; // asuransi dan umum
        $perusahaan_ids = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->getPerusahaanByTipe($perusahan_tipe_id)->pluck('id');

        // $pembayaran_ids = TransaksiRawatJalan::whereNotNull('kasus_id')->whereNotNull('waktu_pemeriksaan')->where('waktu_pemeriksaan', '<', $now)->groupBy('pasien_pembayaran_id')->pluck('pasien_pembayaran_id')->toArray();
        // $pasien_pembayaran_id = PasienPembayaran::whereIn('id',$pembayaran_ids)->whereIn('perusahaan_id',$perusahaan_ids)->get()->pluck('id');
        // $kasus_ids = TransaksiRawatJalan::whereIn('pasien_pembayaran_id',$pasien_pembayaran_id)->whereNotNull('kasus_id')->whereNotNull('waktu_pemeriksaan')->where('waktu_pemeriksaan', '<', $now)->groupBy('kasus_id')->pluck('kasus_id')->toArray();
        // $kasus = Kasus::whereIn('id', $kasus_ids)->whereNull('krs_at')->where('tipe_rj',1)->where('tipe_ri',0)->whereDoesntHave('TransaksiRawatInap', function($q1){
        //     $q1->from(config('app.db_name').'_rawat_inap.transaksi')->select('id','kasus_id');
        // })->get();
        
        $query = Kasus::with(['daftar_tagihan_belum_checkout', 'transaksiRawatJalanLast'])
            ->where('tipe_rj',1);
        if($kasus_id != null) {
            $query = $query->where('id', $kasus_id);
        }
        $query->where('tipe_ri',0)
            ->whereDoesntHave('TransaksiRawatInap', function($query){
                $query->select(DB::raw('1'))
                        ->from(config('app.db_name')."_rawat_inap.transaksi")
                        ->whereIn('status', [0,1,2]);
            })
            ->where(function($query) use($perusahaan_ids) {
                return $query->whereHas('pembayaran',function($q2) use ($perusahaan_ids){
                    $q2->select(DB::raw('1'))
                        ->from(config('app.db_name')."_patients.pasien_pembayaran")
                        ->whereIn('perusahaan_id',$perusahaan_ids);
                })->orWhereHas('pembayaranTambahan',function($q3) use ($perusahaan_ids){
                    $q3->select(DB::raw('1'))
                        ->whereHas('pembayaran',function($q4) use($perusahaan_ids){
                            $q4->select(DB::raw('1'))
                                ->from(config('app.db_name')."_patients.pasien_pembayaran")
                                ->whereIn('perusahaan_id',$perusahaan_ids);
                        });
                });
            })
            ->where(function($query){
                $query->whereNull('krs_at');
            });

            $query->whereHas('TransaksiRawatJalan', function($query) use ($date_range){
                $query->select(DB::raw('1'))
                        ->from(config('app.db_name')."_rawat_jalan.transaksi")
                        ->whereNotNull('waktu_pemeriksaan');
                        if($date_range[0] != 0)
                            $query->where('waktu_pemeriksaan', '>=', $date_range[0]);
                        if($date_range[1] != 0) {
                            $query->where('waktu_pemeriksaan', '<=', $date_range[1]);
                        }
                        $query->where('status','!=',3);
            });
        
        $query->where('nomor_kasus', 'LIKE', "med%");
        $kasus = $query->get();
        $dump_query = dumpquery($query);
        $total = $kasus->count();
        
        $logger->status = 'preparing-' . $total;
        $logger->data = [
            'total' => $total,
            'query' => $dump_query,
        ];
        $logger->save();
        
        // CREATE REQUEST FOR KRS & CHECKOUT
        echo "Creating request...\n";
        $cara_pulang = MasterCaraPulang::where('slug', 'selesai-pelayanan')->first()->id;
        $status_pulang = MasterStatusPulang::where('slug', 'sembuh')->first()->id;
        $request = new \Illuminate\Http\Request();
        $request->replace(['from_scheduler' => 1, 'krs_by' => 1, 'alasan_krs' => $cara_pulang, 'status_krs' => $status_pulang, 'gizi' => null, 'rawatinap' => 1, 'operasi' => 1, 'labpa' => 1, 'labpk' => null, 'radiologi' => null, 'farmasi' => null, 'kasir_tujuan' => 3, 'split_piutang' => null]);

        // BEGIN EXEC
        $count = 1;
        $size = count($kasus);
        $sum_success_count = 0;
        $sum_error_count = 0;
        foreach ($kasus->chunk(500) as $chunk) {
        foreach ($chunk as $key => $item) {
            if(empty($kasus->penunjangRadiologiBelomSelesai) && empty($kasus->penunjang_labpkBelomSelesai) && empty($kasus->transaksi_farmasiBelomSelesai)) {
                echo "Checking out " . $count . " item of " . $size . "...\n";
                try {
                    echo "KRS kasus " . $item->nomor_kasus . "...\n";
                    $request->merge([
                        'krs_at' => Carbon::parse($item->transaksiRawatJalanLast->ordered_at)->toDateString() . ' 23:59:00'
                    ]);
                    $exec_krs = app('App\Http\Controllers\Kasus\Pengaturan\PostController')->dataKRS($item->nomor_kasus, $request);
                    echo $exec_krs . "...\n";
                    if (!empty($item->daftar_tagihan_belum_checkout) && $auto_checkout == 1) {                    
                        foreach ($item->daftar_tagihan_belum_checkout as $tagihan) {
                            echo "Checking out ".$item->nomor_kasus."...\n";
                            $request->merge(['tagihan_id' => $tagihan->id]);
                            $exec_checkout = app('App\Http\Controllers\Kasus\Tagihan\PostController')->checkout($request, $item->nomor_kasus);
                            echo $exec_checkout."...\n";
                        }
                    }
                    $sum_success_count ++;                    
                } catch (Exception $e) {
                    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                    echo $e->getMessage();
                    $sum_error_count ++;
                }
                $count++;
            }
        }
        }

        $logger->status = "finish";
        $logger->data = [
            'total' => $total,
            'query' => $dump_query,
            'success' => $sum_success_count,
            'error' => $sum_error_count,
        ];
        $logger->save();

        
        // Kasus::whereIn('id', $kasus)->update([
        //     'krs_at'        => Carbon::now()->toDateTimeString(),
        //     'krs_by'        => 1,
        //     'krs_alasan'    => 'Selesai Pelayanan',
        //     'krs_status'    => 'Membaik'
        // ]);
        echo "done.";
    }

    public function getDateRange()
    {   
        $date_range = $this->option('date_range');
        $start_date=0; 
        $end_date=0;
        $date_range = explode('~', $date_range);
        if(!empty($date_range[0]) || !empty($date_range[1])){
            if(!empty($date_range[0])){
                try {
                    $start_date = Carbon::parse($date_range[0])->startOfDay()->toDateTimeString();
                } catch (\Exception $e) {
                    echo "format tanggal awal tidak YYYY-MM-DD (Y-m-d)\n";
                    $start_date =  0;
                }
            }

            if(!empty($date_range[1])){
                try {
                    $end_date = Carbon::parse($date_range[1])->endOfDay()->toDateTimeString();
                } catch (\Exception $e) {
                    echo "format tanggal akhir tidak YYYY-MM-DD (Y-m-d)\n";
                    $end_date = 0;
                }
            }
            if($end_date == 0) $end_date == $start_date;
            return [$start_date, $end_date];
        }else{
            //default run
            return ['2024-01-01 00:00:00', Carbon::today()->endOfDay()->toDateTimeString()];
        }

    }
}
