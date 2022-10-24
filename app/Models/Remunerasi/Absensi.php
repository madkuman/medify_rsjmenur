<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use SoftDeletes;

    protected $connection = 'remunerasi';
	protected $table = 'absensi';

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
        'tidak_senam',
        'tanggal'
    ];
    
    public function Denda() {
		return $this->hasOne('App\Models\Remunerasi\Denda', 'id', 'denda_id');
    }
    
    public function pegawai()
    {
        return $this->hasOne('App\Models\Kepegawaian\Pegawai', 'id', 'pegawai_id');
    }

}
