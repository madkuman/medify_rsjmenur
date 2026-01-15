<?php

namespace App\Console\Commands\Farmasi;

use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\TransaksiObat;
use Illuminate\Console\Command;

class RecalculateJumlahResepAsal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farmasi:recalculate-jumlah-resep-asal {id} {--action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'melakukan recalculate jumlah resep asal';

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
        $id = $this->argument('id');
        $action = $this->option('action');

        $transaksi = TransaksiObat::find($id);
        if ($transaksi->copy_resep->count() == 0) {
            echo 'bukan transaksi asal';
            return 0;
        }

        foreach ($transaksi->final_detail->resep_detail as $resep_detail) {
            $resep_detail_copy = ResepDetail::where('detail_asal_id', $resep_detail->id)->whereIn('resep_id', $transaksi->copy_resep->pluck('resep_final'))->get();
            $jumlah_diambil = $resep_detail_copy->sum('jumlah');
            echo "resep ".$resep_detail->nama_obat." diambil: ".$jumlah_diambil. " ,jumlah:" .$resep_detail->jumlah. " -> ". ($resep_detail->jumlah_awal - $jumlah_diambil);
            echo "\n";
            if ($action) {
                $resep_detail->jumlah_diambil = $jumlah_diambil;
                $resep_detail->jumlah = $resep_detail->jumlah_awal - $resep_detail->jumlah_diambil;
                $resep_detail->save();
            }
        }

        echo "done";
        return 1;
    }
}
