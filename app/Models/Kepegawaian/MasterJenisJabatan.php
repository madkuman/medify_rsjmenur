<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJenisJabatan extends Model
{
    use SoftDeletes;
    
	protected $connection = 'kepegawaian';
    protected $table = 'master_jenis_jabatan';
    
}