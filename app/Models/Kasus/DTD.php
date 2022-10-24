<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use ScoutElastic\Searchable;


class DTD extends Model
{
	use DataLogger;
  protected $connection = 'kasus';
	protected $table = 'dtd';
  
  public function icd10()
    {
      return $this->hasMany('App\Models\Kasus\ICD10','dtd_id','id')->withTrashed();
    }

  public function searchableAs()
    {
        return 'dtd';
    }

}

