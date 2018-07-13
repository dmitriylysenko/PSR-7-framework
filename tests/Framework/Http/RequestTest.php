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
  public function testEmpty(): void
  {
    $request = new Request();

    self::assertEquals([], $request->getQueryParams());
    self::assertNull($request->getParsedBody());
  }

  public function testQueryParams(): void
  {
    $request = (new Request())
      ->withQueryParams($data = [
        'name' => 'John',
        'age'  => 28
      ]);

    self::assertEquals($data, $request->getQueryParams());
    self::assertNull($request->getParsedBody());
  }

  public function testParseBody(): void
  {
    $request = (new Request())
      ->withParsedBody($data = ['title' => 'Title']);

    self::assertEquals([], $request->getQueryParams());
    self::assertEquals($data, $request->getParsedBody());
  }


}