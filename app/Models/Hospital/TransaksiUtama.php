<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiUtama extends Model
{
	use DataLogger;
    	protected $connection = 'mysql';
	protected $table = 'transaksi_utama';


	public function modul()
	{
		return $this->hasOne('App\Models\Hospital\Modul','id','modul_id');
	}

	public function transaksi_masuk()
	{
		return $this->hasOne('App\Models\Hospital\TransaksiMasuk','id','transaksi_masuk_id');
	}

	public function transaksi_penunjang()
	{
		return $this->hasMany('App\Models\Hospital\TransaksiPenunjang','transaksi_utama_id','id');
	}
}
