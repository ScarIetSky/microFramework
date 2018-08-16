<?php

namespace Framework\Http;

class RequestFactory
{
    public static function fromGlobals(array $query = null, array $body = null): Request
    {
        return (new Request())->withParsedBody($body ?: $_POST)->withQueryParams($query ?: $_GET);
    }

}