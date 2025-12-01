<?php

namespace Static\Infrastructure;

class DB
{
    private static $pdo;

    public static function init($config)
    {
        self::$pdo = new \PDO($config['dsn'], $config['user'], $config['pass']);
    }

    public static function query($sql, $params = [])
    {
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
