<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 29.07.18
 * Time: 1:20
 */

namespace Framework\Http\Router;


class RouteCollection
{
  private $routes = [];

  /**
   * @param Route $route
   */
  public function addRoute(Route $route): void
  {
    $this->routes[] = $route;
  }

  /**
   * @param $name
   * @param $pattern
   * @param $handler
   * @param array $methods
   * @param array $tokens
   */
  public function add($name, $pattern, $handler,array $methods, array $tokens = []): void
  {
    $this->addRoute(new Route($name, $pattern, $handler, $methods, $tokens));
  }
  /**
   * @param $name
   * @param $pattern
   * @param $handler
   * @param array $tokens
   */
  public function any($name, $pattern, $handler, array $tokens = []): void
  {
    $this->addRoute(new Route($name, $pattern, $handler, [], $tokens));
  }

  /**
   * @param $name
   * @param $pattern
   * @param $handler
   * @param array $tokens
   */
  public function get($name, $pattern, $handler, array $tokens = []): void
  {
    $this->addRoute(new Route($name, $pattern, $handler, ['GET'], $tokens));
  }

  /**
   * @param $name
   * @param $pattern
   * @param $handler
   * @param array $tokens
   */
  public function post($name, $pattern, $handler, array $tokens = []): void
  {
    $this->addRoute(new Route($name, $pattern, $handler, ['POST'], $tokens));
  }

  /**
   * @return array
   */
  public function getRoutes(): array
  {
    return $this->routes;
  }

}