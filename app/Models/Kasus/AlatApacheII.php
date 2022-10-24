<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatApacheII extends Model
{
	use DataLogger;
    use SoftDeletes;
    protected $connection = 'kasus';
	protected $table = 'alat_apache_ii';
	protected $dates = ['deleted_at'];

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
}
