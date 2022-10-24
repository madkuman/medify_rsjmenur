<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;


class FarmasiMasterObatImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:farmasi-master-obat {id=0}';

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

        
        if(!empty($id)){
            $data_import = DataImport::find($id);
            $data_import->status = null;
            $data_import->keterangan = null;
            $data_import->current_row = 0;
        }

        if(empty($data_import) || $data_import->jenis != 'farmasi-master-obat')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','farmasi-master-obat')->first();
        }

        $path = 'public/'.$data_import->file_path;

        echo "Reading File : ".$path."\n";

        $data = Excel::toArray(new DefaultImporter, $path)[0];
        $max_column = count($data[0])-1;

        $data_import->status = 'progress';
        $data_import->total_row = count($data)-1;
        $data_import->save();

        $this->current_data_import_id = $data_import->id;

        Auth::loginUsingId($data_import->created_by);

        foreach($data as $index => $item)
        {
            if($index == 0) continue;
            try {
                DB::connection('farmasi')->beginTransaction();

                echo $index;

                $item_template = ItemsTemplate::where('nama',$item[1])->first();
                if(empty($item_template->id))
                {
                    echo " -- Creating Item";

                    $data = new \Illuminate\Http\Request();
                    $data->replace([
                        'nama' => $item[1],
                        'jenis' => $item[2],
                        'satuan' => $item[3],
                        'harga' => $item[4],
                        'batasan_kadaluarsa' => $item[5],
                        'batasan_stok' => $item[6],
                    ]);

                    $items_farmasi = app('App\Http\Controllers\Farmasi\Items\CreateController')->createAPI($data,1);

                    $kategori = $item[7] ?? '';
                    $kandungan = $item[8] ?? '';

                    $kategori = explode(",", $kategori);
                    $kandungan = explode(",", $kandungan);

                    if($kategori[0] != '')
                    {
                        echo " -- ".count($kategori).' Kategori';
                        foreach($kategori as $item)
                        {
                            $item = ltrim($item);
                            $item = rtrim($item);
                            $new_kategori = app('App\Http\Controllers\Farmasi\Kategori\CreateController')->createByName($item,0);

                            $gori = new ItemsKategori;
                            $gori->kategori_id = $new_kategori->id;
                            $gori->item_template_id = $items_farmasi->id;                
                            $gori->save();
                        }
                    }
                    if($kandungan[0] != '')
                    {
                        echo " -- ".count($kandungan).' Kandungan';
                        foreach($kandungan as $item)
                        {
                            $new_kategori = app('App\Http\Controllers\Farmasi\Kategori\CreateController')->createByName($item,1);

                            $gori = new ItemsKategori;
                            $gori->kategori_id = $new_kategori->id;
                            $gori->item_template_id = $items_farmasi->id;                
                            $gori->save();
                        }
                    }
                }
                else
                {
                    echo " -- Duplicated Item";
                    $keterangan = 'INDEX : '.$index.' Duplicated Item '. $item[1];
                    $this->dataImportUpdateKeterangan($keterangan,$data_import->id);
                }
                $data_import->current_row = $index+1;
                $data_import->save();
                echo " -- Success";
                DB::connection('farmasi')->commit();
            }
            catch (\Exception $e) {

                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan,$data_import->id);

                DB::connection('farmasi')->rollBack();
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
        return 1;
    }
}
