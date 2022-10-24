<?php

namespace App\Models\Remunerasi\View;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewKeuangan extends Model
{
    use SoftDeletes;

    protected $connection = 'remunerasi';
	protected $table = 'keuangan_pegawai';

}
