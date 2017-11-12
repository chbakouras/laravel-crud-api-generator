<?php

return [
    'models' => [
        'package' => 'App\Models',
    ],
    'resource' => [
        'package' => 'App\Http\Resources',
        'name' => 'Resource',
    ],
    'repositories' => [
        'package' => 'App\Repositories\System',
        'interface-name' => 'Repository',
        'implementation-name' => 'RepositoryImpl',
        'service-provider' => 'App\Providers\RepositoryServiceProvider',
    ],
    'services' => [
        'package' => 'App\Services\System',
        'interface-name' => 'CrudService',
        'implementation-name' => 'CrudServiceImpl',
        'service-provider' => 'App\Providers\AppServiceProvider',
    ],
    'controllers' => [
        'package' => 'App\Http\Controllers\Api',
        'name' => 'ApiController',
        'route-namespace' => 'Api',
    ],
    'requests' => [
        'package' => 'App\Http\Requests',
        'name' => 'ApiRequest'
    ],
    'pagination' => [
        'parameter-size-name' => 'size',
        'parameter-size-value' => 20
    ],
    'sort' => [
        'parameter-sort-name' => 'sort',
        'parameter-sort-value' => 'id',
        'parameter-direction-name' => 'dir',
        'parameter-direction-value' => 'desc',
    ]
];
