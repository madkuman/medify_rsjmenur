<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PODetail extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'po_detail';	
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];

	public function parent()
	{
		return $this->hasOne('App\Models\Keuangan\PO','id','po_id');
	}
}
