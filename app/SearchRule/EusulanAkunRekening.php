<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class EusulanAkunRekening extends SearchRule
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
                'query_string' => [
                    'query' => $this->builder->query
                ]
            ],
            'should' => [
                [
                    'fuzzy' => [
                        'nama' => [
                            'fuzziness' => 1,
                            'query' => $this->builder->query,
                            'boost' => 4.0
                        ]
                    ]
                ],
                [
                    'match' => [
                        'kode' => [
                            'query' => $this->builder->query,
                            'boost' => 6.0
                        ]
                    ]
                ]
            ]
        ];
    }
}