<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class MasterCaraPulangSlug extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'mysql';
	protected $table = 'master_cara_pulang_slug';
}