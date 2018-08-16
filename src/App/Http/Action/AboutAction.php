<?php
namespace App\Http\Action;

use Zend\Diactoros\Response\JsonResponse;

class AboutAction
{
    public function __invoke()
    {
        return new JsonResponse('I\'m a simple site');
    }
}