<?php

namespace App\Console\Commands\DataImport;

use Illuminate\Console\Command;
use App\Models\Hospital\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DefaultImporter;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienWali;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Hospital\Kelas;
use DB;
use App\Models\Pasien\AlamatKecamatan;
use App\Models\Pasien\AlamatKelurahan;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\JenisAgama;
use App\Models\Pasien\JenisHubunganKeluarga;
use App\Models\Pasien\JenisKartuIdentitas;
use App\Models\Pasien\JenisKelamin;
use App\Models\Pasien\JenisPasien;
use App\Models\Pasien\JenisPekerjaan;
use App\Models\Pasien\JenisPendidikan;
use App\Models\Pasien\JenisPernikahan;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;
use App\Models\Pasien\TNIKeanggotaan;
use App\Models\Pasien\TNIKorps;
use App\Models\Pasien\TNIKotama;
use App\Models\Pasien\TNIPangkat;
use App\Models\Pasien\TNISatker;
use Carbon\Carbon;

class PasienImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-import:pasien {id=0}';

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
    protected $perusahaan_tunai_id = 0;

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


       
        $tipe = PembayaranPerusahaanType::where('slug','tunai')->first()->id;
        $this->perusahaan_tunai_id  = PembayaranPerusahaan::where('type',$tipe)->first()->id;


        if(!empty($id)){
             $data_import = DataImport::find($id);
             $data_import->status = null;
             $data_import->keterangan = null;
             $data_import->current_row = 0;
        }

        if(empty($data_import) || $data_import->jenis != 'pasien')
        {
            $data_import = DataImport::whereNull('status')->where('jenis','pasien')->first();
        }

        $path = 'public/'.$data_import->file_path;

        echo "Reading File : ".$path."\n";

        $data = Excel::toArray(new DefaultImporter, $path)[0];
        $max_column = count($data[0])-1;

        $data_import->status = 'progress';
        $data_import->total_row = count($data);
        $data_import->save();

        $this->current_data_import_id = $data_import->id;

        foreach($data as $index => $item)
        {
            $this->current_index = $index;
            if($index == 0) continue;
            echo "Start ".$index;
            try {
                DB::connection('patients')->beginTransaction();
                $data_import->current_row = $index;
                $data_import->save();
                $method = 'update';
                if(!empty($item[1])) {
                    $pasien = Pasien::where('no_rm',$item[1])->first();
                    if(empty($pasien->id)) {
                        $pasien = new Pasien;
                        $pasien->id = $item[1];
                        $method = 'create';
                    }
                    else
                    {
                        //TURN OFF THIS LINE IF WANT TO UPDATE DATA
                        echo ' - update';
                        DB::connection('patients')->commit();
                        echo "\n";
                        continue;
                    }
                }
                else {
                    $pasien = new Pasien;
                    $method = 'create';
                }
                $date_1990 = new Carbon('first day of January 1900');
                $pasien->no_rm = $item[1];
                $pasien->name = $item[2];
                $pasien->gender = $this->getGender($item[3],$index);
                $pasien->jenis_kartu_identitas_id = $this->getJenisKartuIdentitas($item[4]);
                $pasien->no_identitas = $item[5];
                $pasien->marriage = $this->getMasterPernikahan($item[6]);
                $pasien->place_of_birth = $item[7];
                if(!empty($item[8])){
                    $item[8] = (int) $item[8];
                    $pasien->date_of_birth = $date_1990->addDays($item[8]-1)->format('Y-m-d');
                } 
                else $pasien->date_of_birth = NULL;
                $pasien->address = $item[9];

                $data_wilayah = $this->getMasterAlamatKelurahanAll($item[12]);
                if(!empty($data_wilayah))
                {
                    $pasien->city = $data_wilayah['kota'];
                    $pasien->district = $data_wilayah['kecamatan'];
                    $pasien->kelurahan = $data_wilayah['kelurahan'];
                }
                else
                {
                    $data_wilayah = $this->getMasterAlamatKecamatanAll($item[11]);
                    if(!empty($data_wilayah))
                    {
                        $pasien->city = $data_wilayah['kota'];
                        $pasien->district = $data_wilayah['kecamatan'];
                        $pasien->kelurahan = $this->getMasterAlamatKelurahan($item[12],$pasien->district);
                    }
                    else
                    {
                        $pasien->city = $this->getMasterAlamatKota($item[10]);
                        $pasien->district = $this->getMasterAlamatKecamatan($item[11],$pasien->city);
                        $pasien->kelurahan = $this->getMasterAlamatKelurahan($item[12],$pasien->district);
                    }
                }

                $pasien->phone = $item[13];
                $pasien->job = $item[14];
                $pasien->agama_id = $this->getMasterAgama($item[15]);
                $pasien->pendidikan_id = $this->getMasterPendidikan($item[16]);
                //$pasien->bahasa = $item[17]; kelupaan gaada di master menur juga
                $pasien->suku = $item[17];
                $pasien->tni_nrp = $item[18];
                $pasien->tni_keanggotaan_id = $this->getMasterTNIKeanggotaan($item[19]);
                $pasien->tni_pangkat_id = $this->getMasterTNIPangkat($item[20]);
                $pasien->tni_kotama_id = $this->getMasterTNIKotama($item[21]);
                $pasien->tni_satker_id = $this->getMasterTNISatker($item[22]);
                $pasien->tni_korps_id = $this->getMasterTNIKorps($item[23],$pasien->tni_keanggotaan_id);
                $pasien->tni_jabatan = $item[24];
                $pasien->nama_ayah = $item[25];
                $pasien->nama_ibu = $item[24];
                $pasien->nama_istri = $item[26];
                $pasien->nama_suami = $item[27];
                $pasien->relatives_type = $this->getMasterHubunganKerabat($item[33]);
                $pasien->save();

                $indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($pasien->id);


                if(!empty($pasien->relatives_id)) $wali = PasienWali::find($pasien->relatives_id);
                else $wali = new PasienWali;

                $wali->name = $item[29];
                $wali->gender = $this->getGender($item[30]);
                $wali->address = $item[31];
                $wali->phone = $item[32];
                $wali->save();

                $pasien->relatives_id = $wali->id;
                $pasien->save();

                if($method == 'create'){
                    $pasien->save();
                }

                $current = 34;
                $utama = 1;
                while($current <= $max_column)
                {
                    $perusahaan_id = $this->getMasterPerusahaan($item[$current++]);
                    $no_asuransi = $item[$current++];
                    $kelas = $this->getMasterKelas($item[$current++]);

                    if(!empty($perusahaan_id))
                    {
                        /*
                        1. Jika pasien update, maka akan dicari dulu pembayaran dia yang lama ada apa nggak
                        2. Jika ada maka di update
                        3. JIka tidak maka akan diinsert baru
                        */

                        if($method == 'update'){
                            $pasien_pembayaran = PasienPembayaran::where('perusahaan_id',$perusahaan_id)->where('pasien_id',$pasien->id)->first();

                            if(!empty($pasien_pembayaran)) 
                                $pasien_pembayaran_id = $pasien_pembayaran->id;
                            else
                                $pasien_pembayaran_id = null;
                        }

                        if(!empty($pasien_pembayaran_id)){
                            $pasienPembayaran = array(
                                'bayar_id' => $pasien_pembayaran_id,
                                'pasien_id' => $pasien->id,
                                'perusahaan_id' => $perusahaan_id,
                                'utama' => $utama,
                                'kelas_id' => $kelas,
                                'no_asuransi' => $no_asuransi,
                            );

                            $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\EditController')->edit($pasienPembayaran);
                        }
                        else
                        {
                            $pasienPembayaran = array(
                                'pasien_id' => $pasien->id,
                                'perusahaan_id' => $perusahaan_id,
                                'utama' => $utama,
                                'kelas_id' => $kelas,
                                'no_asuransi' => $no_asuransi,
                            );
                            $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\CreateController')->create($pasienPembayaran);
                        }


                        $utama = 0;
                    }
                }

                $this->checkIfPasienHasPembayaranTunai($pasien->id);

                echo " Success";
                DB::connection('patients')->commit();
            }
            catch (\Exception $e) {
                dd($e);
                echo " Error";
                $keterangan = 'INDEX : '.$index.' Error '.$e->getMessage();
                $this->dataImportUpdateKeterangan($keterangan);

                DB::connection('patients')->rollBack();
            }

            echo " Done : PASIEN ".$pasien->id."\n";
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

    public function getGender($item)
    {
        $data = JenisKelamin::where('kode',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Jenis Kelamin "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return 1;
        }
        else return $data->id;
    }

    public function getJenisKartuIdentitas($item)
    {
        $data = JenisKartuIdentitas::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Jenis Kartu Identitas "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);

            $jenis = new JenisKartuIdentitas;
            $jenis->nama = $item;
            $jenis->save();

            return $jenis->id;
        }
        else return $data->id;
    }

    public function getMasterPernikahan($item)
    {
        $data = JenisPernikahan::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Jenis Pernikahan "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);

            $jenis = new JenisPernikahan;
            $jenis->nama = $item;
            $jenis->save();

            return $jenis->id;
        }
        else return $data->id;
    }

    public function getMasterAlamatKelurahanAll($item)
    {
        $kelurahan = AlamatKelurahan::where('nama',$item)->with('kecamatan.kota')->get();
        if(count($kelurahan) == 1)
        {
            $data['kelurahan'] = $kelurahan[0]->id;
            $data['kecamatan'] = $kelurahan[0]->kecamatan->id;
            $data['kota'] = $kelurahan[0]->kecamatan->kota->id;
            return $data;
        }
        else
            return null;
    }

    public function getMasterAlamatKecamatanAll($item)
    {
        $kecamatan = AlamatKecamatan::where('nama',$item)->with('kota')->get();
        if(count($kecamatan) == 1)
        {
            $data['kecamatan'] = $kecamatan[0]->id;
            $data['kota'] = $kecamatan[0]->kota->id;
            return $data;
        }
        else
            return null;
    }

    public function getMasterAlamatKota($item)
    {
        if(strpos($item, 'KOTA') !== false){
            $item_kab = $item;
        } else{
            $item_kab = 'KAB. '.$item;
            $item_kab2 = 'KABUPATEN '.$item;
        }

        $data = AlamatKota::where('nama',$item)->orWhere('nama',$item_kab)->orWhere('nama',$item_kab2)->first();
        if(empty($data)){
            $item_kota = 'KOTA '.$item;
            $data = AlamatKota::where('nama',$item_kota)->first();
        }
        

        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Alamat Kota "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterAlamatKecamatan($item,$kota_id)
    {
        $data = AlamatKecamatan::where('nama',$item)->where('kota_id',$kota_id)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Alamat Kecamatan "'.$item.'" -- "'.$kota_id.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterAlamatKelurahan($item,$kecamatan_id)
    {
        $data = AlamatKelurahan::where('nama',$item)->where('kecamatan_id',$kecamatan_id)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Alamat Kelurahan "'.$item.'" -- "'.$kecamatan_id.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterAgama($item)
    {
        $data = JenisAgama::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Jenis Agama "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            
            $jenis = new JenisAgama;
            $jenis->nama = $item;
            $jenis->save();

            return $jenis->id;
        }
        else return $data->id;
    }

    public function getMasterPendidikan($item)
    {
        $data = JenisPendidikan::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Jenis Pendidikan "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            
            $jenis = new JenisPendidikan;
            $jenis->nama = $item;
            $jenis->save();

            return $jenis->id;
        }
        else return $data->id;
    }

    public function getMasterTNIKeanggotaan($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = TNIKeanggotaan::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error TNIKeanggotaan "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterTNIPangkat($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = TNIPangkat::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error TNIPangkat "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterTNIKotama($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = TNIKotama::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error TNIKotama "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterTNISatker($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = TNISatker::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error TNISatker "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterTNIKorps($item,$tni_keanggotaan_id)
    {
        if(empty($item) || $item == '-') return null;
        $data = TNIKorps::where('nama',$item)->where('tni_keanggotaan_id',$tni_keanggotaan_id)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error TNIKorps "'.$item.'" -- "'.$tni_keanggotaan_id.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return null;
        }
        else return $data->id;
    }

    public function getMasterHubunganKerabat($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = JenisHubunganKeluarga::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Hubungan Keluarga "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            
            $jenis = new JenisHubunganKeluarga;
            $jenis->nama = $item;
            $jenis->save();

            return $jenis->id;
        }
        else return $data->id;
    }


    public function getMasterPerusahaan($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = PembayaranPerusahaan::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Pembayaran Perusahaan "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            
            $jenis = new PembayaranPerusahaan;
            $jenis->nama = $item;
            $jenis->type = 3;
            $jenis->save();
        }
        else return $data->id;
    }


    public function getMasterKelas($item)
    {
        if(empty($item) || $item == '-') return null;
        $data = Kelas::where('nama',$item)->first();
        if(empty($data)){
            $keterangan = 'INDEX : '.$this->current_index.' Error Kelas "'.$item.'" Tidak Ditemukan';
            $this->dataImportUpdateKeterangan($keterangan);
            return 3;
        }
        else return $data->id;
    }

    public function checkIfPasienHasPembayaranTunai($pasien_id)
    {   
        $pembayaran = PasienPembayaran::where('perusahaan_id',$this->perusahaan_tunai_id)->where('pasien_id',$pasien_id)->get();
        if(count($pembayaran) == 0)
        {
            $pasienPembayaran = array(
                'pasien_id' => $pasien_id,
                'perusahaan_id' => $this->perusahaan_tunai_id,
                'utama' => 0,
                'kelas_id' => 1,
                'no_asuransi' => null,
            );

            $pembayaran = app('App\Http\Controllers\Pasien\PasienPembayaran\CreateController')->create($pasienPembayaran);
        }
    }


}
