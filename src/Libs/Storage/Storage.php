<?php

namespace Phpner\TestDatePrime\Libs\Storage;

use PDO;
use Predis\Client;
use Exception;

class Storage
{
    /**
     * @var array{mysql:PDO, redis: Client}
     */
    private static $connect = [
        'mysql',
        'redis'
    ];

    public static function connect($type)
    {
        $type = mb_strtolower($type);

        if (in_array($type, static::$connect) && empty(static::$connect[$type])) {
            static::$connect[$type] = static::$type();
        }

        return static::$connect[$type];
    }

    /**
     * @return PDO
     * @throws Exception
     */
    private static function mysql(): PDO
    {
        return PdoConnection::getConnect();
    }

    /**
     * @return Client
     * @throws Exception
     */
    private static function redis(): Client
    {
        return RedisConnection::getConnect();
    }
}
