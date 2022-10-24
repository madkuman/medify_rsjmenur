<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiPenunjang extends Model
{
	use DataLogger;
    	protected $connection = 'mysql';
	protected $table = 'transaksi_penunjang';

	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

	public function transaksi_utama()
	{
		return $this->hasOne('App\Models\Hospital\TransaksiUtama','id','transaksi_utama_id');
	}

}
