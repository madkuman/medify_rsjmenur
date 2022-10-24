<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AntrianCallTv extends Model
{
	use DataLogger;
    protected $connection = 'rawatjalan';
    protected $table = 'antrian_call_tv';

    public function antrian_call()
    {
        return $this->belongsTo('App\Models\RawatJalan\AntrianCall', 'antrian_call_id', 'id');
    }

    public function master_tv()
    {
        return $this->belongsTo('App\Models\RawatJalan\MasterTv', 'master_tv_id', 'id');
    }
}
