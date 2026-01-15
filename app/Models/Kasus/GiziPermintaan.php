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

    public function kasus()
    {
        return $this->hasOne('App\Models\Kasus\Kasus', 'id', 'kasus_id');
    }

    public function pemesanan_detail()
    {
        return $this->hasOne(\App\Models\Gizi\PemesananDetail::class, 'gizi_permintaan_id', 'id');
    }

    public function waktu_makan()
    {
        return $this->hasOne(\App\Models\Gizi\WaktuMakan::class, 'id', 'waktu_makan_id');
    }

    public function diet()
    {
        return $this->hasOne(\App\Models\Gizi\Diet::class, 'id', 'diet_id');
    }

    public function bentuk_makanan()
    {
        return $this->hasOne(\App\Models\Gizi\BentukMakanan::class, 'id', 'bentuk_makanan_id');
    }

    public function lokasi()
    {
        return $this->hasOne(\App\Models\Hospital\Lokasi::class, 'id', 'lokasi_id');
    }

    public function creator()
    {
        return $this->hasOne(\App\User::class, 'id', 'created_by');
    }
}
