<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 14.07.18
 * Time: 1:27
 */

namespace Framework\Http;


class RequestFactory
{
  /**
   * @param array|null $query
   * @param array|null $body
   * @return Request
   */
  public static function fromGlobals(array $query = null, array $body = null): Request
  {
    return (new Request())
      ->withQueryParams($query ?: $_GET)
      ->withParsedBody($body ?: $_POST);
  }
}