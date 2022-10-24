<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $connection = 'kepegawaian';
    protected $table = 'agama';
    
    public function pegawai()
    {
        return $this->hasOne('\App\Models\Kepegawaian\Pegawai');
    }
}
