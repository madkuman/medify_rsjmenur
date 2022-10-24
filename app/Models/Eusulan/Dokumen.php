<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokumen extends Model
{
    use DataLogger;
    use SoftDeletes;
    protected $connection = 'eusulan';
    protected $table = 'dokumen';

}
