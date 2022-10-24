<?php

namespace App\Http\Controllers\Pasien\Pasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\Pasien;
use App\Models\Pasien\AsalRujukan;
use Auth;
use DB;

class CreateController extends Controller
{
	public function create($human)
	{	
		$kategori_pasien = $human['kategori_pasien'] ?? 0;
		$getMaxPasien = Pasien::where('kategori_pasien', intval($kategori_pasien))->max('id');
		$countPasien = $getMaxPasien + 1;
		$nomor_rm = str_pad($countPasien, 5, "0", STR_PAD_LEFT);
		$rm_jiwa = $kategori_pasien.''.$nomor_rm;

		//DB::connection('patients')->beginTransaction();
		try{
			$pasien = new Pasien;
			$pasien->id = $countPasien;
			$pasien->no_rm = $kategori_pasien == 5 ? $countPasien : $rm_jiwa;
			$pasien->jenis_kartu_identitas_id = $human['jenis_kartu_identitas_id'];
			$pasien->no_identitas = $human['nomor_identitas'];
			$pasien->kategori_pasien = $human['kategori_pasien'];
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
			$pasien->tni_pangkat_singkat = $human['tni_pangkat_singkat'];
			$pasien->is_anggota = $human['is_anggota'];

			if(isset($human['parent_id'])){
				$pasien->parent_id = $human['parent_id'];
			}

			if($human['is_anggota'] == 1)
			{
				$pasien->tni_nrp = $human['tni_nrp'];
				$pasien->tni_keanggotaan_id = $human['tni_keanggotaan_id'];
				$pasien->tni_pangkat_id = $human['tni_pangkat_id'];
				$pasien->tni_kotama_id = $human['tni_kotama_id'];
				$pasien->tni_satker_id = $human['tni_satker_id'];
				$pasien->tni_korps_id = $human['tni_korps_id'];
				$pasien->tni_jabatan = $human['tni_jabatan'];
			}

			$pasien->photo_ori = $human['avatar'];
			$pasien->photo_thumb = $human['avatar_thumb'];
            $pasien->photo_identity = $human['file_ktp'] ?? null;
            $pasien->photo_identity_thumb = $human['file_ktp_thumb'] ?? null;
            $pasien->file_kk = $human['file_kk'] ?? null;
            $pasien->file_kk_thumb = $human['file_kk_thumb'] ?? null;
            $pasien->file_kartu_asuransi = $human['file_kartu_asuransi'] ?? null;
            $pasien->file_kartu_asuransi_thumb = $human['file_kartu_asuransi_thumb'] ?? null;

			if(!empty(Auth::user()))
				$pasien->created_by = Auth::user()->id;
			else
				$pasien->created_by = 1;
			$pasien->is_jkn = $human['is_jkn'] ?? 0;
			$pasien->is_baru = 1;

			$pasien->save();

			$indexElastic = app('App\Http\Controllers\Pasien\Pasien\EditController')->updateTextIndex($pasien->id);

			//DB::connection('patients')->commit();
			
			return array(
				'pasien' => $pasien,
				'status' => 1
			);
		}
		catch (\Exception $e) {
		    app('App\Http\Controllers\Error\Handler')->bugsnag($e);
		}
	}

	public function APIAsalRujukan(Request $request)
	{
		//dd($request->nama_rujukan);
	 	DB::connection('patients')->beginTransaction();
	 	try
	 	{	
	 		//dd($request->nama_rujukan);
	 		$rujukan = new AsalRujukan;
			$rujukan->nama = $request->nama_rujukan;
			$rujukan->alamat = null;
			$rujukan->no_telp = null;
			$rujukan->tipe = null;
			$rujukan->self = 0;
			$rujukan->save();
			//dd($rujukan);
			$rujukan->kode = "MED".$rujukan->id."";
			$rujukan->save();
			//dd($rujukan);
			DB::connection('patients')->commit();
			//$rujukan_return = json_decode((json_encode($rujukan)));
			//dd($rujukan_return);
			return $rujukan;	
	 	}
	 	catch(\Exception $e)
	 	{	
	 		DB::connection('patients')->rollBack();
	 		dd($e);
	 	}	
	}
}
