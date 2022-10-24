<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Modul extends Model
{
	use DataLogger;
    	protected $connection = 'mysql';
	protected $table = 'modul';
}
