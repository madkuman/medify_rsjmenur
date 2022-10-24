<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PemeriksaanPsikologisAnak extends Model
{
    protected $connection = "kasus";
    protected $table = "pemeriksaan_psikologis_anak";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne(\App\User::class, "id", "created_by");
    }

    public function updater() {
        return $this->hasOne(\App\User::class, "id", "updated_by");
    }

    public function kasus() {
        return $this->hasOne(\App\Models\Kasus\Kasus::class, 'id', 'kasus_id');
    }
}
