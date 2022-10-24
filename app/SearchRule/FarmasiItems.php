<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class FarmasiItems extends SearchRule
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
                                'value' => $this->builder->query,
                                'fuzziness' => 1,
                                'transpositions' => true,
                                'boost' => 4.5,
                            ]
                        ]
                    ],[
                        'fuzzy' => [
                            'satuan' => [
                                'value' => $this->builder->query,
                                'fuzziness' => 1,
                                'transpositions' => true,
                                'boost' => 1.0,
                            ]
                        ]
                    ],[
                        'fuzzy' => [
                            'kode' => [
                                'value' => $this->builder->query,
                                'fuzziness' => 1,
                                'transpositions' => true,
                                'boost' => 2.5,
                            ]
                        ]
                    ]
                ],

        ];
    }
}