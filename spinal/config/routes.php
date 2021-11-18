<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group(
        '/',
        function (RouteCollectorProxy $app) {
            $app->get('', \App\Action\HomeAction::class)->setName('home');
        }
    );

    $app->group(
        '/users',
        function (RouteCollectorProxy $app) {
            $app->post('/create', \App\Action\User\UserCreateAction::class)->setName('createUser');
            $app->get('/getAll', \App\Action\User\getAllAction::class)->setName('getAllUsers');
            $app->post('/getById',  \App\Action\User\getByIdAction::class)->setName('getUserById');
            $app->put('/update', \App\Action\User\UserUpdateAction::class)->setName('updateUser');
            $app->delete('/delete', \App\Action\User\UserDeleteAction::class);
        }
    );
    
};



