<?php

namespace App\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use App\Domain\User\Service\UserReader;

final class getAllAction
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
        $result = [
            'users' => $this->userReader->getAll()
        ];        

        $response->getBody()->write((string)json_encode($result));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);        
    }

}