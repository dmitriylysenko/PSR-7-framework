<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 07.08.18
 * Time: 23:48
 */

namespace Tests\App\Http\Action;


use App\Http\Action;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class HelloActionTest extends TestCase
{
  public function testGuest()
  {
    $action = new Action\HelloAction();

    $request  = new ServerRequest();
    $response = $action($request);

    self::assertEquals(200, $response->getStatusCode());
    self::assertEquals('Hello, Guest!', $response->getBody()->getContents());
  }

  public function testJohn()
  {
    $action = new Action\HelloAction();

    $request  = (new ServerRequest())->withQueryParams(['name' => 'John']);
    $response = $action($request);

    self::assertEquals('Hello, John!', $response->getBody()->getContents());
  }
}