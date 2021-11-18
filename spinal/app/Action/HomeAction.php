<?php

namespace App\Action;

use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomeAction
{
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response
    ): ResponseInterface {
        $textResponse = 'Hello, World! <br>';
        $textResponse .= 'Today is: '.Carbon::now().' <br>';
        $textResponse .= 'Yesterday was: '.Carbon::yesterday();


        $response->getBody()->write($textResponse);

        return $response;
    }
}