<?php

namespace App\Models\Kepegawaian\Legalitas;

use Illuminate\Database\Eloquent\Model;

class Kredensial extends Model
{
    protected $connection = 'kepegawaian';
    protected $table = 'legalitas_kredensial_pegawai';
    
    public function pegawai()
    {
        return $this->hasOne('\App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
    }
}
