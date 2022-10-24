<?php

namespace App\Http\Controllers\Pasien\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\PasienPembayaran;
use App\Models\Pasien\PasienWali;
use Auth;

class EditController extends Controller
{
    	public function relatives($user, $target, $relation)
    	{
    		$pasien = Pasien::find($user);
    		$pasien->relatives_id = $target;
    		$pasien->relatives_type = $relation;
    		$pasien->save();
    	}

    	public function edit($human,$kerabat)
    	{
            // dd($human, $kerabat);
            try {

                $no_rm = $human['no_rm'];
                $id = $human['id'];
                $pasien = Pasien::where('no_rm',$no_rm)->where('id','!=',$id)->first();
                
                if(!empty($pasien->id))
                {
                    return array(
                        'pasien' => 'No RM telah digunakan',
                        'kerabat' => '',
                        'status' => 0
                    );
                }

                $pasien = Pasien::find($human['id']);
                $pasien->jenis_kartu_identitas_id = $human['jenis_kartu_identitas_id'];
                $pasien->no_identitas = $human['nomor_identitas'];
                $pasien->name = $human['name'];
                $pasien->gender = $human['gender'];
                $pasien->marriage = $human['marriage'];
                $pasien->address = $human['address'];
                $pasien->address_domisili = $human['address_domisili'];
                $pasien->city = $human['city'];
                $pasien->district = $human['district'];
                $pasien->kelurahan = $human['kelurahan'];
                $pasien->place_of_birth = $human['place_of_birth'];
                $pasien->date_of_birth = $human['date_of_birth'];
                $pasien->phone = $human['phone'];
                $pasien->job = $human['job'];
                $pasien->agama_id = $human['agama'];
                $pasien->pendidikan_id = $human['pendidikan'];
                $pasien->suku = $human['suku'];
                $pasien->alergi = $human['alergi'];
                $pasien->nama_ayah = $human['nama_ayah'];
                $pasien->nama_ibu = $human['nama_ibu'];
                $pasien->nama_suami = $human['nama_suami'];
                $pasien->nama_istri = $human['nama_istri'];
                $pasien->tni_nrp = $human['tni_nrp'];
                $pasien->tni_keanggotaan_id = $human['tni_keanggotaan_id'];
                $pasien->tni_pangkat_id = $human['tni_pangkat_id'];
                $pasien->tni_kotama_id = $human['tni_kotama_id'];
                $pasien->tni_satker_id = $human['tni_satker_id'];
                $pasien->tni_korps_id = $human['tni_korps_id'];
                $pasien->tni_jabatan = $human['tni_jabatan'];
                $pasien->tni_pangkat_singkat = $human['tni_pangkat_singkat'];
                $pasien->relatives_type = $human['relatives_type'];
                $pasien->is_anggota = $human['is_anggota'];
                if(!is_null($human['avatar'])){
                    $pasien->photo_ori = $human['avatar'];
                    $pasien->photo_thumb = $human['avatar_thumb'];
                }
                if(!is_null($human['file_ktp'])){
                    $pasien->photo_identity = $human['file_ktp'];
                    $pasien->photo_identity_thumb = $human['file_ktp_thumb'];
                }
                if(!is_null($human['file_kk'])){
                    $pasien->file_kk = $human['file_kk'];
                    $pasien->file_kk_thumb = $human['file_kk_thumb'];
                }
                if(!is_null($human['file_kartu_asuransi'])){
                    $pasien->file_kartu_asuransi = $human['file_kartu_asuransi'];
                    $pasien->file_kartu_asuransi_thumb = $human['file_kartu_asuransi_thumb'];
                }
                $pasien->updated_by = Auth::user()->id;
                $pasien->is_konfirmasi = $human['is_konfirmasi'];
                $pasien->save();

                // UPDATE ALL KASUS IDENTITAS
                $updateIdentitas = app('App\Http\Controllers\Kasus\Identitas\EditController')->updateFromPasien($pasien);

                $wali = PasienWali::find($kerabat['id']);
                if(empty($wali)){
                    $wali = new PasienWali;
                }
                $wali->name = $kerabat['name'];
                $wali->gender = $kerabat['gender'];
                $wali->address = $kerabat['address'];
                $wali->city = $kerabat['city'];
                $wali->district = $kerabat['district'];
                $wali->kelurahan = $kerabat['kelurahan'];
                $wali->phone = $kerabat['phone'];
                $wali->birthplace = $kerabat['birthplace'];
                $wali->birthdate = $kerabat['birthdate'];
                $wali->ktp = $kerabat['ktp'];

                $wali->is_anggota = $kerabat['is_anggota2'];
                $wali->tni_nama = $kerabat['tni_nama_kerabat'];
                $wali->tni_nrp = $kerabat['tni_nrp_kerabat'];
                $wali->tni_keanggotaan_id = $kerabat['tni_keanggotaan_kerabat'];
                $wali->tni_pangkat_id = $kerabat['tni_pangkat_kerabat'];
                $wali->tni_kotama_id = $kerabat['tni_kotama_kerabat'];
                $wali->tni_satker_id = $kerabat['tni_satker_kerabat'];
                $wali->tni_hubungan_type = $kerabat['tni_relative_kerabat'];
                $wali->created_by = Auth::user()->id;
                $wali->save();

                $indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($pasien->id);
            

                return array(
                    'pasien' => $pasien,
                    'kerabat' => $kerabat,
                    'status' => 1
                );
                
            } catch (Exception $e) {
                return array(
                    'pasien' => $e->getMessage(),
                    'kerabat' => $e->getMessage(),
                    'status' => 0
                );
            }
            /*
    		$edited_pasien = Pasien::find($pasien['id']);
    		$edited_pasien->name = $pasien['name'];
    		$edited_pasien->gender = $pasien['gender'];
    		$edited_pasien->marriage = $pasien['marriage'];
    		$edited_pasien->place_of_birth = $pasien['birthplace'];
    		$edited_pasien->date_of_birth = $pasien['birthdate'];
    		$edited_pasien->address = $pasien['address'];
    		$edited_pasien->city = $pasien['city'];
    		$edited_pasien->district = $pasien['district'];
    		$edited_pasien->phone = $pasien['phone'];
    		$edited_pasien->ktp = $pasien['ktp'];
    		$edited_pasien->type = $pasien['type'];
    		$edited_pasien->treatment_class = $pasien['class'];
    		$edited_pasien->job = $pasien['occupation'];
            //$edited_pasien->photo_ori = $pasien['avatar'];
            //$edited_pasien->photo_thumb = $pasien['avatar_thumb'];
    		$edited_pasien->save();*/

            /*
    		//apakah tipe asuransi
    		if($pasien['type'] == 1 or $pasien['type']==2)
    		{
    			$asuransi = app('App\Http\Controllers\Pasien\PasienAsuransi\EditController')
    			->edit($pasien);
    		}
    		else if($pasien['type'] == 3)
    		{
    			$kerjasama = app('App\Http\Controllers\Pasien\PasienPerusahaanKerjasama\EditController')
    			->edit($pasien);
    		}*/

    		
    	}

