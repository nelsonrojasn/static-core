<?php

namespace Tests\Handlers;

use Static\Core\HandlerInterface;

class ParamHandler implements HandlerInterface
{
    public function handle(...$params): mixed
    {
        [$hash] = $params;
        return "HASH: $hash";
    }
}
