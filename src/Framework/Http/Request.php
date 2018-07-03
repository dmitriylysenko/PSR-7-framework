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
    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getParsedBody()
    {
        return $_POST ?: null;
    }
}