<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Laravel\Scout\Searchable;

class Kelas extends Model
{
	use DataLogger;
	protected $connection = 'mysql';
	protected $table = 'kelas';
}