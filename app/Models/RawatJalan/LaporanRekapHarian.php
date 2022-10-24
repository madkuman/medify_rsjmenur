<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class LaporanRekapHarian extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
	protected $table = 'laporan_rekap_harian';
}
