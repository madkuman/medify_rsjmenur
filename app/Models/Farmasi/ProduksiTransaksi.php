<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProduksiTransaksi extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'farmasi';
	protected $table = 'produksi_transaksi';
}