<?php

namespace App\Models\Farmasi;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKodeBidang extends Model
{
    use DataLogger;
    protected $connection = 'farmasi';
    protected $table = 'master_kode_bidang';

    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne('App\User','id', 'created_by');
    }
    

    public function parent()
    {
        return $this->hasOne('App\Models\Farmasi\MasterKodeBidang','id', 'parent_id')->withTrashed();
    }

    public function updater()
    {
        return $this->hasOne('App\User','id', 'updated_by');
    }
}
