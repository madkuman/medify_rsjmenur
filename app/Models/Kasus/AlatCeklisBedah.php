<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatCeklisBedah extends Model
{
	use DataLogger;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
  	protected $connection = 'kasus';
	protected $table = 'alat_ceklis_bedah';

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}
	
	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}

	public function sister_kasus()
	{
		return $this->hasMany('App\Models\Kasus\AlatBantu','kasus_id','kasus_id');
	}
}
