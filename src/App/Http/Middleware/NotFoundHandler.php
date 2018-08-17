<?php

namespace App\Http\Middleware;

use Zend\Diactoros\Response\HtmlResponse;

class NotFoundHandler
{
    public function __invoke()
    {
        return new HtmlResponse('Undefined page', 404);
    }
}