<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PasienWali extends Model
{
	use DataLogger;
	protected $connection = 'patients';
	protected $table = 'pasien_wali';
 
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'id', 'pasien_id');
	}

    	public function alamat_kota()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKota', 'id', 'city');
	}

	public function alamat_kecamatan()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKecamatan', 'id', 'district');
	}

	public function alamat_kelurahan()
	{
		return $this->hasOne('App\Models\Pasien\AlamatKelurahan', 'id', 'kelurahan');
	}

	public function wali()
	{
		return $this->hasOne('App\Models\Pasien\Pasien', 'relatives_id', 'id');
	}
	
	public function jk()
	{
		return $this->hasOne('App\Models\Pasien\JenisKelamin', 'id','gender');
	}

	public function getAgeAttribute()
	{
		return Carbon::parse($this->attributes['birthdate'])->age;
	}

	public function getJenisKelaminAttribute()
	{
		if($this->gender == 1)
			return 'Laki laki';
		else
			return 'Perempuan';
	}
	
	public function tni_keanggotaan()
	{
		return $this->hasOne('App\Models\Pasien\TNIKeanggotaan', 'id', 'tni_keanggotaan_id');
	}

	public function tni_kotama()
	{
		return $this->hasOne('App\Models\Pasien\TNIKotama', 'id', 'tni_kotama_id');
	}

	public function tni_pangkat()
	{
		return $this->hasOne('App\Models\Pasien\TNIPangkat', 'id', 'tni_pangkat_id');
	}

	public function tni_satker()
	{
		return $this->hasOne('App\Models\Pasien\TNISatker', 'id', 'tni_satker_id');
	}

	public function tni_hubungan()
	{
		return $this->hasOne('App\Models\Pasien\JenisHubunganKeluarga', 'id', 'tni_hubungan_type');
	}
}
