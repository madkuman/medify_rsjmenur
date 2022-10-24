<?php

namespace App\Models\Eusulan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogUsulan extends Model
{
    use DataLogger;
    protected $connection = 'eusulan';
    protected $table = 'log_usulan';

    use SoftDeletes;

    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updater() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    public function barang() {
        return $this->hasOne('App\Models\Eusulan\Barang', 'id', 'barang_id');
    }

    public function akun_rekening() {
        return $this->hasOne('App\Models\Eusulan\AkunRekening', 'id', 'akun_rekening_id');
    }

    public function dokumen() {
        return $this->hasOne('App\Models\Eusulan\Dokumen', 'id', 'dokumen_id');
    }

    public function usulan() {
        return $this->hasOne('App\Models\Eusulan\Usulan', 'id', 'usulan_id');
    }

}
