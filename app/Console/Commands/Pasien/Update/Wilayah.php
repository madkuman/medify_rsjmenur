<?php

namespace App\Console\Commands\Pasien\Update;

use Illuminate\Console\Command;
use DB;
use App\Models\Pasien\AlamatProvinsi;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKelurahan;
use App\Models\Pasien\AlamatKota;

class Wilayah extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pasien:update-wilayah-cahyadsn {start_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update data alamat berdasarkan https://github.com/cahyadsn/wilayah';

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
        $id = $arguments['start_id'];

        $query = "select * from wilayah_2020 where id >= ".$id;
        $data = DB::connection('patients')->select($query);

        foreach($data as $item)
        {
            $kode = explode(".", $item->kode);
            if(isset($kode[3])) $this->insertData('kelurahan',$kode,$item);
            elseif(isset($kode[2])) $this->insertData('kecamatan',$kode,$item);
            elseif(isset($kode[1])) $this->insertData('kota',$kode,$item);
            elseif(isset($kode[0])) $this->insertData('provinsi',$kode,$item);
        }
    }

    private function insertData($type,$kode_array,$item)
    {
        echo $type.'-';
        if($type == 'kelurahan'){
            $kode = $kode_array[0].'.'.$kode_array[1].'.'.$kode_array[2];
            $data = new AlamatKelurahan;
            $data->kecamatan_id = AlamatKecamatan::where('kode',$kode)->first()->id;
            $data->nama = $item->nama;
            $data->kode = $kode.'.'.$kode_array[3];
            $data->save();
            echo $item->nama."\n";
        }
        elseif($type == 'kecamatan'){
            $kode = $kode_array[0].'.'.$kode_array[1];
            $data = new AlamatKecamatan;
            $data->kota_id = AlamatKota::where('kode',$kode)->first()->id;
            $data->nama = $item->nama;
            $data->kode = $kode.'.'.$kode_array[2];
            $data->save();
            echo $item->nama."\n";
        }
        elseif($type == 'kota'){
            $kode = $kode_array[0];
            $data = new AlamatKota;
            $data->provinsi_id = AlamatProvinsi::where('kode',$kode)->first()->id;
            $data->nama = $item->nama;
            $data->kode = $kode.'.'.$kode_array[1];
            $data->save();
            echo $item->nama."\n";
        }
        elseif($type == 'provinsi'){
            $data = new AlamatProvinsi;
            $data->nama = $item->nama;
            $data->kode = $kode_array[0];
            $data->save();
            echo $item->nama."\n";
        }
    }
}
