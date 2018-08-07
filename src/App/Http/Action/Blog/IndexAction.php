<?php

namespace App\Http\Action\Blog;

use Zend\Diactoros\Response\JsonResponse;

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 07.08.18
 * Time: 23:32
 */
class IndexAction
{
  public function __invoke()
  {
    return new JsonResponse([
      ['id' => 2, 'title' => 'The Second Post'],
      ['id' => 1, 'title' => 'The First Post']
    ]);
  }
}