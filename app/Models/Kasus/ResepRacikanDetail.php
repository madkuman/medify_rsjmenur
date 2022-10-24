<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;


class ResepRacikanDetail extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'kasus';
	protected $table = 'resep_racikan_detail';

	public function kasus_resep_detail() {
        return $this->hasOne('App\Models\Kasus\ResepDetail', 'id', 'resep_detail_id');
    }
}
