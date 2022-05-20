<?php

namespace Phpner\TestDatePrime\Libs\Storage;

use Exception;
use PDOException;
use PDO;
use Phpner\TestDatePrime\Libs\Storage\StorageContract;

class PdoConnection implements StorageContract
{
    /**
     * @return PDO
     * @throws Exception
     */
    public static function getConnect(): PDO
    {
        try {
            $conn = $_ENV['DB_CONNECTION'] . ":host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'];
            return new PDO($conn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        } catch (PDOException $e) {
            //TODO обработчик ошибок.
            throw new Exception("Error!: " . $e->getMessage() . "<br/>");
        }
    }
}
