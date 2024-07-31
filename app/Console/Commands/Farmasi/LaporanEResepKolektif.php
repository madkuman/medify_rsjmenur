<?php

namespace App\Console\Commands\Farmasi;

use App\Jobs\QueueArtisan;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Hospital\DataArtisanCall;
use App\Models\Hospital\Laporan;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use  App\PDFMerger\PDFMerger;

class LaporanEResepKolektif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:eresep-kolektif {farmasi_id} {date_min} {date_max} {laporan_id} {lokasi_id} {sumber_dana_id} {kategori_id} {asuransi_tipe_id} {resep_jenis} {filename} {jenis_cetak} {file_list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate zip print e-resep kolektif farmasi';

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
            ini_set('max_execution_time', 50000);
            ini_set('memory_limit', '2048M');
            $farmasi_id = explode(',', $this->argument('farmasi_id'));
            $lokasi_id = explode(',', $this->argument('lokasi_id'));
            $sumber_dana_id = explode(',', $this->argument('sumber_dana_id'));
            $asuransi_tipe_id = explode(',', $this->argument('asuransi_tipe_id'));
            $resep_jenis = explode(',', $this->argument('resep_jenis'));
            $kategori = explode(',', $this->argument('kategori_id'));
            $date_min = Carbon::parse($this->argument('date_min'))->startOfDay();
            $date_max = Carbon::parse($this->argument('date_max'))->endOfDay();
            $filename = explode(',', $this->argument('filename'));
            $jenis_cetak = explode(',', $this->argument('jenis_cetak'));
            $file_list = explode(',', $this->argument('file_list'));
            $laporan_id = $this->argument('laporan_id');

            $laporan = Laporan::find($laporan_id);
            if ($laporan == null) {
                echo "laporan tidak ditemukan";
                return 0;
            }

//            $farmasi_name = Farmasi::whereIn('id', $farmasi_id)->pluck('nama')->toArray();
//            $farmasi_name = implode(',', $farmasi_name);
//            $farmasi_name = Str::slug($farmasi_name);

            $perusahaan_tipe = PembayaranPerusahaan::with(['tipe' => function ($q) use ($asuransi_tipe_id){
                                        $q->where('id', $asuransi_tipe_id);
                                    }])
                                    ->pluck('id');
            
//            $item_template_id = (new \App\Http\Controllers\Farmasi\Kategori\ReadController())->getItemTemplateIdByItemKategori($kategori);

            $transaksi = TransaksiObat::with([])
                    ->whereHas('kasus', function($q){
                        $q->from(config('app.db_name').'_kasus.kasus');
                    }) 
                    ->whereBetween('created_at', [$date_min, $date_max])
                    ->when(in_array('racikan', $resep_jenis), function($q){
                        $q->whereHas('final_detail', function($fin){
                            $fin->whereHas('resep_detail', function($res){
                                $res->where('tipe',1);
                            });
                        });
                    })
                    ->when(in_array('non-racikan', $resep_jenis), function($q){
                        $q->whereHas('final_detail', function($fin){
                            $fin->whereDoesntHave('resep_detail', function($res){
                                $res->where('tipe',1);
                            });
                        });
                    })
                    ->when(!in_array('0', $farmasi_id), function ($q) use ($farmasi_id) {
                        $q->whereIn('farmasi_id', $farmasi_id);
                    })
                    ->when(!in_array('0', $lokasi_id), function ($q) use ($lokasi_id) {
                        $q->whereIn('lokasi_id', $lokasi_id);
                    })
                    ->when(!in_array('0', $kategori), function ($q) use ($kategori, $sumber_dana_id) {
                        $q->whereHas('final_detail.resep_detail.obat_detail.item_template.kategori_item.detail_kategori', function($q2) use ($kategori, $sumber_dana_id){
                            $q2->whereIn('id', $kategori)
                                ->when(!in_array('0', $sumber_dana_id), function ($q3) use ($sumber_dana_id) {
                                    $q3->whereHas('sumber_dana', function($q4) use ($sumber_dana_id){
                                        $q4->whereIn('id', $sumber_dana_id);
                                    });
                                });
                        });
                    })
                    ->where('status', 1)
                    ->get();

            $params['date_min'] = $date_min->toDateTimeString();
            $params['date_max'] = $date_max->toDateTimeString();
            $params['filename'] = $filename;
            $params['jenis_cetak'] = $jenis_cetak;
            $params['file_list'] = $file_list;
            $params['asuransi_tipe_id'] = $asuransi_tipe_id;
            
            $zipper_detail = $transaksi->map(function ($item) {
                return [
                    'referensi_id' => $item->id,
                ];
            });
            $zipper = app(\App\Http\Controllers\Hospital\Zipper\CreateController::class)->create('farmasi:eresep-kolektif', $params, $zipper_detail);
            $laporan->zipper_id = $zipper->id;
            $laporan->save();

            // $zipname = (new \App\Http\Controllers\Farmasi\Transaksi\CommandGenerateFileController())->preGeneratePenagihanPaketTransaksi($transaksi, $laporan_id, $params);

            $data = [
                'param_request' => json_encode(['zipper_id' => $zipper->id]),
                'command_artisan' => 'zipper:invoke',
                'created_by' => 1,
                'created_at' => now(),
            ];
            $data_artisan_call_id = DataArtisanCall::insertGetId($data);
        } catch (\Exception $e) {
            $data['laporan_id'] = $this->argument('laporan_id');
            $data['message'] = $e->getMessage();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
