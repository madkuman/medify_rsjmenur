<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BebanKerja extends Model
{
    use SoftDeletes;
    
    protected $connection = 'remunerasi';
	protected $table = 'beban_kerja';

	public function pegawai()
    {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
    }
}
