<?php

namespace App\Http\Controllers\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PasienPembayaranNew;
use App\Models\Pasien\PasienWali;
use App\Models\Pasien\AlamatKota;
use App\Models\Pasien\JenisPekerjaan;
use App\Models\Kasus\ICD10;
use DB;
use Carbon\Carbon;


//batas bawah >100
//batas atas <= 480000

//200000
//480000

class Import extends Controller
{
    public function pasien()
    {
        $pekerjaan = JenisPekerjaan::orderBy('id', 'ASC')->get();
        $file = fopen("dataset/new_pasien_57_58.csv","r");
        $pasiens = [];
        $pembayarans = [];
        $walis = [];
        $kota = AlamatKota::orderBy('id', 'ASC')->get();
        $kota = $kota->toArray();
        $id_pasien = 579961;

        DB::connection('patients')->beginTransaction();
        $pekerjaan = $pekerjaan->toArray();
        $now = Carbon::now()->toDateTimeString();
        while(!feof($file))
        {
            $id_pasien++;
            $data = fgetcsv($file,1000,"|");

            $pasien = new Pasien;
            $pasien->id = $id_pasien;
            $pasien->no_rm = $data[0];
            $pasien->name = $data[1];
            $pasien->no_identitas = $data[8];
            $pasien->jenis_kartu_identitas_id = $data[7];

            if (!empty($data[11]) && is_numeric($data[11])){
                $kota = AlamatKota::where('id', $data[11])->first();
                 if (!empty($kota)) {
                    $pasien->place_of_birth = $kota->name;
                 }else{
                    $pasien->place_of_birth = "";
                 }
            }else{
                $pasien->place_of_birth = "";
            }

            $pasien->date_of_birth = $data[12];
            $marriage = $data[13];
            if(empty($marriage) || $marriage == 0) $marriage = 1;
            $pasien->marriage = $marriage;

            if(!empty($data[15]) && is_numeric($data[15])) {
                $job= JenisPekerjaan::where('id', $data[15])->first();
                if(!empty($job)){
                    $pasien->job = $job->nama;
                }else{
                    $pasien->job = "";
                }
             }else{
                $pasien->job = "";
             }
            if($data[10] == 'L'){
                $pasien->gender = 1;
            }elseif ($data[10] == 'P') {
                $pasien->gender = 2;
            }else{
                $pasien->gender = 2;
            }
            $pasien->pendidikan_id = $data[16];
            $pasien->agama_id  =  $data[14];
            $pasien->address = $data[17];
            $pasien->city = $data[19];
            $pasien->tni_keanggotaan_id = $data[25];
            $pasien->district = $data[20];
            $pasien->phone = $data[24];
            $pasien->tni_pangkat_id = $data[26];
            $pasien->tni_nrp = $data[27];
            $pasien->tni_kotama_id = $data[28];
            $pasien->tni_satker_id = $data[29];  
            if(!(empty($data[26]) && empty($data[27]) && empty($data[28]) && empty($data[29]) && empty( $data[25]))){
                $pasien->is_anggota = 1; 
            }else{
                 $pasien->is_anggota = 0;
            }

            $pasien->created_at = $now;
            $pasien->updated_at = $now;
            $pasien->text_kerabat_nrp = $data[32];

            $wali = new PasienWali;
            $wali->name = $data[33];
            $wali->address = $data[34];
            $wali->phone = $data[35];
            $wali->birthdate = $data[42];


            $wali->tni_hubungan_type = $data[30];
            $wali->tni_nama = $data[31];
            $wali->tni_nrp = $data[36];
            $wali->tni_pangkat_id = $data[38];
            $wali->tni_nrp = $data[32];
            $wali->tni_kotama_id = $data[39];
            $wali->tni_satker_id = $data[40];   
            if(!(empty($data[38]) && empty($data[32]) && empty($data[39]) && empty($data[40]))){
                $wali->is_anggota = 1;
            }else{
                $wali->is_anggota = 0;
            }
            $wali->save();

            $pasien->relatives_id = $wali->id;
            if($data[41] ==0 || $data[41] == 1){
                $pasien->relatives_type = 1;
            }else if($data[41] == 3 || $data[41] ==4){
                $pasien->relatives_type = 2;
            }else if($data[41] == 2){
                $pasien->relatives_type = 3;
            }elseif ($data[41] == 5 || $data[41] == 6) {
                $pasien->relatives_type = 4;
            }elseif ($data[41] == 7 || $data[41] == 8) {
                $pasien->relatives_type = 5;
            }else{
                $pasien->relatives_type = 6;
            }


            $pembayaran = new PasienPembayaran;
            $pembayaran->pasien_id = $id_pasien;
            $pembayaran->jenis_pembayaran = 1;
            $pembayaran->no_asuransi = null;
            $pembayaran->perusahaan_id = 80;
            if($data[2] == 2){
                $pembayaran1 = new PasienPembayaran;
                $pembayaran1->pasien_id = $id_pasien;
                $pembayaran1->no_asuransi = $data[6];
                $pembayaran1->jenis_pembayaran = 6;
                $pembayaran1->perusahaan_id = $data[4];
                $pembayaran1->utama = 1;
                $pembayaran->utama = 0;

                $pembayarans[] = $pembayaran1->toArray();
            }else{
                $pembayaran->utama = 1;
            }



            // $pasien->text_alamat = app('App\Http\Controllers\Pasien\Pasien\EditController')->getPasienAlamat($pasien);
            // $pasien->text_asuransi = app('App\Http\Controllers\Pasien\Pasien\EditController')->getPasienAsuransi($pasien);
            // $pasien->text_kerabat_nrp = app('App\Http\Controllers\Pasien\Pasien\EditController')->getKerabatNRP($pasien);

            $pembayarans[] = $pembayaran->toArray();
            $walis[] = $wali->toArray();
            $pasien = $pasien->toArray();
            unset($pasien["alamat_kota"]); 
            unset($pasien["alamat_kecamatan"]); 
            unset($pasien["pembayaran"]); 
            $pasiens[] = $pasien;
        }

        foreach (array_chunk($pasiens,200) as $pas) {
            Pasien::insert($pas);
        }

        foreach (array_chunk($pembayarans,200) as $pem) {
            PasienPembayaran::insert($pem);
        }
        DB::connection('patients')->commit();
        fclose($file);
    }

