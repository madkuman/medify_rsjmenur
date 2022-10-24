<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keuangan extends Model
{
    use SoftDeletes;
    
    protected $connection = 'remunerasi';
	protected $table = 'keuangan';

	protected $fillable = [
		'jp_dasar'
	];

    public function pegawai()
    {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
    }
}
