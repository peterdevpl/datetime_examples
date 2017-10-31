<?php

namespace Piotr\DateTimeExamples;

class MonthPeriod
{
    private $now;

    public function __construct(\DateTimeImmutable $now)
    {
        $this->now = $now;
    }

    public function getStart(): \DateTimeImmutable
    {
        return $this->now->modify('first day of this month midnight');
    }

    public function getEnd(): \DateTimeImmutable
    {
        return $this->now->modify('first day of next month midnight -1 second');
    }
}
