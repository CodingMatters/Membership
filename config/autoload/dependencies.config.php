<?php

use CodingMatters\Membership;

return [
    "dependencies" =>  [
        'aliases'       => [],
        'invokables'    => [
            Zend\Authentication\AuthenticationServiceInterface::class => Membership\Service\AuthenticationService::class
        ],
        'factories'     => []
    ]
];
