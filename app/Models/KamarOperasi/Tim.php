<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tim extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $connection = 'kamaroperasi';
	protected $table = 'tim';

	public function detail() {
	  return $this->hasOne('App\User', 'id', 'user_id');
  	}

  	public function role() {
	  return $this->hasOne('App\Models\KamarOperasi\PeranTim', 'id', 'role_id')->withTrashed();
  	}
}
