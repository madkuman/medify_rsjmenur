<?php

namespace App\Models\ClinicalPathway;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use DataLogger;
	use SoftDeletes;
	protected $connection = 'clinical_pathway';
	protected $table = 'categories';
	protected $fillable = ['slug', 'name', 'css_class'];

	public function articles()
	{
		return $this->belongsToMany(Article::class);
	}
}
