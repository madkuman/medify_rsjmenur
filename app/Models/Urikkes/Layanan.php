<?php

namespace App\Models\Urikkes;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Layanan extends Model
{
	use DataLogger;
	
	protected $connection = 'urikkes';
	protected $table = 'layanan';

	public function paket()
	{
		return $this->belongsToMany('App\Models\Urikkes\Paket', 'layanan_paket', 'layanan_id', 'paket_id');
	}
}
