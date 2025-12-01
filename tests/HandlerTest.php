<?php

use PHPUnit\Framework\TestCase;
use Static\Core\HandlerInterface;
use Tests\Handlers\TestHandler;
use Tests\Handlers\ParamHandler;

class HandlerTest extends TestCase
{
    public function testSimpleHandlerReturnsHtml()
    {
        $handler = new TestHandler();

        $response = $handler->handle();

        $this->assertEquals("<h1>TEST OK</h1>", $response);
    }

    public function testParamHandlerReceivesParameter()
    {
        $handler = new ParamHandler();

        $response = $handler->handle("abc999");

        $this->assertEquals("HASH: abc999", $response);
    }

    public function testParamHandlerReceivesMultipleParams()
    {
        // Creamos un handler anónimo que use múltiples params
        $handler = new class implements HandlerInterface {
            public function handle(...$params): mixed
            {
                [$a, $b, $c] = $params;
                return "$a-$b-$c";
            }
        };

        $response = $handler->handle("uno", "dos", "tres");

        $this->assertEquals("uno-dos-tres", $response);
    }

    public function testHandlerMustImplementInterface()
    {
        $this->assertInstanceOf(
            HandlerInterface::class,
            new TestHandler()
        );
    }

    public function testHandlerThrowsExceptionIfNeeded()
    {
        $handler = new class implements HandlerInterface {
            public function handle(...$params): mixed
            {
                throw new \RuntimeException("boom");
            }
        };

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("boom");

        $handler->handle();
    }
}
