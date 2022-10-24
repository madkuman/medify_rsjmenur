<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Model;

class JenisKewarganegaraan extends Model
{
    protected $connection = 'patients';
    protected $table = 'jenis_kewarganegaraan';
}
