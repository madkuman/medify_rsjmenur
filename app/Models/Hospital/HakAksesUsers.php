<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class HakAksesUsers extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'hak_akses_users';
    use DataLogger;

    public function master_akses(){
        return $this->hasOne('App\Models\Hospital\MasterHakAkses', 'id', 'hak_akses_id');
    }
}
