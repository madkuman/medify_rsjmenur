<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntrianLevel extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'rawatjalan';
	protected $table = 'antrian_level';
    protected $dates = ['deleted_at'];
    
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
}
