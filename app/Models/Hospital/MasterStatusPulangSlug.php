<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class MasterStatusPulangSlug extends Model
{
	use DataLogger;
	use SoftDeletes;

	protected $connection = 'mysql';
	protected $table = 'master_status_pulang_slug';
}