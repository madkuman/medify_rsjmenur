<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlatBantu extends Model
{
	use DataLogger;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
  	protected $connection = 'kasus';
	protected $table = 'alat_bantu';

	
	public function creator()
	{
		return $this->hasOne('App\User','id','created_by');
	}

    public function editor()
    {
        return $this->hasOne('App\User','id','updated_by');
    }
	
	public function kasus()
	{
		return $this->hasOne('App\Models\Kasus\Kasus','id','kasus_id');
	}
	
	
	public function lokasi()
	{
		return $this->hasOne('App\Models\Hospital\Lokasi','id','lokasi_id');
	}

	public function sister_kasus()
	{
		return $this->hasMany('App\Models\Kasus\AlatBantu','kasus_id','kasus_id');
	}

	public function jumlah_tirah_baring(){
		return $this->hasMany('App\Models\Kasus\AlatNorton','kasus_id','kasus_id');
	}

	public function children()
	{
		return $this->hasMany('App\Models\Kasus\AlatBantu','parent_id','id');
	}

	public function parent()
	{
		return $this->hasOne('App\Models\Kasus\AlatBantu','id','parent_id');
	}

	public function getJsonValAttribute()
	{
		return json_decode($this->val);
	}
}
