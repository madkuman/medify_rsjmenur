<?php

namespace App\Models\LabPA;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanMaster extends Model
{
	use DataLogger;
    protected $connection = 'lab_pa';
    protected $table = 'laporan_master';

}