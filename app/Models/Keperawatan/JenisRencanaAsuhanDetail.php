<?php

namespace App\Models\Keperawatan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisRencanaAsuhanDetail extends Model
{
	use DataLogger;
	protected $connection = 'keperawatan';
	protected $table = 'jenis_rencana_asuhan_detail';
}
