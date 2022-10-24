<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemunerasiDana extends Model
{
    use SoftDeletes;
    
    protected $connection = 'kepegawaian';
	protected $table = 'remunerasi_dana';

	protected $fillable = [
		'jumlah'
	];
}
