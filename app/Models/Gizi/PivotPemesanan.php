<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PivotPemesanan extends Model
{
	use DataLogger;
   use SoftDeletes;
   protected $connection = 'gizi';
   protected $table = 'pivot_pemesanan';
}
