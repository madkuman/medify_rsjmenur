<?php

namespace App\Models\CSSD;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlkesSatuanLog extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'cssd';
	protected $table = 'alkes_satuan_log';

	public function alkes_satuan()
	{
		return $this->hasOne('App\Models\CSSD\AlkesSatuan', 'id', 'alkes_satuan_id');
	}

	public function transaksi()
	{
		return $this->hasOne('App\Models\CSSD\Transaksi', 'id', 'transaksi_id');
	}
	
	public function transaksi_ok()
	{
		return $this->hasOne('App\Models\KamarOperasi\Transaksi', 'id', 'ok_transaksi_id');
	}
}
