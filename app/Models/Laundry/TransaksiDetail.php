<?php

namespace App\Models\Laundry;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class TransaksiDetail extends Model
{
	use DataLogger;
  protected $connection = 'laundry';
	protected $table = 'transaksi_detail';
}
