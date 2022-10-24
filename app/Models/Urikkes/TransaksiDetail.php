<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiDetail extends Model
{
	use DataLogger;
	
	protected $connection = 'urikkes';
	protected $table = 'transaksi_detail';

	public function transaksi()
	{
		return $this->belongsTo('App\Models\Urikkes\Transaksi');
	}

	public function tarif()
	{
		return $this->belongsTo('App\Models\Keuangan\TarifMaster')->withTrashed();
	}

	public function paket()
	{
		return $this->hasOne('App\Models\Urikkes\Paket','id','paket_id');
	}
}
