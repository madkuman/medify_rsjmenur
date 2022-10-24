<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class Profesi extends Model
{
	use DataLogger;
    protected $connection = 'kamaroperasi';
	protected $table = 'profesi';
}
