<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiMasuk extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $connection = 'mysql';
	protected $table = 'transaksi_masuk';

	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

	public function transaksi_utama()
	{
		return $this->hasMany('App\Models\Hospital\TransaksiUtama','transaksi_masuk_id','id');
	}

	public function transaksi_utama_last()
	{
		return $this->hasOne('App\Models\Hospital\TransaksiUtama','transaksi_masuk_id','id')->latest();
	}

	public function transaksi_masuk_detail()
	{
		return $this->hasMany('App\Models\Hospital\TransaksiMasukDetail','transaksi_masuk_id','id')->latest();
	}

	public function pasien()
	{
		return $this->hasMany('App\Models\Pasien\Pasien','pasien_id','id');
	}
}
