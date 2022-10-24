<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'urikkes';
	protected $table = 'paket';

	public function tarifPaket()
	{
		return $this->hasMany('App\Models\Urikkes\PaketTarif', 'paket_id', 'id');
	}

	public function getTotal()
	{
		return $this->tarif->detail->sum('harga');
	}
}
