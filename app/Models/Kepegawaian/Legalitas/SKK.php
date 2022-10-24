<?php

namespace App\Models\Kepegawaian\Legalitas;

use Illuminate\Database\Eloquent\Model;

class SKK extends Model
{
    protected $connection = 'kepegawaian';
    protected $table = 'legalitas_skk_pegawai';
    
    public function pegawai()
    {
        return $this->hasOne('\App\Models\Kepegawaian\Pegawai');
    }
}
