<?php

namespace App\Models\KamarOperasi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class PerusahaanKerjasama extends Model
{
	use DataLogger;
    	protected $connection = 'patients';
    	protected $table = 'company_cooperation';
}
