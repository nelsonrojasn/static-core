<?php
namespace Static\Core;

interface HandlerInterface
{
    public function handle(...$params): mixed;
}
