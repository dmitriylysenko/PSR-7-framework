<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 31.07.18
 * Time: 1:09
 */

namespace Framework\Http\Router\Exception;


class RouteNotFoundException extends \LogicException
{
  private $name;
  private $params;

  /**
   * RouteNotFoundException constructor.
   * @param $name
   * @param array $params
   */
  public function __construct($name, array $params, \Throwable $previous = null)
  {
    parent::__construct('RegexpRoute "' . $name . '" not found.', 0, $previous);
    $this->name   = $name;
    $this->params = $params;
  }

  /**
   * @return mixed
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getParams(): array
  {
    return $this->params;
  }


}