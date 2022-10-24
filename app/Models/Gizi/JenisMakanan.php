<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisMakanan extends Model
{
	use DataLogger;	
	use SoftDeletes;
 	protected $connection = 'gizi';
 	protected $table = 'jenis_makanan';

 	const UTAMA = 1;
 	const TAMBAHAN = 0;
 	const DIET = 1;
 	const NONDIET = 0;
}
