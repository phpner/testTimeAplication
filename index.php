<?php

xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
$timeAppStart = microtime(true);

require_once 'vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
use Phpner\TestDatePrime\MysqlTest;
use Phpner\TestDatePrime\RedisTest;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$testObj = null;
switch ($_ENV['TEST_TYPE']) {
    case "mysql":
        $testObj = new MysqlTest();
        break;
    case "redis":
        $testObj = new RedisTest();
        break;
}

if (is_null($testObj)) {
    echo 'Тест класс не найден';
    die();
}

try {
    $result = $testObj->makeTest();
} catch (Exception $e) {
    echo $e->getMessage();
}

$result['timeAplication'] = microtime(true) - $timeAppStart;

$xhprof_data = xhprof_disable();

$XHPROF_ROOT = __DIR__."/xhprof_lib/utils/";
include_once $XHPROF_ROOT . "/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();
$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_testing");

echo "<a href='http://test-from-data-priev.ru/xhprof_html/?run={$run_id}&source=xhprof_testing\n' target='_blank'>Открыть тест</a>";

dd($result);
