<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class TNIPangkat extends Model
{
	use DataLogger;
        use SoftDeletes;
    	protected $connection = 'patients';
    	protected $table = 'tni_pangkat';

        public function jenis_keanggotaan()
        {
            return $this->belongsTo('App\Models\Pasien\TNIKeanggotaan', 'keanggotaan');
        }

        public function jenis_jenjang()
        {
            return $this->belongsTo('App\Models\Pasien\TNIPangkatJenjang', 'jenjang');
        }
}
