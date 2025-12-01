<?php

namespace Static\Public;

use Static\Core\View;
use Static\Core\HandlerInterface;

class AboutHandler implements HandlerInterface
{
    public function handle(...$params): mixed
    {
        View::renderWithLayout("public/about", "main");
        return null;
    }
}