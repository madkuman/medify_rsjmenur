<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemunerasiAbsensi extends Model
{
    use SoftDeletes;

    protected $connection = 'kepegawaian';
	protected $table = 'remunerasi_absensi';

	protected $fillable = [
        'absen_ket',
        'absen',
        'telat_satu',
        'telat_dua',
        'telat_tiga',
        'telat_empat',
        'pulang_satu',
        'pulang_dua',
        'pulang_tiga',
        'pulang_empat',
        'telat_senam',
        'tidak_senam'
    ];
    
    public function remunerasiDenda() {
		return $this->hasOne('App\Models\Kepegawaian\RemunerasiDenda', 'id', 'remunerasi_denda_id');
	}

}
