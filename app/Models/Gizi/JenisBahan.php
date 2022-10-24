<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class JenisBahan extends Model
{
	use DataLogger;
    protected $connection = 'gizi';
   	protected $table = 'jenis_bahan';

   	public function bahan()
   	{
   		return $this->hasMany('App\Models\Gizi\BahanMakanan','jenis_bahan_id','id');
   	}
}
