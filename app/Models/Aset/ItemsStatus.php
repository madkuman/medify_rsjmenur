<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required

class ItemsStatus extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $table = 'items_status';
	protected $connection = 'aset';

	protected $fillable = [
		'name',
	];

}
