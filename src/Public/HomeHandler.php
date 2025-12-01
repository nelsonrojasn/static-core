<?php
namespace Static\Public;

use Static\Core\View;
use Static\Core\HandlerInterface;

class HomeHandler implements HandlerInterface
{
    public function handle(...$params): mixed
    {
        View::renderWithLayout("public/home", "main");
        return null;
    }
}
