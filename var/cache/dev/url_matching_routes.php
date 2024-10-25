<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/providers' => [
            [['_route' => 'app_provider_index', '_controller' => 'App\\Controller\\ProviderController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'app_provider_new', '_controller' => 'App\\Controller\\ProviderController::new'], null, ['POST' => 0], null, false, false, null],
        ],
        '/services' => [
            [['_route' => 'app_service_index', '_controller' => 'App\\Controller\\ServiceController::index'], null, ['GET' => 0], null, true, false, null],
            [['_route' => 'app_service_new', '_controller' => 'App\\Controller\\ServiceController::new'], null, ['POST' => 0], null, true, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/providers/(\\d+)(?'
                    .'|(*:61)'
                .')'
                .'|/services/([^/]++)(?'
                    .'|(*:90)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        61 => [
            [['_route' => 'app_provider_show', '_controller' => 'App\\Controller\\ProviderController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'app_provider_edit', '_controller' => 'App\\Controller\\ProviderController::edit'], ['id'], ['PUT' => 0, 'PATCH' => 1], null, false, true, null],
            [['_route' => 'app_provider_delete', '_controller' => 'App\\Controller\\ProviderController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        90 => [
            [['_route' => 'app_service_show', '_controller' => 'App\\Controller\\ServiceController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'app_service_edit', '_controller' => 'App\\Controller\\ServiceController::edit'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'app_service_delete', '_controller' => 'App\\Controller\\ServiceController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
