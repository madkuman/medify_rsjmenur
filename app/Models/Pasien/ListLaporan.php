<?php

namespace App\Models\Pasien;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Laravel\Scout\Searchable;

class ListLaporan extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'list_laporan';
}
