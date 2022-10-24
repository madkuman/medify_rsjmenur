<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga extends Model
{
    protected $connection = "kasus";
    protected $table = "lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    
}