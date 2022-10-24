<?php

namespace App\IndexConfig;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class UserHospitalPasien extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [ 
            'analyzer' => [
                'partial' => [
                    'type' => 'custom',
                    'tokenizer' => 'partial',
                    'filter' => ['lowercase']
                ],
                'exact' => [
                    'type' => 'custom',
                    'tokenizer' => 'keyword',
                    'filter' => ['lowercase']
                ]
            ],
        	'tokenizer' => [
				'partial' => [
				  'type' => 'ngram',
				  'min_gram' => 3,
				  'max_gram' => 10,
				  'token_chars' => ['letter', 'digit', 'whitespace']
				]
			]
        ]
    ];
}