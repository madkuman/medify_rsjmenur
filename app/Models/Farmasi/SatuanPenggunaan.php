<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class SatuanPenggunaan extends Model
{
	use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'satuan_penggunaan';
}
