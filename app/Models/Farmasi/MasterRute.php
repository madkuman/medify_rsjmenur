<?php

namespace App\Models\Farmasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRute extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'master_rute';

    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }

    public function updater()
    {
        return $this->hasOne('App\User','id', 'updated_by');
    }

}
