<?php

namespace App\Console\Commands\DataImport;

use App\Models\Eusulan\AkunRekening;
use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class EusulanAkunRekening extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:e-usulan-akun-rekening {id=0}';

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
    protected $current_data_import_id = 0;
    protected $current_index = 0;

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

        if(!empty($id)){
            $data_import = DataImport::find($id);
            $data_import->status = null;
            $data_import->keterangan = null;
            $data_import->current_row = 0;
        }

        if(empty($data_import) || $data_import->jenis != 'e-usulan-akun-rekening')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','e-usulan-akun-rekening')->first();
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
            if($index == 0) continue;
            try {
                DB::connection('eusulan')->beginTransaction();

                echo $index;

                $barang = new AkunRekening();
                $barang->kode = $item[0];
                $barang->nama = $item[1];
                $barang->status = $item[2];
                $barang->save();


                echo " -- Success";
                $data_import->current_row = $index;
                $data_import->save();
                DB::connection('eusulan')->commit();
            }
            catch (\Exception $e) {

                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan);

                DB::connection('eusulan')->rollBack();
            }
            echo "\n";
        }

        $data_import->status = 'done';
        $data_import->save();
    }

    private function dataImportUpdateKeterangan($keterangan)
    {
        $data_import = DataImport::find($this->current_data_import_id);
        $data_import->keterangan = $data_import->keterangan.$keterangan."\n";
        $data_import->save();
    }
}
