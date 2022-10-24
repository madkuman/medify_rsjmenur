<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'lab_pk';
	protected $table = 'form';

	public function detail()
	{
		return $this->hasMany('App\Models\LabPK\FormDetail', 'form_id', 'id');
	}

	public function form_tarif()
	{
		return $this->hasMany('App\Models\LabPK\FormTarif', 'form_id', 'id');
	}
}
