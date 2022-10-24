<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTelekonsultasi extends Model
{
    use DataLogger;
    use SoftDeletes;
    protected $connection = 'rawatjalan';
    protected $table = 'master_telekonsultasi';

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function tarif()
    {
        return $this->hasOne('App\Models\Keuangan\Tarif', 'id', 'tarif_id');
    }
}
