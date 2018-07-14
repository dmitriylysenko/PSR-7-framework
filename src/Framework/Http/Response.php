<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 14.07.18
 * Time: 1:53
 */

namespace Framework\Http;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{

  private $headers = [];
  private $body;
  private $statusCode;
  private $reasonPhrase = '';

  private static $phrases = [
    200 => 'OK',
    301 => 'Moved Permanently',
    400 => 'Bad Request',
    403 => 'Forbidden',
    404 => 'Not Found',
    500 => 'Internal Server Error'
  ];

  /**
   * Response constructor.
   * @param $body
   * @param int $status
   */
  public function __construct($body, $status = 200)
  {
    $this->body       = $body;
    $this->statusCode = $status;
  }

  /**
   * @return mixed
   */
  public function getBody(): StreamInterface
  {
    return $this->body;
  }

  /**
   * @param $body
   * @return Response
   */
  public function withBody(StreamInterface $body): self
  {
    $new       = clone $this;
    $new->body = $body;
    return $new;
  }

  /**
   * @return int
   */
  public function getStatusCode(): int
  {
    return $this->statusCode;
  }

  /**
   * @return mixed|string
   */
  public function getReasonPhrase()
  {
    if (!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])) {
      $this->reasonPhrase = self::$phrases[$this->statusCode];
    }
    return $this->reasonPhrase;
  }

  /**
   * @param $code
   * @param string $reasonPhrase
   * @return Response
   */
  public function withStatus($code, $reasonPhrase = ''): self
  {
    $new               = clone $this;
    $new->statusCode   = $code;
    $new->reasonPhrase = $reasonPhrase;
    return $new;
  }

  /**
   * @return array
   */
  public function getHeaders(): array
  {
    return $this->headers;
  }

  /**
   * @param $header
   * @return bool
   */
  public function hasHeader($header): bool
  {
    return isset($this->headers[$header]);
  }

  /**
   * @param $header
   * @return mixed|null
   */
  public function getHeader($header)
  {
    if (!$this->hasHeader($header)) {
      return null;
    }
    return $this->headers[$header];
  }

  /**
   * @param $header
   * @param $value
   * @return Response
   */
  public function withHeader($header, $value): self
  {
    $new = clone $this;
    if ($new->hasHeader($header)) {
      unset($new->headers[$header]);
    }
    $new->headers[$header] = $value;
    return $new;
  }

}