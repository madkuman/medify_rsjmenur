<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;

class Zipper extends Model
{
	protected $connection = 'mysql';
	protected $table = 'zipper';

    function zipper_detail()
    {
        return $this->hasMany(\App\Models\Hospital\ZipperDetail::class);    
    }

    function laporan()
    {
        return $this->hasOne(\App\Models\Hospital\Laporan::class, 'zipper_id', 'id');    
    }
}
