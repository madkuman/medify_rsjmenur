<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoketAntrian extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'loket_antrian';
    public static $path_sound = 'assets/img/farmasi-tv/loket';
    public static $default_sound = 'assets/img/farmasi-tv/default-loket.mp3';
    use SoftDeletes;
}
