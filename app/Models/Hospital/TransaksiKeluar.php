<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiKeluar extends Model
{
	use DataLogger;
    	protected $connection = 'mysql';
	protected $table = 'transaksi_keluar';
	
	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

}
