<?php

namespace App\IndexConfig;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class Pegawai extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */
    protected $settings = [
        'index'=>[
           'max_ngram_diff' => 30
        ],
        'analysis' => [ 
            'analyzer' => [
                'partial' => [
                    'type' => 'custom',
                    'tokenizer' => 'partial',
                    'filter' => ['lowercase']
                ],
                'exact' => [
                    'type' => 'custom',
                    'tokenizer' => 'standard',
                    'filter' => ['lowercase']
                ]
            ],
        	'tokenizer' => [
				'partial' => [
				  'type' => 'ngram',
				  'min_gram' => 3,
				  'max_gram' => 30,
				  'token_chars' => ['letter', 'digit', 'whitespace']
				]
			]
        ]
    ];
}