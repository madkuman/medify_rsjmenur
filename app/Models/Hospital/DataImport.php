<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class DataImport extends Model
{
	use DataLogger;
    protected $connection = 'mysql';
	protected $table = 'data_import';
}
