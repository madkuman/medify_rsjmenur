<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;


class ICD10 extends Model
{
	use DataLogger;

	use Searchable;
  use SoftDeletes;

  protected $connection = 'kasus';
	protected $table = 'icd_10';
	protected $indexConfigurator = \App\IndexConfig\Icd10::class;
  protected $searchRule = [
    \App\SearchRule\ICD10::class
  ];

	protected $mapping = [
        'properties' => [
            'code_icd' => [
              'type' => 'text',
          		"analyzer" => "code_analyzer",
          		"search_analyzer" => "code_analyzer"
            ],
            'long_desc' => [
              'type' => 'text',
          		"analyzer" => "partial",
          		"search_analyzer" => "partial"
            ]
        ]
    ];



public function toSearchableArray()
{
	return [
		'long_desc' => $this->long_desc,
		'code_icd' => $this->code_icd
	];
}

public function dtd()
    {
      return $this->hasOne('App\Models\Kasus\DTD','id','dtd_id');
    }

public function diagnosis()
    {
      return $this->hasMany('App\Models\Kasus\Diagnosis','icd_10','id');
    }

  public function searchableAs()
    {
        return 'icd_10';
    }

  public function referensi() {
      return $this->hasMany('App\Models\Kasus\DiagnosisReferensi', 'icd_10_id', 'id');
    }

  }

