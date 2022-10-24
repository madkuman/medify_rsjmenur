<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;

class WaktuEstimasiJenisResep extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'waktu_estimasi_jenis_resep';
}
