<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Relations\Relation;

class Matkes extends Model
{
	use DataLogger;
  protected $connection = 'kamaroperasi';
	protected $table = 'matkes';
}
