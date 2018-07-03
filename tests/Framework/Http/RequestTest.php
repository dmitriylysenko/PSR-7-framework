<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 27.06.18
 * Time: 19:51
 */

namespace Tests\Framework\Http;

use Framework\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

  protected function setUp()
  {
    parent::setUp();

    $_GET  = [];
    $_POST = [];
  }

  public function testEmpty(): void
  {
    $request = new Request();

    self::assertEquals([], $request->getQueryParams());
    self::assertNull($request->getParsedBody());
  }

  public function testQueryParams(): void
  {
    $_GET  = $data = [
      'name' => 'John',
      'age'  => 28
    ];

    $request = new Request();

    self::assertEquals($data, $request->getQueryParams());
    self::assertNull($request->getParsedBody());
  }

  public function testParseBody(): void
  {
    $_POST = $data = ['title' => 'Title'];

    $request = new Request();

    self::assertEquals([], $request->getQueryParams());
    self::assertEquals($data, $request->getParsedBody());
  }


}