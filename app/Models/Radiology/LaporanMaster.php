<?php

namespace App\Models\Radiology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanMaster extends Model
{
	use DataLogger;
    protected $connection = 'radiology';
    protected $table = 'laporan_master';

}