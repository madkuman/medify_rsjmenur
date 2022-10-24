<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class HasilINACBG extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'hasil_inacbg';

}