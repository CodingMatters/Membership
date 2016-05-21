<?php

use CodingMatters\Membership;

return [
    "dependencies" =>  [
        'aliases'       => [],
        'invokables'    => [],
        'factories'     => [
            Membership\Middleware\Authentication::class => Membership\Factory\AuthenticationMiddlewareFactory::class
        ]
    ],
    'middleware_pipeline' => [
    'authentication' => [
        'middleware' => [
            Membership\Middleware\Authentication::class,
//                Membership\Middleware\Authorization::class
        ],
        'priority' => PHP_INT_MAX,
    ],
    ],
];
