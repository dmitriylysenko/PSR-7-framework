<?php

use App\Http\Action\AboutAction;
use App\Http\Action\Blog\IndexAction;
use App\Http\Action\Blog\ShowAction;
use App\Http\Action\HelloAction;
use Aura\Router\RouterContainer;
use Framework\Http\Router\AuraRouterAdapter;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Initialization

$params = [
  'users' => [
    'admin' => 'password'
  ]
];

$aura   = new RouterContainer();
$routes = $aura->getMap();

$routes->get('home', '/', HelloAction::class);
$routes->get('about', '/about', AboutAction::class);

$routes->get('cabinet', '/cabinet', new \App\Http\Action\BasicAuthActionDecorator(
  new \App\Http\Action\CabinetAction(),
  $params['users']
));
$routes->get('blog', '/blog', IndexAction::class);
$routes->get('blog_show', '/blog/{id}', ShowAction::class)->tokens(['id' => '\d+']);

$router   = new AuraRouterAdapter($aura);
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
  $response = new HtmlResponse('Undefined page', 404);
}

###Postprocessing

$response = $response->withHeader('X-developer', 'ElisDN');

### Sending


$emitter = new SapiEmitter();
$emitter->emit($response);