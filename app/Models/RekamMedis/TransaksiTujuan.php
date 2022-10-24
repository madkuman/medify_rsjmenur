<?php

namespace App\Models\RekamMedis;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiTujuan extends Model
{
	use DataLogger;
	protected $connection = 'rekammedis';
	protected $table = 'transaksi_tujuan';
}
