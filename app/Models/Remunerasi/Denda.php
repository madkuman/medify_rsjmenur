<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denda extends Model
{
    use SoftDeletes;
    
    protected $connection = 'remunerasi';
	protected $table = 'denda';

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
}
