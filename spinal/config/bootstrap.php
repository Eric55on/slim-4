<?php

use Slim\App;
use DI\ContainerBuilder;


require_once __DIR__ . '/../vendor/autoload.php';
require_once 'tools.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();



$containerBuilder = new ContainerBuilder();

// Set up settings
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Build PHP-DI Container instance
$container = $containerBuilder->build();


// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;