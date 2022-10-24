<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatTimiStemi extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kasus';
	protected $table = 'alat_timi_stemi';
	protected $dates = ['deleted_at'];

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}
