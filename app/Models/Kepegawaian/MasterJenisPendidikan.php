<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterJenisPendidikan extends Model
{
    use SoftDeletes;
	protected $connection = 'kepegawaian';
    protected $table = 'pendidikan_jenis';

    protected $fillable = [
        'nama'
    ];
}
