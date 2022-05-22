<?php

namespace Phpner\TestDatePrime;

use Exception;
use Phpner\TestDatePrime\Libs\Storage\PdoConnection;

class MysqlTest extends TestAbstract
{
    /**
     * @return array
     * @throws Exception
     */
    public function makeTest(): array
    {
        $db = PdoConnection::getConnect();

        try {
            $db->beginTransaction();

            $this->timeQueryStart = microtime(true);
            foreach ($this->dataTest as $row) {
                $db->exec("INSERT INTO test_table (`value`) VALUES (".$row.")");
            }

            $this->timeQueryEnd = microtime(true);

            $db->commit();
        } catch (Exception $e) {
            $db->rollback();
            throw new Exception($e->getMessage());
        }

        return $this->formatReturn();
    }
}
