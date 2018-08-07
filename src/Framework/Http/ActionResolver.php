<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 08.08.18
 * Time: 0:31
 */

namespace Framework\Http;


class ActionResolver
{
  public function resolve($handler): callable
  {
    return \is_string($handler) ? new $handler() : $handler;
  }
}