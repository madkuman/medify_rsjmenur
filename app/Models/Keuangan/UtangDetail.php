<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class UtangDetail extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'utang_detail';	
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function po()
	{
		return $this->hasOne('App\Models\Keuangan\PODetail','id','po_detail_id');
	}

}

