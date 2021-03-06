<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 08.08.18
 * Time: 1:01
 */

namespace Framework\Http\Router;


use Aura\Router\Exception\RouteNotFound;
use Aura\Router\RouterContainer;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class AuraRouterAdapter implements Router
{
  private $aura;

  /**
   * AuraRouterAdapter constructor.
   * @param $aura
   */
  public function __construct(RouterContainer $aura)
  {
    $this->aura = $aura;
  }

  /**
   * @param ServerRequestInterface $request
   * @throws RequestNotMatchedException
   * @return Result
   */
  public function match(ServerRequestInterface $request): Result
  {
    $matcher = $this->aura->getMatcher();
    if ($route = $matcher->match($request)) {
      return new Result($route->name, $route->handler, $route->attributes);
    }
    throw new RequestNotMatchedException($request);
  }

  /**
   * @param $name
   * @param array $params
   * @throws RouteNotFoundException
   * @return string
   */
  public function generate($name, array $params = []): string
  {
    $generator = new $this->aura->getGenerator();
    try {
      return $generator->generate($name, $params);
    } catch (RouteNotFound $e) {
      throw new RouteNotFoundException($name, $params, $e);
    }
  }
}