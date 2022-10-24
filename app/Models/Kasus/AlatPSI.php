<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatPSI extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kasus';
	protected $table = 'alat_psi';
	protected $dates = ['deleted_at'];

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}
