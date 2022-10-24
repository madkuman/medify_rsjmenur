<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaketObat extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'farmasi';
	protected $table = 'paket_obat';

	public function farmasi(){
		return $this->hasOne('App\Models\Farmasi\Farmasi','id', 'farmasi_id');
	}

	public function detail(){
		return $this->hasMany('App\Models\Farmasi\PaketObatDetail','paket_obat_id', 'id');
	}
}
