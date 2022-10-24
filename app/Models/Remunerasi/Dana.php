<?php

namespace App\Models\Remunerasi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dana extends Model
{
    use SoftDeletes;
    
    protected $connection = 'remunerasi';
	protected $table = 'dana';

	protected $fillable = [
		'nominal'
	];
}
