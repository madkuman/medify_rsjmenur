<?php

namespace App\Models\LabPK;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanMaster extends Model
{
	use DataLogger;
    protected $connection = 'lab_pk';
    protected $table = 'laporan_master';

}