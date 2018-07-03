<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 27.06.18
 * Time: 19:51
 */

namespace Framework\Http;

class Request
{
  private $queryParams;
  private $parsedBody;

  /**
   * Request constructor.
   * @param array $queryParams
   * @param null $parsedBody
   */
  public function __construct(array $queryParams = [], $parsedBody = null)
  {
    $this->queryParams = $queryParams;
    $this->parsedBody  = $parsedBody;
  }

  /**
   * @return array
   */
  public function getQueryParams(): array
  {
    return $this->queryParams;
  }

  /**
   * @param array $query
   * @return Request
   */
  public function withQueryParams(array $query)
  {
    $this->queryParams = $query;
    return $this;
  }

  /**
   * @return null
   */
  public function getParsedBody()
  {
    return $this->parsedBody;
  }

  /**
   * @param $data
   * @return Request
   */
  public function withParsedBody($data)
  {
    $this->parsedBody = $data;
    return $this;
  }
}