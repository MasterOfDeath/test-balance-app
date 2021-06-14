<?php

/**
 * Настройки JsonRpc
 */

use Illuminate\Support\Str;
use Tochka\JsonRpc\Middleware\TokenAuthMiddleware;

return [
    'default' => [
        'description' => 'JsonRpc Server',
        'namespace'   => 'App\Http\Controllers\Jsonrpc',
        'controllerSuffix' => 'Controller',
        'methodDelimiter' => '_',
        'middleware'  => [
            TokenAuthMiddleware::class         => [
                'headerName' => 'X-Access-Key',
                'tokens'     => [
                    'service_balance' => env('JSONRPC_KEY_SERVICE_BALANCE', Str::uuid()->toString()),
                ],
            ],
        ],
    ],
];
