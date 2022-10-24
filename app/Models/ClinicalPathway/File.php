<?php

namespace App\Models\ClinicalPathway;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;

class File extends Model
{
	use DataLogger;
	protected $connection = 'clinical_pathway';
	protected $table = 'files';
	protected $fillable = ['name', 'original_name', 'type', 'size'];

	public function articles()
	{
		return $this->belongsToMany(Article::class);
	}
}
