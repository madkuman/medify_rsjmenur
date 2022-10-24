<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiFileLokasi extends Model
{
	use DataLogger;
    protected $connection = 'keuangan';
	protected $table = 'transaksi_file_lokasi';
}
