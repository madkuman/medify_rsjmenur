<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class Pegawai extends SearchRule
{
    /**
     * @inheritdoc
     */
    public function buildHighlightPayload()
    {
        //
    }

    /**
     * @inheritdoc
     */
    public function buildQueryPayload()
    {

        return [
            'must' => [
                'fuzzy' => [
                    'name' => [
                        'value' => $this->builder->query,
                        'fuzziness' => 1,
                        'transpositions' => true,
                    ]
                ]
            ],
            'should' => [
                [
                    'match' => [
                        'name.keyword' => [
                            'query' => $this->builder->query,
                            'boost' => 1.0
                        ]
                    ]
                ],
                [
                    'match_phrase_prefix' => [
                        'name' => [
                            'query' => $this->builder->query,
                            'boost' => 3.0
                        ]
                    ],
                ],
            ]
        ];
    }
}