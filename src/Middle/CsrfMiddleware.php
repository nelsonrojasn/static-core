<?php
namespace Static\Middle;

use Static\Security\Csrf;

class CsrfMiddleware
{
    public function handle(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if (in_array($method, ['POST','PUT','DELETE'])) {
            Csrf::validate();
        }
    }
}
