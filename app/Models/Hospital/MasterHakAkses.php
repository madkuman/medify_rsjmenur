<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterHakAkses extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'master_hak_akses';
    use DataLogger;
}
