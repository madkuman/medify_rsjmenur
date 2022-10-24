<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class DiagnosisReferensi extends Model
{
	use DataLogger;
	protected $connection = 'kasus';
	protected $table = 'diagnosis_referensi';
}
