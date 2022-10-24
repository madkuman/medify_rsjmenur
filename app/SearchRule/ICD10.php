<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class ICD10 extends SearchRule
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
                            'long_desc' => [
                                'fuzziness' => 1,
                                'query' => $this->builder->query,
                                'boost' => 2.0
                            ]
                        ]
                    ],                    
                    [
                        'match' => [
                            'code_icd' => [
                                'query' => $this->builder->query,
                                'boost' => 6.0
                            ]
                        ]
                    ]
                ]
        ];
    }
}