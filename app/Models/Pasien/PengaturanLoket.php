<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengaturanLoket extends Model
{
    use SoftDeletes;
	protected $connection = 'patients';
	protected $table = 'pengaturan_loket';
    use DataLogger;
}
