<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class Icd9 extends SearchRule
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
                // 'must' => [
                //     'match' => [
                //         'long_desc' => [
                //             'query' => $this->builder->query,
                //         ]
                //     ]
                // ],
                'should' => [
                    [
                        'fuzzy' => [
                            'long_desc' => [
                                'fuzziness' => 1,
                                'value' => $this->builder->query,
                                'boost' => 1.0
                            ]
                        ]
                    ],
                    [
                        'match_phrase_prefix' => [
                            'long_desc' => [
                                'query' => $this->builder->query,
                                'boost' => 3.0
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'code_icd' => [
                                'query' => $this->builder->query,
                                'boost' => 4.0
                            ]
                        ]
                    ]
                ]
            ];
    }
}