<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketObatSubscribe extends Model
{
	use DataLogger;

    	use SoftDeletes;
	protected $connection = 'mysql';
	protected $table = 'paket_obat_subscribe';

	public function paket_obat()
	{
		return $this->hasOne('App\Models\Hospital\PaketObat','id', 'paket_obat_id');
	}
}
