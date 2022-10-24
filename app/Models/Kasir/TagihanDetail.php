<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagihanDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasir';
	protected $table = 'tagihan_detail';	
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function tarif()
	{
		return $this->hasOne('App\Models\Keuangan\Tarif','id','tarif_id')->withTrashed();
	}

	public function tipe()
	{
		return $this->hasOne('App\Models\Keuangan\TarifTipe','id','tarif_tipe_id')->withTrashed();
	}

	public function lokasi_detail()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id')->withTrashed();
	}

}