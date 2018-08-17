<?php

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class BasicAuthMiddleware implements MiddlewareInterface
{
    public const ATTRIBUTE = '_user';

    private $users;
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(array $users, ResponseInterface $response)
    {
        $this->users = $users;
        $this->response = $response;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $username = $request->getServerParams()['PHP_AUTH_USER'] ?? null;
        $password = $request->getServerParams()['PHP_AUTH_PW'] ?? null;

        if(!empty($username) && !empty($password)) {
            foreach ($this->users as $name => $pass) {
                if($username === $name && $password === $pass) {
                    return $handler->handle($request->withAttribute(self::ATTRIBUTE, $name));;
                }
            }
        }

        return $this->response->withStatusCode(401)->withHeader('WWW-Authenticate', 'Basic realm=Restricted area');

    }
}