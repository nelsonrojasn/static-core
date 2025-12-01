<?php
namespace Static\Middle;

use Static\Core\Response;

class SameOrigin
{
    public function handle(): void
    {
        $origin = $_SERVER['HTTP_ORIGIN'] ?? null;
        $host   = $_SERVER['HTTP_HOST'] ?? null;

        if ($origin && !str_contains($origin, $host)) {
            Response::text("Forbidden (same-origin)", 403);
        }
    }
}
