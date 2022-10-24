<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
	use DataLogger;
    use SoftDeletes;
	protected $connection = 'rawatjalan';
	protected $table = 'ruangan';
    protected $dates = ['deleted_at'];
    
    public function poliklinik()
    {
        return $this->hasOne('App\Models\RawatJalan\Poliklinik', 'id', 'poliklinik_id');
    }

    public function dokter()
    {
        return $this->hasOne('App\User', 'id', 'dokter_id');
    }
}
