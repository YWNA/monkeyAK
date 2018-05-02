<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands

$stdClassArray = [
    "AKCommand"
];

$container = new \Monkey\Container();
foreach ($stdClassArray as $stdClass){
    $stdClass = "\\Monkey\\Command\\{$stdClass}";
    $application->add(new $stdClass($container));
}

return $application;