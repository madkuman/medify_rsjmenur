<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TarifKategoriImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:tarif-kategori {id=0}';

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

        if(empty($data_import) || $data_import->jenis != 'tarif-kategori')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','tarif-kategori')->first();
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

                $tarif_kategori = new TarifKategori;
                if(!empty($item[0]) || $item[0] != '-')
                    $tarif_kategori->slug = $item[0];

                $current_column = 1;
                $nama = '';
                while(empty($nama))
                {
                    $nama = $item[$current_column++];
                }
                $current_column--;

                $tarif_kategori->nama = $nama;
                $tarif_kategori->parent_id = $last_id[$current_column-1];
                $tarif_kategori->save();

                if($current_column != $last_column) {
                    $last_id[$current_column] = $tarif_kategori->id;
                    $last_column = $current_column;
                }

                echo " -- Success";
                $data_import->current_row = $index;
                $data_import->save();
                DB::connection('keuangan')->commit();
            }
            catch (\Exception $e) {

                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan);

                DB::connection('keuangan')->rollBack();
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
