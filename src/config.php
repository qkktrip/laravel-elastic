<?php

return [
    'index' => env('ELASTICSEARCH_INDEX', 'qkktrip'),
    'hosts' => [
        env('ELASTICSEARCH_HOST', 'http://112.74.133.233:9201'),
    ]
];
