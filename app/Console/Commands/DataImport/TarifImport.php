<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\Keuangan\TarifMaster;
use App\Models\Keuangan\Tarif;
use App\Models\Hospital\DataImport;
use App\Models\Hospital\Kelas;
use App\Models\Keuangan\TarifTipe;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TarifImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:tarif {id=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $arguments = $this->arguments();
        $id = $arguments['id'];
        $data_import = [];
        $data_kelas = [];
        $data_tipe = [];

        $kelas = Kelas::all();
        foreach($kelas as $item)
        {
            $data_kelas[$item->nama] = $item->id;
        }

        $tipe = TarifTipe::all();
        foreach($tipe as $item)
        {
            $data_tipe[$item->nama] = $item->id;
        }

        if(!empty($id)){
            $data_import = DataImport::find($id);
            $data_import->status = null;
            $data_import->keterangan = null;
            $data_import->current_row = 0;
        }

        if(empty($data_import) || $data_import->jenis != 'tarif')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','tarif')->first();
        }

        $path = 'public/'.$data_import->file_path;

        echo "Reading File : ".$path."\n";

        $data = Excel::toArray(new DefaultImporter, $path)[0];
        $max_column = count($data[0])-1;

        $data_import->status = 'progress';
        $data_import->total_row = count($data);
        $data_import->save();

        $this->current_data_import_id = $data_import->id;
        $last_id[0] = 0;
        $last_column = 0;

        foreach($data as $index => $item)
        {
            try {
                DB::connection('keuangan')->beginTransaction();

                echo $index;

                $tarif_master = TarifMaster::where('deskripsi',$item[1])->where('kategori_id',$item[2])->first();
                if(empty($tarif_master))
                {
                    echo "--tarif-master-new";
                    $tarif_master = new TarifMaster;
                    $tarif_master->deskripsi = $item[1];
                    $tarif_master->kategori_id = $item[2];
                    $tarif_master->created_by = $data_import->created_by;
                    $tarif_master->save();
                }
                else echo "--tarif-master-update";

                $tipe = $data_tipe[$item[4]];
                $kelas = $data_kelas[$item[3]] ?? 0;

                $tarif = Tarif::where('tarif_master_id',$tarif_master->id)->where('tipe_id',$tipe)->where('kelas_id',$kelas)->first();
                if(empty($tarif))
                {
                    echo "--tarif-new";
                    $tarif = new Tarif;
                    $tarif->tarif_master_id = $tarif_master->id;
                    $tarif->tipe_id = $tipe;
                    $tarif->kelas_id = $kelas;
                }
                else echo "--tarif-update";
                $tarif->harga = $item[5];
                $tarif->save();

                echo " -- Success";
                $data_import->current_row = $index;
                $data_import->save();
                DB::connection('keuangan')->commit();
            }
            catch (\Exception $e) {

                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan,$data_import->id);

                DB::connection('keuangan')->rollBack();
            }
            echo "\n";
        }

        $data_import->status = 'done';
        $data_import->save();
    }

    private function dataImportUpdateKeterangan($keterangan,$data_import_id)
    {
        $data_import = DataImport::find($data_import_id);
        $data_import->keterangan = $data_import->keterangan.$keterangan."\n";
        $data_import->save();
    }
}
