<?php

namespace App\Http\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 07.08.18
 * Time: 23:07
 */
class HelloAction
{
  public function __invoke(ServerRequestInterface $request)
  {
    $name = $request->getQueryParams()['name'] ?? 'Guest';
    return new HtmlResponse('Hello ' . $name . '!');
  }

}