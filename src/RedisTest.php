<?php

namespace Phpner\TestDatePrime;

use Exception;
use Phpner\TestDatePrime\Libs\Storage\Storage;

class RedisTest extends TestAbstract
{

    /**
     * @return array
     * @throws Exception
     */
    public function makeTest(): array
    {
        $redis = Storage::connect('redis');

        $this->timeQueryStart = microtime(true);

        foreach ($this->dataTest as $row) {
            $redis->lpush("test:redis", $row);
        }
        $this->timeQueryEnd = microtime(true);
        $redis->expire("test:redis", 2);


        return $this->formatReturn();

    }
}
