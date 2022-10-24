<?php

namespace App\Models\ThirdParty;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RujukBalik extends Model
{
    use DataLogger;
    use SoftDeletes;

    protected $connection = 'thirdp';
    protected $table = 'rujuk_balik';

    public function pasien()
    {
        return $this->hasOne(\App\Models\Pasien\Pasien::class, 'id', 'pasien_id');
    }

    public function detail()
    {
        return $this->hasMany(\App\Models\ThirdParty\RujukBalikDetail::class, 'rujuk_balik_id', 'id');
    }

    public function getAttrResponseAttribute()
    {
        return json_decode($this->plain_response);
    }
}
