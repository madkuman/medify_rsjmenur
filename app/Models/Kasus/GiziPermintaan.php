<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class GiziPermintaan extends Model
{
	use DataLogger;
    protected $connection = 'kasus';
    protected $table = 'gizi_permintaan';


    public function order()
    {
        return $this->hasOne('App\Models\Nutrition\Order','id','order_id');
    }

}
