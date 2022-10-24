<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempatTidur extends Model
{
	use DataLogger;
	protected $connection = 'rawatinap';
	protected $table = 'tempat_tidur';
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	public function transaksi()
	{
		return $this->hasOne('App\Models\RawatInap\Transaksi', 'id', 'transaksi_id');
	}

	public function ruangan()
	{
		return $this->hasOne('App\Models\RawatInap\Ruangan', 'id', 'ruangan_id');
	}

	public function booking()
	{
		return $this->hasOne('App\Models\RawatInap\Transaksi', 'id', 'booking_id');
	}
	
	

	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi', 'id', 'lokasi_id');
	}
}
