<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PemeriksaanHasil extends Model
{
	use DataLogger;
	protected $connection = 'lab_pk';
	protected $table = 'pemeriksaan_hasil';


	public function form()
	{
		return $this->hasOne('App\Models\LabPK\PemeriksaanForm','id','form_id');
	}
}
