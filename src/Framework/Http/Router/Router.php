<?php

namespace Framework\Http\Router;

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface Router
 * @package Framework\Http\Router
 */
interface Router
{
    /**
     * @param ServerRequestInterface $request
     * @throws RequestNotMatchedException
     * @return Result
     */
    public function match(ServerRequestInterface $request) : Result;

    /**
     * @param $name
     * @param array $params
     * @throws RouteNotFoundException
     * @return string
     */
    public function generate($name, array $params = []) :string;

}