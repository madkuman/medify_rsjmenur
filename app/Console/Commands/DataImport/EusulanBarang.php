<?php

namespace App\Console\Commands\DataImport;

use App\Models\Eusulan\AkunBarang;
use App\Models\Eusulan\AkunRekening;
use App\Models\Eusulan\Barang;
use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\Keuangan\TarifKategori;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class EusulanBarang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:e-usulan-barang {id=0}';

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

        if(empty($data_import) || $data_import->jenis != 'e-usulan-barang')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','e-usulan-barang')->first();
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
                $temp_barang = Barang::where('nama',$item[1])->first();
                $temp_akun_rekening = AkunRekening::where('nama',$item[6])->first();
                if(!is_null($temp_barang) && !is_null($temp_akun_rekening)){
                    $akun_barang = AkunBarang::where('barang_id',$temp_barang->id)->where('akun_rekening_id',$temp_akun_rekening->id)->first();
                    if($akun_barang){
                        $barang = $temp_barang;
                        $akun_rekening = $temp_akun_rekening;
                    }else{
                        $barang = $temp_barang;
                        $akun_rekening = $temp_akun_rekening;
                        $akun_barang = new AkunBarang();
                        $akun_barang->akun_rekening_id = $akun_rekening->id;
                        $akun_barang->barang_id = $barang->id;
                        $akun_barang->save();
                    }
                }else{
                    if(is_null($temp_barang)){
                        $barang = new Barang();
                    }else{
                        $barang = $temp_barang;
                    }

                    if(is_null($temp_akun_rekening)){
                        $akun_rekening = new AkunRekening();
                    }else{
                        $akun_rekening = $temp_akun_rekening;
                    }
                }
                $barang->kode = $item[0];
                $barang->nama = $item[1];
                $barang->tipe = $item[2];
                $barang->kelompok = $item[3];
                $barang->harga = $item[4];
                $barang->satuan = $item[5];
                $barang->save();
                $akun_rekening->kode = $item[7];
                $akun_rekening->nama = $item[6];
                $akun_rekening->status = 'Ya';
                $akun_rekening->save();

                $temp_akun_barang = AkunBarang::where('barang_id',$barang->id)->where('akun_rekening_id',$akun_rekening->id)->first();
                if(is_null($temp_akun_barang)) {
                    $akun_barang = new AkunBarang();
                    $akun_barang->akun_rekening_id = $akun_rekening->id;
                    $akun_barang->barang_id = $barang->id;
                    $akun_barang->save();
                }
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
