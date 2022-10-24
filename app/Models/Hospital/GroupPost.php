<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class GroupPost extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'group_post';

	public function grup(){
		return $this->belongsTo('App\Models\Hospital\Grup', 'group_id', 'id');
	}

	public function creator(){
		return $this->belongsTo('App\User', 'created_by');
	}
}
