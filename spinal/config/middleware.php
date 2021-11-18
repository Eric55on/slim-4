<?php

use Selective\BasePath\BasePathMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

$loggerFactory = $app->getContainer()->get(\App\Factory\LoggerFactory::class);
$logger = $loggerFactory->addFileHandler('error.log')->createLogger();

$errorMiddleware = $app->addErrorMiddleware(true, true, true, $logger);

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    $app->add(BasePathMiddleware::class); // <--- here

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
};