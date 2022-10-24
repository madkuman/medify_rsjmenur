<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class FarmasiJenis extends Model
{
	use DataLogger;
  use SoftDeletes;

  protected $connection = 'farmasi';
  protected $table = 'farmasi_jenis';
}