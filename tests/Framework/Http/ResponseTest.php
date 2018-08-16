<?php

use Framework\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testEmpty() :void
    {
        $response = new Response($body = 'Body');

        self::assertEquals($body, $response->getBody()->getContents());
        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('OK', $response->getReasonPhrase());
    }

    public function test404() :void
    {
        $response = new Response($body = 'not found', $status = 404);
        self::assertEquals($body, $response->getBody()->getContents());
        self::assertEquals(mb_strlen($body), $response->getBody()->getSize());
        self::assertEquals($status, $response->getStatusCode());
        self::assertEquals('Not Found', $response->getReasonPhrase());
    }

    public function testHeaders() :void
    {
        $response = (new Response(''))
            ->withHeader($name1 = 'X-Header-1', $value1 = 'value1')
            ->withHeader($name2 = 'X-Header-2', $value2 = 'value2');

        self::assertEquals([$name1 => $value1, $name2 => $value2], $response->getHeaders());
    }
}