<?php

namespace App\Http\Action\Blog;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 07.08.18
 * Time: 23:33
 */
class ShowAction
{
  public function __invoke(ServerRequestInterface $request)
  {
    $id = $request->getAttribute('id');
    if ($id > 5) {
      return new HtmlResponse('Undefined page', 404);
    }
    return new JsonResponse(['id' => $id, 'title' => 'Post #' . $id]);
  }
}