<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RemunerasiKeuangan extends Model
{
    use SoftDeletes;
    
    protected $connection = 'kepegawaian';
	protected $table = 'remunerasi_keuangan';

	protected $fillable = [
		'name'
	];
}
