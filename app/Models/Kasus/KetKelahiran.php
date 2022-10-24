<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Carbon\Carbon;
class KetKelahiran extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'alat_keterangan_kelahiran';

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function dokter()
	{
		return $this->hasOne('App\User','id','dokter_id');
	}

	public function perawat()
	{
		return $this->hasOne('App\User','id','perawat_id');
	}

	public function getTanggalTextAttribute()
	{
		return Carbon::parse($this->tanggal)->format('d M Y');
	}

	public function getTanggalPasturTextAttribute()
	{
		return Carbon::parse($this->tanggal_pastur)->format('d M Y');
	}

	public function getKelaminTextAttribute()
	{
		if($this->kelamin == 1)
        {
            return 'Laki - Laki';
        }
        else
        {
            return 'Perempuan';
        }
	}
}
