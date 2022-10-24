<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJabatanIntern extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'kepegawaian';
	protected $table = 'master_jabatan_intern';
}
