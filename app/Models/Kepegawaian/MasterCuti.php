<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class MasterCuti extends Model
{
    use SoftDeletes;
    use DataLogger;
    
    protected $connection = 'kepegawaian';
    protected $table = 'master_cuti';
}
