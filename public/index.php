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

$routes->get('home', '/', new HelloAction());
$routes->get('about', '/about', new AboutAction());
$routes->get('blog', '/blog', new IndexAction());
$routes->get('blog_show', '/blog/{id}', new ShowAction(), ['id' => '\d+']);

$router = new Router($routes);

### Running

$request = ServerRequestFactory::fromGlobals();
try {
  $result = $router->match($request);
  foreach ($result->getAttributes() as $attribute => $value) {
    $request = $request->withAttribute($attribute, $value);
  }
  /** @var callable $action */
  $action   = $result->getHandler();
  $response = $action($request);
} catch (RequestNotMatchedException $e) {
  $response = new JsonResponse(['error' => 'Undefined page'], 404);
}

###Postprocessing

$response = $response->withHeader('X-developer', 'ElisDN');

### Sending


$emitter = new SapiEmitter();
$emitter->emit($response);