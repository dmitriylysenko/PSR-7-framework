<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 31.07.18
 * Time: 1:00
 */

namespace Framework\Http\Router\Exception;


use Psr\Http\Message\ServerRequestInterface;

class RequestNotMatchedException extends \LogicException
{
  private $request;

  /**
   * RequestNotMatchedException constructor.
   * @param ServerRequestInterface $request
   */
  public function __construct(ServerRequestInterface $request)
  {
    parent::__construct('Matches not found.');
    $this->request = $request;
  }

  /**
   * @return ServerRequestInterface
   */
  public function getRequest(): ServerRequestInterface
  {
    return $this->request;
  }


}