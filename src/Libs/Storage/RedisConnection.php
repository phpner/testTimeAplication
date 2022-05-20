<?php

namespace Phpner\TestDatePrime\Libs\Storage;

use Exception;
use Predis\Client;

class RedisConnection implements StorageContract
{
    /**
     * @return Client
     * @throws Exception
     */
    public static function getConnect(): Client
    {
        try {
            return new Client(
                [
                    'scheme' => 'tcp',
                    'host' => $_ENV['REDIS_HOST'],
                    'port' => $_ENV['REDIS_PORT'],
                ]
            );
        } catch (Exception $e) {
            //TODO обработчик ошибок.
            throw new Exception("Error!: " . $e->getMessage() . "<br/>");
        }
    }
}
