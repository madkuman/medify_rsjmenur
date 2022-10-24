<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Kasus\Kasus;
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

class PesanMakanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kasus:notifgizi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notif batas pesan makanan';

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
        /*
        $user = User::find(10);
        $user->avatar_big = Carbon::now();
        $user->save();
        
        $detail = new TagihanDetail;
        $detail->kasus_tagihan_id = 141;
        $detail->save();
        */
        try
        {   
            //$now = Carbon::now()->startOfDay();
            Auth::loginUsingId(1);
            $inap = Transaksi::with('kasus')->whereNull('waktu_keluar')->get();
            //dd($inap);
            foreach ($inap as $item) 
            {   
                $nomor_kasus = $item->kasus->nomor_kasus;
                $desc = "Pemesanan Makanan untuk kasus ".$nomor_kasus." max jam 8 pagi";
                $url = "kasus/".$nomor_kasus."/datamedis";
                //if($inap->kasus->pemesanan->untuk_tanggal )

                $kolab = Kolaborator::where('kasus_id',$item->kasus_id)->get();
                foreach ($kolab as $klb) 
                {   
                    //dd($klb->id);
                    if($klb->user->profesi == 2)
                    {
                        $notify = app('App\Http\Controllers\Users\Notification\CreateController')->create($klb->id, 1, $desc, $url);
                        //dd($notify);
                    }
                }
            }
        
        }
        catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

    }
}
