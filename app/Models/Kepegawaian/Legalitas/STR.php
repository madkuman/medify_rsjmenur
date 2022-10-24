<?php

namespace App\Models\Kepegawaian\Legalitas;

use Illuminate\Database\Eloquent\Model;

class STR extends Model
{
    protected $connection = 'kepegawaian';
    protected $table = 'legalitas_str_pegawai';
    
    public function pegawai()
    {
        return $this->hasOne('\App\Models\Kepegawaian\Pegawai');
    }
}
