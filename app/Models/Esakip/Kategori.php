<?php

namespace App\Models\Esakip;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use DataLogger;
	protected $connection = 'esakip';
	protected $table = 'kategori';

	use SoftDeletes;

}
