<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
	use DataLogger;
  protected $connection = 'laundry';
	protected $table = 'barang';
	use SoftDeletes;
}
