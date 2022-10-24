<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Imports\DefaultImporter;
use App\Models\RawatJalan\Dokter;
use App\Models\RawatJalan\DokterJadwal;
use App\Models\RawatJalan\Poliklinik;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use File;

class DokterPoliklinikImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:dokter-poliklinik {id=0}';

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

        if(empty($data_import) || $data_import->jenis != 'dokter-poliklinik')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','dokter-poliklinik')->first();
        }

        $path = 'public/'.$data_import->file_path;

        echo "Reading File : ".$path."\n";

        $data = Excel::toArray(new DefaultImporter, $path)[0];
        $max_column = count($data[0])-1;

        $data_import->status = 'progress';
        $data_import->total_row = count($data)-1;
        $data_import->save();

        $this->current_data_import_id = $data_import->id;

        foreach($data as $index => $item)
        {
            if($index == 0) continue;
            try {
                DB::connection('rawatjalan')->beginTransaction();

                echo $index;

                $poliklinik = Poliklinik::where('name',$item[2])->first();
                if(empty($poliklinik->id))
                {
                    echo " -- Error";
                    $keterangan = 'INDEX : '.$index.' Tidak ditemukan poliklinik '. $item[2];
                    $this->dataImportUpdateKeterangan($keterangan,$data_import->id);
                    echo "\n";

                    continue;
                }

                $dokter = Dokter::where('name',$item[1])->first();
                if(empty($dokter->id))
                {
                    $dokter = new Dokter;
                    $dokter->name = $item[1];
                    $dokter->created_by = $data_import->created_by;
                    $dokter->save();
                }

                $jadwal = DokterJadwal::where('poliklinik_id',$poliklinik->id)->where('dokter_id',$dokter->id)->where('hari',$item[3])->where('jam_buka',$item[4])->where('jam_tutup',$item[5])->first();

                if(empty($jadwal->id))
                {
                    $jadwal = new DokterJadwal;
                    $jadwal->user_id = $dokter->user_id;
                    $jadwal->poliklinik_id = $poliklinik->id;
                    $jadwal->dokter_id = $dokter->id;
                    $jadwal->hari = $item[3];
                    $jadwal->hari_order = $this->getHariOrder($item[3]);
                    $jadwal->jam_buka = $item[4];
                    $jadwal->jam_buka = $item[5];
                    $jadwal->nama_dokter = $dokter->name;
                    $jadwal->nama_poli = $dokter->poli;
                    $jadwal->save();
                }

                echo " -- Success";
                $data_import->current_row = $index+1;
                $data_import->save();
                DB::connection('rawatjalan')->commit();
            }
            catch (\Exception $e) {

                echo " -- Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan,$data_import->id);

                DB::connection('rawatjalan')->rollBack();
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

    private function getHariOrder($hari)
    {
        if($hari == 'Senin') return 1;
        else if($hari == 'Selasa') return 2;
        else if($hari == 'Rabu') return 3;
        else if($hari == 'Kamis') return 4;
        else if($hari == 'Jumat') return 5;
        else if($hari == 'Sabtu') return 6;
        else if($hari == 'Minggu') return 7;
    }
}
