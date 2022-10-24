<?php

namespace App\Models\LabPA;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Result extends Model
{
	use DataLogger;
    protected $connection = 'lab_pa';
    protected $table = 'result';
}