<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterFaskesAsuransi extends Model
{
    use SoftDeletes;
	protected $connection = 'kepegawaian';
    protected $table = 'master_faskes_asuransi';
    protected $dates = ['deleted_at'];
    
    public function pegawai()
	{
		return $this->hasOne('App\Models\Kepegawaian\Pegawai');
	}
}
