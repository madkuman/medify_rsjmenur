<?php

namespace App\SearchRule;

use ScoutElastic\SearchRule;

class Pasien extends SearchRule
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
                //     'query_string' => [
                //         'query' => $this->builder->query,
                //         'fuzziness' => 1
                //     ]
                //     // 'match' => [
                //     //     'combined_field' => [
                //     //         'query' => $this->builder->query,
                //     //         'fuzziness' => 1,
                //     //     ]
                //     // ],
                // ],
                'should' => [
                    [
                        'match' => [
                            'name' => [
                                'query' => $this->builder->query,
                                'fuzziness' => 1,
                                'boost' => 5.0
                            ]
                        ]
                    ],
                    [
                        'match_phrase_prefix' => [
                            'name' => [
                                'query' => $this->builder->query,
                                'boost' => 7.0
                            ]
                        ],
                    ],
                    [                    
                        'match' => [
                            'combined_field' => [
                                'query' => $this->builder->query,
                                'fuzziness' => 1,
                                'boost' => 2.0
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'no_rm' =>[
                                'query' => $this->builder->query,
                                'boost' => 6.0,
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'no_identitas' =>[
                                'query' => $this->builder->query,
                                'boost' => 4.5,
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'tni_nrp' =>[
                                'query' => $this->builder->query,
                                'boost' => 4.5,
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'kerabat_tni_nrp' =>[
                                'query' => $this->builder->query,
                                'boost' => 4.0,
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'asuransi' =>[
                                'query' => $this->builder->query,
                                'boost' => 3.0,
                            ]
                        ]
                    ],
                ]
        ];
    }
}