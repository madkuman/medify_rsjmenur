<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class KolaboratorType extends Model
{
	use DataLogger;
  	protected $connection = 'kasus';
	protected $table = 'kasus_collaborator_type';
}
