<?php

namespace App\Models\ThirdParty;

use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RujukBalikDetail extends Model
{
    use DataLogger;
	use SoftDeletes;

    protected $connection = 'thirdp';
    protected $table = 'rujuk_balik_detail';

    public function rujuk_balik()
    {
        return $this->hasOne(\App\Models\ThirdParty\RujukBalik::class,'id','rujuk_balik_id');
    }
}
