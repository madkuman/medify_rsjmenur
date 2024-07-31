<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Laravel\Scout\Searchable;

class Resep extends Model
{
	use DataLogger;
	protected $connection = 'farmasi';
	protected $table = 'resep';
	//use Searchable;
	use SoftDeletes;

	public function owner_detail()
	{
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id')->withTrashed();
	}

	public function pasien_detail()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id', 'id_pasien');
	}

	public function transaksi_detail()
	{
		return $this->hasOne('App\Models\Farmasi\TransaksiObat','id', 'transaksi_id')->withTrashed();
	}


	public function transaksi()
	{
		return $this->hasOne('App\Models\Farmasi\TransaksiObat','id', 'transaksi_id')->withTrashed();
	}
	
	public function resep_detail()
	{
		return $this->hasMany('App\Models\Farmasi\ResepDetail','resep_id', 'id')->orderBy('id','asc');
	}

	public function kasus_resep_detail()
	{
		return $this->hasOne('App\Models\Kasus\Resep','id', 'kasus_resep_id');
	}

	public function analisa_creator()
	{
		return $this->hasOne('App\User','id', 'analisa_by');
	}


	public function as_final()
	{
		return $this->hasOne('App\Models\Farmasi\TransaksiObat','resep_final', 'id');
	}
	function konfirmasi_permintaan_user()
	{
		return $this->hasOne(\App\User::class, 'id', 'konfirmasi_permintaan_by');	
	}
}
