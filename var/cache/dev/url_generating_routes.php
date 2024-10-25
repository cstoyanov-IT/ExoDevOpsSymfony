<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app_provider_index' => [[], ['_controller' => 'App\\Controller\\ProviderController::index'], [], [['text', '/providers/']], [], [], []],
    'app_provider_new' => [[], ['_controller' => 'App\\Controller\\ProviderController::new'], [], [['text', '/providers/new']], [], [], []],
    'app_provider_show' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'app_provider_edit' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'app_provider_delete' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'app_service_index' => [[], ['_controller' => 'App\\Controller\\ServiceController::index'], [], [['text', '/services/']], [], [], []],
    'app_service_new' => [[], ['_controller' => 'App\\Controller\\ServiceController::new'], [], [['text', '/services/']], [], [], []],
    'app_service_show' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
    'app_service_edit' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::edit'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
    'app_service_delete' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
    'App\Controller\ProviderController::index' => [[], ['_controller' => 'App\\Controller\\ProviderController::index'], [], [['text', '/providers/']], [], [], []],
    'App\Controller\ProviderController::new' => [[], ['_controller' => 'App\\Controller\\ProviderController::new'], [], [['text', '/providers/new']], [], [], []],
    'App\Controller\ProviderController::show' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'App\Controller\ProviderController::edit' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'App\Controller\ProviderController::delete' => [['id'], ['_controller' => 'App\\Controller\\ProviderController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/providers']], [], [], []],
    'App\Controller\ServiceController::index' => [[], ['_controller' => 'App\\Controller\\ServiceController::index'], [], [['text', '/services/']], [], [], []],
    'App\Controller\ServiceController::new' => [[], ['_controller' => 'App\\Controller\\ServiceController::new'], [], [['text', '/services/']], [], [], []],
    'App\Controller\ServiceController::show' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
    'App\Controller\ServiceController::edit' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::edit'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
    'App\Controller\ServiceController::delete' => [['id'], ['_controller' => 'App\\Controller\\ServiceController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/services']], [], [], []],
];
