<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTarifKembali extends Model
{
    use SoftDeletes;
    use DataLogger;
    protected $connection = 'mysql';
    protected $table = 'master_tarif_kembali';

    public function tarif_master()
    {
        return $this->hasOne('App\Models\Keuangan\TarifMaster', 'id', 'tarif_master_id');
    }

}
