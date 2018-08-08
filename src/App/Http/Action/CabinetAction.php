<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 08.08.18
 * Time: 20:50
 */

namespace App\Http\Action;


use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class CabinetAction
{
  public function __invoke(ServerRequestInterface $request)
  {
    $username = $request->getAttribute('username');
    return new HtmlResponse('I am logged in as' . $username);
  }
}