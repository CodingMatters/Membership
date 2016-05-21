<?php

use CodingMatters\Kernel;
use CodingMatters\Membership;

return [
    "dependencies" =>  [
        'aliases'       => [],
        'invokables'    => [],
        'factories'     => [
            Membership\Page\LoginPage::class        => Kernel\Factory\PageFactory::class,
            Membership\Page\ProfilePage::class      => Kernel\Factory\PageFactory::class,
            Membership\Page\RegistrationPage::class => Kernel\Factory\PageFactory::class,
        ],
    ],
    'routes' => [
        [
            'name' => 'login',
            'path' => '/login',
            'middleware' => Membership\Page\LoginPage::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'register',
            'path' => '/register',
            'middleware' => Membership\Page\RegistrationPage::class,
            'allowed_methods' => ['GET'],
        ],
        [
//            'name' => 'account-recovery',
//            'path' => '/recover/account',
//            'middleware' => Faculty\Page\ProfilePage::class,
//            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'account',
            'path' => '/account',
            'middleware' => Membership\Page\ProfilePage::class,
            'allowed_methods' => ['GET'],
        ]
    ]
];
