<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiMasukDetail extends Model
{
	use DataLogger;
	protected $connection = 'mysql';
	protected $table = 'transaksi_masuk_detail';
	protected $modul_id = 'modul_id';

	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

	public function transaksi_masuk()
	{
		return $this->hasOne('App\Models\Hospital\TransaksiMasuk','id','transaksi_masuk_id');
	}

	public function transaksi_lokal_igd()
	{
		return $this->hasOne('App\Models\IGD\Transaksi','id','transaksi_lokal_id');
	}

	public function transaksi_lokal_rawat_jalan()
	{
		return $this->hasOne('App\Models\RawatJalan\Transaksi','id','transaksi_lokal_id');
	}

	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien\Pasien','id','pasien_id');
	}
}
