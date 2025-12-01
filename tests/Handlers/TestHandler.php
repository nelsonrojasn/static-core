<?php

namespace Tests\Handlers;

use Static\Core\HandlerInterface;

class TestHandler implements HandlerInterface
{
    public function handle(...$params): mixed
    {
        return "<h1>TEST OK</h1>";
    }
}
