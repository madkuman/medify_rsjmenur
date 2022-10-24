<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class ErrorLIS extends Model
{
	use DataLogger;
    protected $connection = 'lab_pk';
    protected $table = 'error_lis';

}