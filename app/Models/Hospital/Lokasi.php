<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Lokasi extends Model
{
	use DataLogger;
	protected $connection = 'mysql';
	protected $table = 'lokasi';
	use SoftDeletes;

	public function departemen(){
		return $this->hasOne('App\Models\Hospital\LokasiDepartemen', 'id', 'lokasi_departemen_id');
	}

	public function kategori_keuangan(){
		return $this->hasOne('App\Models\Keuangan\Kategori', 'id', 'kategori_keuangan_id');
	}

	public function ruangan()
	{
		return $this->hasOne('App\Models\RawatInap\Ruangan','lokasi_id','id')->withTrashed();
	}

	public function poliklinik()
	{
		return $this->hasOne('App\Models\RawatJalan\Poliklinik','lokasi_id','id');
	}

	public function lokasi()
	{
		return $this->hasMany('App\Models\Kasus\Lokasi', 'lokasi_id');
	}
	
	public function zona_ppi_detail()
	{
		return $this->hasOne('App\Models\Hospital\LokasiZonaPPI','id','zona_ppi_id');
	}

	public function kategori_bpjs(){
		return $this->hasOne('App\Models\Keuangan\KategoriBPJS', 'id', 'kategori_bpjs_id');
	}

}