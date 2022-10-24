<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermohonanPindahKelas extends Model
{
    protected $connection = "patients";
    protected $table = "surat_permohonan_pindah_kelas";
    use SoftDeletes;

    public function creator() {
        return $this->hasOne("App\User", "id", "created_by");
    }

    public function updater() {
        return $this->hasOne("App\User", "id", "updated_by");
    }

    public function awalKelas() {
        return $this->hasOne("App\Models\Hospital\Kelas", "id", "awal_kelas");
    }
    
    public function tujuanKelas() {
        return $this->hasOne("App\Models\Hospital\Kelas", "id", "tujuan_kelas");
    }
}