<?php

namespace App\Http\Action;

use Zend\Diactoros\Response\HtmlResponse;

/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 07.08.18
 * Time: 23:07
 */
class AboutAction
{
  public function __invoke()
  {
    return new HtmlResponse('I am a simple site');
  }
}