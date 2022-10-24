<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Keuangan\Utang;
use Carbon\Carbon;

class CreateNomorPJK extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keuangan:create-no-pjk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Nomor PJK untuk yang belum kesimpan';

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
        $utang = Utang::with('akun')->get();

        $count = 1;
        $size = count($utang);
        foreach ($utang as $key => $value) {
            if (!empty($value->no_pjk)) {
                $date = Carbon::parse($value->tanggal_transaksi);
                $no = $value->no_pjk;
                $bulan = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman($date->month);
                $tahun = $date->year;
                $akun_pjk = $value->akun->name;
                $no_pjk = ($no).'/'.$bulan.'/'.$tahun.'/'.$akun_pjk;

                echo "Seeding ".$no_pjk." (item ".$count." of ".$size.")...\n";
                $value->nomorpjk = $no_pjk;
                $value->save();
            }
            $count++;
        }

        echo "done.";
    }
}
