<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class DSP extends Model
{
	use DataLogger;
    protected $connection = 'kepegawaian';
    protected $table = 'dsp';

    public function pegawai()
	{
		return $this->belongsTo('App\Models\Kepegawaian\Pegawai', 'employee_id', 'id');
	}
}
