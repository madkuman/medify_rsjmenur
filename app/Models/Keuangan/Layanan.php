<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Laravel\Scout\Searchable;

class Layanan extends Model
{
	use DataLogger;
	use Searchable;
	protected $connection = 'keuangan';
	protected $table = 'layanan';	

	public function searchableAs()
	{
		return 'hospital_keuangan_layanan';
	}
}
