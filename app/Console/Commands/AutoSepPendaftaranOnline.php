<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RawatJalan\Transaksi;
use App\User;
use Auth;
use Carbon\Carbon;
use Bugsnag;

class AutoSepPendaftaranOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bpjs:auto-sep-online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto create SEP untuk pendaftaran rajal online hari ini';

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

            $transaksies_delete_sep = Transaksi::whereDate('ordered_at', '>', Carbon::today()->toDateString())->where('is_sep_online_created', 0)->whereNotNull('nomor_sep')->get();

            if($transaksies_delete_sep){
                foreach ($transaksies_delete_sep as $transaksi) {
                    app('App\Http\Controllers\BPJS\SEP\PostController')->delete($request, $transaksi->nomor_sep);
                    $transaksi->nomor_sep = null;
                    $transaksi->is_sep_online_created = -1;
                    $transaksi->save();
                }
            }


            $transaksies = Transaksi::whereDate('ordered_at', Carbon::today()->toDateString())->where('is_sep_online_created', -1)->get();
            if($transaksies){
                foreach ($transaksies as $transaksi) {
                    $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\ReadController')->single($transaksi->pasien_pembayaran_id);
                    if($pembayaran->perusahaan->tipe->slug == 'bpjs'){
                        $result = app('App\Http\Controllers\BPJS\AutoSEP\CreateController')->generate('rawatjalan', $transaksi->pasien_id, 
                            $transaksi->pasien_pembayaran_id, $transaksi->poliklinik_id);

                        if($pembayaran->perusahaan->tipe->slug == 'bpjs' && !empty($result->metaData)) {
                            if($result->metaData->code == 200 && !empty($result->response))
                            {
                                if(!empty($result->response->sep)){
                                    $transaksi->nomor_sep = $result->response->sep->noSep;
                                }
                            }
                        }
                    }
                    //gagal auto sep, tp tetep diset 1 biar ga nyoba2 lg
                    $transaksi->is_sep_online_created = 1;
                    $transaksi->save();
                }
            }
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}
