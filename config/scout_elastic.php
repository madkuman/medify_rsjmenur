<?php

return [
    'client' => [
        'hosts' => [
            config('app.elastic_host')
        ]
    ],
    'update_mapping' => env('SCOUT_ELASTIC_UPDATE_MAPPING', true),
    'indexer' => env('SCOUT_ELASTIC_INDEXER', 'bulk'),
    'document_refresh' => env('SCOUT_ELASTIC_DOCUMENT_REFRESH', true)
];