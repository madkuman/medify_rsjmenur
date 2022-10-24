<?php

namespace App\Models\RawatInap;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class RuanganVisite extends Model
{
	use DataLogger;	
	use SoftDeletes;
	protected $connection = 'rawatinap';
	protected $table = 'ruangan_visite';

	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif','id','tarif_id');
	}
}
