<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;
use App\Models\Kasus\Kolaborator;
use App\Models\Keuangan\Tarif;
use App\Models\RawatInap\Transaksi;
use App\Models\RawatInap\Ruangan;
use App\User;
use Auth;
use Carbon\Carbon;
use Bugsnag;

class TindakanSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:tindakan-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto insert tindakan yang di subscribe';

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
        try
        {
            Auth::loginUsingId(1);
            $tindakan = Tindakan::where('subscribe', 1)->get();
            foreach ($tindakan as $t) 
            {   
                $kasus = Kasus::find($t->kasus_id);
                if(!empty($t->tagihan_detail_id)){
                    $tagihan_detail_baru = $this->copyTagihanDetail($t->tagihan_detail_id, $kasus);
                    if(empty($tagihan_detail_baru))
                        continue;
                    $this->copyTindakan($t, $tagihan_detail_baru->id);
                }
                $t->subscribe = 0;
                $t->save();
            }
        
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }

    private function copyTagihanDetail($tagihan_detail_id, $kasus)
    {
        $tagihan_detail = TagihanDetail::find($tagihan_detail_id);
        if(empty($tagihan_detail))
            return;
        $data['tarif_id'] = $tagihan_detail->tarif_id;
        $data['tarif_tipe_id'] = $tagihan_detail->tarif_tipe_id;
        $data['tarif_kelas_id'] = $tagihan_detail->tarif_kelas_id;
        $data['kasus_id'] = $kasus->id;
        $data['desc'] = $tagihan_detail->desc;
        $data['unit_price'] = $tagihan_detail->unit_price;
        $data['qty'] = $tagihan_detail->qty;
        $data['lokasi'] = $kasus->lokasi->lokasi_id;
        $data['daftar_harga_id'] = 0;
        $data['sep_id'] = $kasus->sep_id;
        $data['kategori_id'] = $kasus->lokasi->lokasi->kategori_keuangan_id;
        return app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
    }

    private function copyTindakan($t, $tagihan_detail_id)
    {
        $tindakan_baru = new Tindakan;
        $tindakan_baru->kasus_id = $t->kasus_id;
        $tindakan_baru->desc = $t->desc;
        $tindakan_baru->price = $t->price;
        $tindakan_baru->tagihan_detail_id = $tagihan_detail_id;
        $tindakan_baru->created_by = Auth::user()->id;
        $tindakan_baru->tarif_master_id = $t->tarif_master_id;
        $tindakan_baru->subscribe = 1;
        $tindakan_baru->subscribed_by = $t->subscribed_by;
        $tindakan_baru->save();
    }
}
