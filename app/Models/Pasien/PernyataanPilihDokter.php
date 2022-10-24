<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PernyataanPilihDokter extends Model
{
    protected $connection = "patients";
    protected $table = "surat_pernyataan_memilih_dokter";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }

    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }

    public function dokter() {
        return $this->hasOne("App\User", "id", "dokter_id");
    }
    
}