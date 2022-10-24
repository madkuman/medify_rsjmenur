<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Poliklinik extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'rawatjalan';
	protected $table = 'poliklinik';
	protected $dates = ['deleted_at'];
	protected $appends = ['total_antrian'];

	public function transaksi() {
		return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}

	public function last_antrian() {
		return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id');
	}

	public function antrian_tunggu() {
		return $this->hasMany('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id')
		->where('status', 0)
		->whereDate('ordered_at', '=', Carbon::today()->toDateString());
	}
	
	public function getTotalAntrianAttribute()
    {
      return $this->antrian_tunggu->count();
    }

	public function jadwal()
	{
		return $this->hasMany('App\Models\RawatJalan\DokterJadwal', 'poliklinik_id', 'id');
	}

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}

	public function unit_tindakan()
	{
		return $this->hasMany('App\Models\UnitTindakan\UnitTindakan', 'poli_id', 'id');
	}

	public function antrian_terakhir()
	{
		return $this->hasOne('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id')->whereDate('ordered_at', Carbon::today()->toDateString())->orderBy('id', 'desc');
	}

	public function antrian_sedang_dilayani()
	{
		return $this->hasOne('App\Models\RawatJalan\Transaksi', 'poliklinik_id', 'id')->whereDate('ordered_at', Carbon::today()->toDateString())->whereNotIn('status', [0])->orderBy('id', 'desc');
	}

	public function tarif_dokter_spesialis()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_konsultasi_id');
	}
}