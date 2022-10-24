<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBebanKerja extends Model
{
	use SoftDeletes;
	protected $connection = 'kepegawaian';
	protected $table = 'master_beban_kerja';

	
}

