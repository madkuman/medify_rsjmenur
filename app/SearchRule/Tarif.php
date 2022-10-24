<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class Tarif extends SearchRule
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
                        'match' => [
                            'deskripsi' => [
                                'query' => $this->builder->query,
                                'fuzziness' => 1,
                                'boost' => 3.0
                            ]
                        ]
                    ],
                    // [
                    //     'match_prefix_phrase' => [
                    //         'deskripsi' => [
                    //             'value' => $this->builder->query,
                    //             'boost' => 4.0
                    //         ]
                    //     ],
                    // ],
                    [
                        'match' => [
                            'kategori' => [
                                'query' => $this->builder->query,
                                'fuzziness' => 1,
                                'boost' => 1.0
                            ]
                        ]
                    ]
                ]
        ];
    }
}