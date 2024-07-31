<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRakObat extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'master_rak_obat';

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
