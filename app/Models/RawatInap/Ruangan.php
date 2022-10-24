<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;



class Ruangan extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $connection = 'rawatinap';
	protected $table = 'ruangan';

	public function bed()
	{
		return $this->hasMany('App\Models\RawatInap\TempatTidur', 'ruangan_id', 'id');
	}
	public function bed_statistic()
	{
		return $this->hasMany('App\Models\RawatInap\TempatTidur', 'ruangan_id', 'id')->where('is_hitung_statistik', 1);
	}
	public function bangsal()
	{
		return $this->hasOne('App\Models\RawatInap\Bangsal', 'id', 'bangsal_id')->withTrashed();
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}

	public function kelas_ruang()
	{
		return $this->hasOne('App\Models\Hospital\Kelas', 'id', 'kelas');
	}

	public function tarif_lain()
	{
		return $this->hasMany('App\Models\RawatInap\TarifLain', 'ruangan_id', 'id');
	}
	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_id');
	}

	public function count_empty()
	{
		return $this->hasOne('App\Models\RawatInap\TempatTidur', 'ruangan_id', 'id')
			->whereNull('booking_id')
			->whereNull('transaksi_id')
			->selectRaw('ruangan_id, count(1) as aggregate')
			->groupBy('ruangan_id');
	}
	public function getCountEmptyAttribute()
	{

		// if relation is not loaded already, let's do it first
		if (!array_key_exists('count_empty', $this->relations))
			$this->load('count_empty');

		$related = $this->getRelation('count_empty');
		// then return the count directly
		return ($related) ? $related->aggregate : 0;
	}

	public function count_bed()
	{
		return $this->hasOne('App\Models\RawatInap\TempatTidur', 'ruangan_id', 'id')
			->selectRaw('ruangan_id, count(1) as aggregate')
			->groupBy('ruangan_id');
	}
	public function getCountBedAttribute()
	{

		// if relation is not loaded already, let's do it first
		if (!array_key_exists('count_bed', $this->relations))
			$this->load('count_bed');

		$related = $this->getRelation('count_bed');
		// then return the count directly
		return ($related) ? $related->aggregate : 0;
	}

	public function kode_applicare()
	{
		return $this->hasOne('App\Models\RawatInap\Bangsal', 'id', 'bangsal_id');
	}

	public function getKodeApplicareAttribute()
	{

		// if relation is not loaded already, let's do it first
		if (!array_key_exists('kode_applicare', $this->relations))
			$this->load('kode_applicare');

		$related = $this->getRelation('kode_applicare');
		// then return the count directly
		return ($related) ? $related->id . "-" . $this->id : "";
	}

	public function getNamaApplicareAttribute()
	{

		// if relation is not loaded already, let's do it first
		if (!array_key_exists('nama_applicare', $this->relations))
			$this->load('nama_applicare');

		$related = $this->getRelation('nama_applicare');
		// then return the count directly
		return ($related) ? $related->nama . " - " . $this->nama : "";
	}

	public function nama_applicare()
	{
		return $this->hasOne('App\Models\RawatInap\Bangsal', 'id', 'bangsal_id');
	}
}
