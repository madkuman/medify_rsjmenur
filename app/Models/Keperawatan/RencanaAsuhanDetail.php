<?php

namespace App\Models\Keperawatan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class RencanaAsuhanDetail extends Model
{
	use DataLogger;
	protected $connection = 'keperawatan';
	protected $table = 'rencana_asuhan_detail';
	use SoftDeletes;
	public function konten() {
		return $this->belongsTo('App\Models\Kasus\Keperawatan');
	}


	public function rencana_asuhan() {
		return $this->hasOne('App\Models\Keperawatan\RencanaAsuhan','id','rencana_asuhan_id');
	}
}
