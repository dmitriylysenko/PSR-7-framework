<?php

use App\Http\Action\AboutAction;
use App\Http\Action\Blog\IndexAction;
use App\Http\Action\Blog\ShowAction;
use App\Http\Action\HelloAction;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\Router;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Initialization

$routes = new RouteCollection();

$routes->get('home', '/', HelloAction::class);
$routes->get('about', '/about', AboutAction::class);
$routes->get('blog', '/blog', IndexAction::class);
$routes->get('blog_show', '/blog/{id}', ShowAction::class, ['id' => '\d+']);

$router   = new Router($routes);
$resolver = new \Framework\Http\ActionResolver();

### Running

$request = ServerRequestFactory::fromGlobals();
try {
  $result = $router->match($request);
  foreach ($result->getAttributes() as $attribute => $value) {
    $request = $request->withAttribute($attribute, $value);
  }
  $action   = $resolver->resolve($result->getHandler());
  $response = $action($request);
} catch (RequestNotMatchedException $e) {
  $response = new JsonResponse(['error' => 'Undefined page'], 404);
}

###Postprocessing

$response = $response->withHeader('X-developer', 'ElisDN');

### Sending


$emitter = new SapiEmitter();
$emitter->emit($response);