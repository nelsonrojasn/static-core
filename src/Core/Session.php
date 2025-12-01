<?php

namespace Static\Core;

class Session
{
    public static function start()
    {
        session_start();
        session_regenerate_id(true);
    }

    public static function get($key) { return $_SESSION[$key] ?? null; }
    public static function set($key, $value) { $_SESSION[$key] = $value; }
}
