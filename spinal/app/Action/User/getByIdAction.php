<?php

namespace App\Action\User;

use App\Domain\User\Service\UserReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class getByIdAction
{
    protected $userReader;

    public function __construct(UserReader $userReader)
    {
        $this->userReader = $userReader;    
    }

    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface 
    {
        $params = (array)$request->getQueryParams('id');

        $result = $this->userReader->getById($params['id']);

        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);        
    }

}