<?php

use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Initialization

$aura = new \Aura\Router\RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', \App\Http\Action\HelloAction::class);
$routes->get('about', '/about', \App\Http\Action\AboutAction::class);
$routes->get('blog', '/blog', \App\Http\Action\Blog\IndexAction::class);
$routes->get('blog_show', '/blog/{id}', \App\Http\Action\Blog\ShowAction::class, ['id' => '\d+']);
$routes->get('blog_public', '/blog/{id}', \App\Http\Action\Blog\PublicAction::class, ['id' => '\d+']);

$router = new \Framework\Http\Router\AuraRouterAdapter($routes);
$resolver = new \Framework\Http\Router\ActionResolver();

### Running

$request = ServerRequestFactory::fromGlobals();

try {
    $result = $router->match($request);

    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }

    $action = $resolver->resolve($result->getHandler());
    $response = $action($request);
} catch (\Framework\Http\Router\Exception\RequestNotMatchedException $e) {
    $response = new \Zend\Diactoros\Response\JsonResponse(['error' => 'Undefined page'], 404);
}

### PostProcessing

$response = $response->withHeader('X-Develover: Andrey');

## Sending

$emitter = new SapiEmitter();
$emitter->send($response);