<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterPelatihan extends Model
{
    use SoftDeletes;
    
	protected $connection = 'kepegawaian';
    protected $table = 'master_pelatihan';
    
    protected $fillable = [
        'nama',
        'tahun',
        'tempat',
        'durasi',
        'skor',
        'sertifikat'
    ];

    public function pelatihan() {
		return $this->belongsTo('App\Models\Kepegawaian\Pelatihan');
    }
    
    public function berkas()
	{
		return $this->hasOne('App\Models\Kepegawaian\Berkas','id', 'sertifikat');
	}
    
}