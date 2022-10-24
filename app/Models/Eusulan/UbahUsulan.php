<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class UbahUsulan extends Model
{
    use DataLogger;
    protected $connection = 'eusulan';
    protected $table = 'ubah_usulan';
    protected $dates = [
        'tanggal_awal',
        'tanggal_akhir'
    ];

    use SoftDeletes;

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

}
