<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AsalRujukan extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'asal_rujukan';

	protected $fillable = ['nama'];
}