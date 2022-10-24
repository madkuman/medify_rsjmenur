<?php

namespace App\Models\Kasus;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\DataLogger;
use Illuminate\Database\Eloquent\SoftDeletes;
use ScoutElastic\Searchable;

class ICD9 extends Model
{
	use DataLogger;
	use Searchable;
  use SoftDeletes;

	protected $connection = 'kasus';
	protected $table = 'icd_9';	
	protected $indexConfigurator = \App\IndexConfig\Icd9::class;
  protected $searchRule = [
    \App\SearchRule\Icd9::class
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
            ],
            'short_desc' => [
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
			'short_desc' => $this->short_desc,
			'code_icd' => $this->code_icd
		];
	}

	public function searchableAs()
	{
		return 'icd_9';
	}
}
