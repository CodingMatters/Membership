<?php

$config      = [];

$configFiles = [
    require __DIR__ . '/autoload/middleware.config.php',
    require __DIR__ . '/autoload/dependencies.config.php',
    require __DIR__ . '/autoload/router.config.php',
    require __DIR__ . '/autoload/navigator.config.php',
    require __DIR__ . '/autoload/templates.config.php',
    require __DIR__ . '/autoload/translator.config.php', // optional
    require __DIR__ . '/autoload/codingmatters.global.php', // required
];

foreach ($configFiles as $configFile) {
    $config = \Zend\Stdlib\ArrayUtils::merge($config, $configFile);
}
//var_dump($config); exit;
return $config;
