<?php
namespace Framework\Http\Router;

use Framework\Http\Router\Route\RegExpRoute;
use \Framework\Http\Router\Route\Route;

/**
 * Class RouteCollection
 * @package Framework\Http\Router
 */
/**
 * Class RouteCollection
 * @package Framework\Http\Router
 */
class RouteCollection
{
    /**
     * @var array
     */
    private $routes = [];

    public function addRoute(Route $route) :void
    {
        $this->routes[] = $route;
    }

    public function add($name, $pattern, $handler, array $methods, array $tokens = []) :void
    {
        $this->addRoute(new RegExpRoute($name, $pattern, $handler, $methods, $tokens));
    }

    /**
     * @param $name
     * @param $pattern
     * @param $handler
     * @param array $tokens
     */
    public function any($name, $pattern, $handler, array $tokens)
    {
        $this->routes[] = new RegExpRoute($name, $pattern, $handler, [], $tokens);
    }

    /**
     * @param $name
     * @param $pattern
     * @param $handler
     * @param array $tokens
     */
    public function get($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = new RegExpRoute($name, $pattern, $handler, ['GET'], $tokens);
    }

    /**
     * @param $name
     * @param $pattern
     * @param $handler
     * @param array $tokens
     */
    public function post($name, $pattern, $handler, array $tokens = [])
    {
        $this->routes[] = new RegExpRoute($name, $pattern, $handler, ['POST'], $tokens);
    }


    /**
     * @return array
     */
    public function getRoutes() :array
    {
        return $this->routes;
    }
}