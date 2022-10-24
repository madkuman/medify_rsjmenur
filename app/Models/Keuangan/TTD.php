<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TTD extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'keuangan';
	protected $table = 'ttd';
	protected $fillable = ['id'];
	protected $dates = ['deleted_at'];
}
