<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisHubunganKeluarga extends Model
{
	use DataLogger;		
		use SoftDeletes; 
    	protected $connection = 'patients';
    	protected $table = 'jenis_hubungan_keluarga';
}