        public function updateRMTransaksiID($transaksi_id,$pasien_id)
        {
            $pasien = Pasien::find($pasien_id);
            $pasien->rm_transaksi_id = $transaksi_id;
            $pasien->save();
        }

        public function updatePasienMeninggal($pasien_id,$waktu_meninggal)
        {
            $pasien = Pasien::find($pasien_id);
            $pasien->death_at = $waktu_meninggal;
            $pasien->save();

            return $pasien;  
        }

        public function updatePasienBaru($pasien_id)
        {
            $pasien = Pasien::find($pasien_id);
            $pasien->is_baru = 0;
            $pasien->save();

            return $pasien;   
        }

        public function updateTextIndex($pasien_id)
        {
            $pasien = Pasien::find($pasien_id);
            $pasien->text_alamat = $this->getPasienAlamat($pasien);
            $pasien->text_kerabat_nrp = $this->getKerabatNRP($pasien);
            $pasien->text_asuransi = $this->getPasienAsuransi($pasien);
            $pasien->save();
            return 1;
        }

        public function getPasienAlamat($pasien)
        {
            $alamat = $pasien->address;

            $kota = $pasien->alamat_kota;
            if(!empty($kota)){
                $kota =  $kota->name;
            }else{
                $kota = null;
            }

            $kec = $pasien->alamat_kecamatan;
            if(!empty($kec)){
                $kec = $kec->name;
            }else{
                $kec = null;
            }

            $alamat.= ' '.$kec.' , '.$kota;
            return $alamat;
        }

        public function getKerabatNRP($pasien)
        {
            $wali = $pasien->wali;
            if(empty($wali) || empty($wali->tni_nrp)) $wali_nrp = null;
            else $wali_nrp = $pasien->wali->tni_nrp;

            return $wali_nrp;
        }

        public function getPasienAsuransi($pasien)
        {
            $text = '';
            $pembayaran = $pasien->pembayaran;
            foreach($pembayaran as $item)
            {
                $text.= $item->perusahaan->nama;
                $text.= ' - ';
                $text.= $item->no_asuransi;
                $text.= ' , ';
            }

            return $text;
        }

        public function adminUpdateIndex($min,$max)
        {
            $pasien = Pasien::whereBetween('id',[$min,$max])->get();
            foreach($pasien as $item)
            {
                $indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($item->id);
            }
            return json_encode(['status' => 200]);
        }

        public function setPembayaranUtama(Request $request)
        {
            $metode = PasienPembayaran::where('pasien_id', $request->pasien_id)->get();
            foreach ($metode as $m) {
                $m->utama = $m->id == $request->bayar_id ? 1 : 0;
                $m->save();
            }

            return 1;
        }
    }
