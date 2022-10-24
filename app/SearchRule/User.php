<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class User extends SearchRule
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
            //     'fuzzy' => [
            //         'name' => [
            //             'value' => $this->builder->query,
            //             'fuzziness' => 1,
            //             'transpositions' => true,
            //             // 'boost' => 3.0,
            //         ]
            //     ]
            // ],
            'should' => [
                [
                    'match' => [
                        'name' => [
                            'query' => $this->builder->query,
                            'fuzziness' => 1,
                            'boost' => 1.0
                        ]
                    ]
                ],
                [
                    'match_phrase_prefix' => [
                        'name' => [
                            'query' => $this->builder->query,
                            'boost' => 4.0
                        ]
                    ],
                ],
            ]
        ];
    }
}