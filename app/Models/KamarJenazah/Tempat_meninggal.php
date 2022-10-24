<?php

namespace App\Models\KamarJenazah;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Tempat_meninggal extends Model
{
	use DataLogger;
    protected $connection = 'kamarjenazah';
  	protected $table = 'tempat_meninggal';
}
