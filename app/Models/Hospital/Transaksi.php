<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Transaksi extends Model
{
	use DataLogger;
    	protected $connection = 'mysql';
	protected $table = 'transaksi';

	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

	public function transaksi_utama()
	{
		return $this->hasMany('App\Models\Hospital\TransaksiUtama','transaksi_id','id');
	}
}
