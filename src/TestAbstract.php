<?php

namespace Phpner\TestDatePrime;

abstract class TestAbstract
{
    /**
     * @var int
     */
    protected int $timeCounter = 1;

    /**
     * @var float
     */
    protected float $timeQueryStart = 0.0;

    /**
     * @var float
     */
    protected float $timeQueryEnd = 0.0;

    /**
     * @var array
     */
    protected array $dataTest = [];

    /***
     * @return void
     */
    public function __construct()
    {
        $this->timeCounter = $_ENV['TEST_TIME'];
        $this->dataTest = range(1, $this->timeCounter);
    }

    /**
     * @return array
     */
    abstract public function makeTest(): array;

    /**
     * @return array
     */
    public function formatReturn(): array
    {
        return [
            'timeRows' => ($this->timeQueryEnd - $this->timeQueryStart),
            'timeRow' => ($this->timeQueryEnd - $this->timeQueryStart) / $this->timeCounter
        ];
    }

}
