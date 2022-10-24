<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterPenghargaan extends Model
{
    use SoftDeletes;
    
	protected $connection = 'kepegawaian';
    protected $table = 'master_penghargaan';
    
    protected $fillable = [
        'nama'
    ];
    
}