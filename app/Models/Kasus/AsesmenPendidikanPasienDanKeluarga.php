<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AsesmenPendidikanPasienDanKeluarga extends Model
{
    protected $connection = "kasus";
    protected $table = "asesmen_pendidikan_pasien_dan_keluarga";
    use SoftDeletes;

    public function creator()
    {
        return $this->hasOne("App\User", "id", "created_by");
    }
    public function updater()
    {
        return $this->hasOne("App\User", "id", "updated_by");
    }
    public function lembar()
    {
        return $this->hasMany("App\Models\Kasus\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga", "asesmen_id", "id")->orderBy('id');
    }
}
