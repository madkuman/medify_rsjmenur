<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunBarang extends Model
{
    use DataLogger;
    protected $connection = 'eusulan';
    protected $table = 'akun_barang';

    use SoftDeletes;

    public function barang() {
        return $this->hasOne('App\Models\Eusulan\Barang', 'id', 'barang_id');
    }

    public function akun_rekening() {
        return $this->hasOne('App\Models\Eusulan\AkunRekening', 'id', 'akun_rekening_id');
    }

}
