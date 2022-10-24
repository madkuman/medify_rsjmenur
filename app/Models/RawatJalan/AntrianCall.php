<?php

namespace App\Models\RawatJalan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class AntrianCall extends Model
{
	use DataLogger;
	protected $connection = 'rawatjalan';
    protected $table = 'antrian_call';
    
    public function poliklinik()
    {
        return $this->belongsTo('App\Models\RawatJalan\Poliklinik', 'poliklinik_id', 'id');
    }

    public function ruangan()
    {
        return $this->belongsTo('App\Models\RawatJalan\Ruangan', 'ruangan_id', 'id');
    }

    public function transaksi()
    {
        return $this->belongsTo('App\Models\RawatJalan\Transaksi', 'transaksi_id', 'id');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\RawatJalan\AntrianLevel', 'antrian_level_id', 'id');
    }
}