    public function pembayaran()
    {
        $file = fopen("dataset/pasien_baru.csv","r");
        $i=1; $j=1;
        $pasiens = [];
        $pembayarans = [];
        $walis = [];
        while(!feof($file) && $i<=200000)
        {
            $data = fgetcsv($file, 0, "|");
            $pembayaran = PasienPembayaran::where('pasien_id', $i)->get();

            if($pembayaran[0]->jenis_pembayaran == 6){
                $pembayaran[0]->perusahaan_id = $data[4];
                $pembayarans[] = $pembayaran;  
            }
            $i++;
        }


        foreach (array_chunk($pembayarans,1000) as $pem) {
            DB::connection('patients')->beginTransaction();
            PasienPembayaran::insert($pem);
            DB::connection('patients')->commit();
        }
    }


    public function pembayaranNew()
    {
        $file = fopen("dataset/pasien_baru.csv","r");
        $i=400001; $j=1;
        $pasiens = [];
        $pembayarans = [];
        $walis = [];
        while(!feof($file))
        {
            $data = fgetcsv($file, 0, "|");

            $pembayaran = new PasienPembayaran;
            $pembayaran->pasien_id = $i;
            $pembayaran->jenis_pembayaran = 1;
            $pembayaran->no_asuransi = null;
            $pembayaran->perusahaan_id = 80;

            if($data[2] == 2){
                $pembayaran1 = new PasienPembayaran;
                $pembayaran1->pasien_id = $i;
                $pembayaran1->no_asuransi = $data[6];
                $pembayaran1->jenis_pembayaran = 6;
                $pembayaran1->perusahaan_id = $data[4];
                $pembayaran1->utama = 1;
                $pembayaran->utama = 0;

                $pembayarans[] = $pembayaran1->toArray();
            }else{
                $pembayaran->utama = 1;
            }

            $pembayarans[] = $pembayaran->toArray();
            $i++;
        }


        foreach (array_chunk($pembayarans,1000) as $pem) {
            DB::connection('patients')->beginTransaction();
            PasienPembayaran::insert($pem);
            DB::connection('patients')->commit();
        }
    }


    public function updateWali()
    {
        $pasien = Pasien::where('id', '>=', 2365)->get();
        foreach ($pasien as $key => $value) {
            $value->relatives_id = $value->id-7;
            $value->save();
        }

    }


    public function updateJenisKel()
    {
        $file = fopen("dataset/pasien_baru.csv","r");
        $i=1;
        $pasiens = [];
        // $pasien = Pasien::where('id', '>=', 2365)->get();
         while(!feof($file))
        {
            if($i<=480000){
                $data = fgetcsv($file,0, "|");
                $i++;
                continue;
            }else{
                echo $i."  ";
            }
            $data = fgetcsv($file,0, "|");
            $pasien = Pasien::where('no_rm', $data[0])->first();

             if (!empty($data[15])) {
                $pasien->job = JenisPekerjaan::where('id', $data[15])->first()->nama;
             }else{
                $pasien->job = "";
             }
            if($data[10] == 'L'){
                $pasien->gender = 1;
            }elseif ($data[10] == 'P') {
                $pasien->gender = 2;
            }
            $pasien->save();
        }
    }

    public function updateRelasi()
    {
          $file = fopen("dataset/pasien_baru.csv","r");
        $i=1;
        $pasiens = [];
        // $pasien = Pasien::where('id', '>=', 2365)->get();
         while(!feof($file))
        {
            if($i<=480000){
                $data = fgetcsv($file,0, "|");
                $i++;
                continue;
            }else{
                echo $i."  ";
            }
            $data = fgetcsv($file,0, "|");

            $pasien = Pasien::where('no_rm', $data[0])->first();

            
            $pasien->save();
        }
    }

    public function updateKelas()
    {

        $file = fopen("dataset/pasien_baru.csv","r");
        $i =1;
        $pasiens = [];
        $pembayarans = [];
        $walis = [];
        while(!feof($file))
        {
            $data = fgetcsv($file, 0,"|");
            if ($i<24399) {
                $i++;
                continue;
            }
            $pembayaran = PasienPembayaran::where('pasien_id', $i)->get();
            
            if($data[9] == 1){ //non
                $kelas=7;
            }elseif($data[9] == 2){ //1
                $kelas=1;
            }elseif($data[9] == 3){ //2
                $kelas=2;
            }elseif($data[9] == 4){ //3
                $kelas=3;
            }elseif($data[9] == 5){ //vip
                $kelas=4;
            }elseif($data[9] == 7){ //vvip
                $kelas=5;
            }elseif ($data[9] == 53) { //igd
                $kelas=6;
            }else{
                $kelas=7;
            }
            foreach ($pembayaran as $pem) {
                $pem->kelas_id = $kelas;
                $pem->save();
            }

            $i++;
        }

    }
}
