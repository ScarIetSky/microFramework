<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 015 15.08.18
 * Time: 9:53
 */

namespace Tests\Framework\Http;

use Framework\Http\RequestFactory;
use PHPUnit\Framework\TestCase;

class RequestFactoryTest extends TestCase
{
    public function testGlobal() :void
    {
        $request = RequestFactory::fromGlobals(['val1' => 'value'], ['body1' => 'body']);
        self::assertEquals(['val1' => 'value'], $request->getQueryParams());
        self::assertEquals(['body1' => 'body'], $request->getParsedBody());
    }
}