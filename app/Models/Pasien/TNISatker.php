<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TNISatker extends Model
{
	use DataLogger;
        use SoftDeletes;
    	protected $connection = 'patients';
    	protected $table = 'tni_satker';

        public function kotama()
        {
            return $this->belongsTo('App\Models\Pasien\TNIKotama');
        }
}
