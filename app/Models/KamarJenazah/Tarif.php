<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
	use DataLogger;
  use SoftDeletes;
  protected $connection = 'kamarjenazah';
  protected $table = 'tarif';
}
