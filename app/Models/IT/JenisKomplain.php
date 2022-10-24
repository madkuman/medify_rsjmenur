<?php

namespace App\Models\IT;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisKomplain extends Model
{
	use DataLogger;
    protected $table = 'jenis_komplain';
    protected $connection = 'it';

}
