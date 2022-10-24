<?php

namespace App\IndexConfig;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class EusulanAkunRekening extends IndexConfigurator
{
    use Migratable;

    /**
     * @var array
     */

    protected $settings = [
        'index'=>[
            'max_ngram_diff' => 25
        ],
        'analysis' => [
            'analyzer' => [
                'partial' => [
                    'type' => 'custom',
                    'tokenizer' => 'partial',
                    'filter' => ['lowercase']
                ],
                'code_analyzer' => [
                    'type' => 'custom',
                    'tokenizer' => 'code_tokenizer',
                    'filter' => ['lowercase']
                ]
            ],
            'tokenizer' => [
                'partial' => [
                    'type' => 'ngram',
                    'min_gram' => 3,
                    'max_gram' => 10,
                    'token_chars' => ['letter', 'digit', 'whitespace']
                ],
                'code_tokenizer' => [
                    'type' => 'ngram',
                    'min_gram' => 2,
                    'max_gram' => 10,
                    'token_chars' => ['letter', 'digit', 'punctuation']
                ]
            ]
        ]
    ];
}