<?php

use Illuminate\Database\Connection;
use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Connectors\ConnectionFactory;

use App\Factory\LoggerFactory;
use App\Handler\DefaultErrorHandler;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteParserInterface;
use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;

    return [
        'settings' => function () {
            return require __DIR__ . '/settings.php';
        },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        return AppFactory::create();
    },

    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },


    
    // Database connection
    Connection::class => function (ContainerInterface $container) {
        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make($container->get('settings')['db']);

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        $dispatcher = new \Illuminate\Events\Dispatcher();
        $connection->setEventDispatcher($dispatcher);


        $dispatcher->listen(\Illuminate\Database\Events\StatementPrepared::class, function ($event) {
            $event->statement->setFetchMode(PDO::FETCH_ASSOC);
        });

        
        return $connection;
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(Connection::class)->getPdo();
    },

    // The Slim RouterParser
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },    

    // The logger factory
    LoggerFactory::class => function (ContainerInterface $container) {
        return new LoggerFactory($container->get('settings')['logger']);
    },    

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        $logger = $container->get(LoggerFactory::class)
            ->addFileHandler('error.log')
            ->createLogger();

        $errorMiddleware = new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details'],
            $logger
        );

        $errorMiddleware->setDefaultErrorHandler($container->get(DefaultErrorHandler::class));

        return $errorMiddleware;
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },
];