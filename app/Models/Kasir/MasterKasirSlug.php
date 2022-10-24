<?php

namespace App\Models\Kasir;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKasirSlug extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kasir';
	protected $table = 'master_kasir_slug';

}
