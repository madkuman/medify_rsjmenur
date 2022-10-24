<?php

namespace App\Models\Aset;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- This is required


class ItemsLocation extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $table = 'items_location';
	protected $connection = 'aset';

	protected $fillable = [
		'name',
	];

}
