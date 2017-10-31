<?php

namespace Piotr\DateTimeExamples\Tests;

use PHPUnit\Framework\TestCase;
use Piotr\DateTimeExamples\MonthPeriod;

class MonthPeriodTest extends TestCase
{
    public function testMonth()
    {
        $now = new \DateTimeImmutable('2017-11-11');
        $period = new MonthPeriod($now);

        $expectedStart = new \DateTimeImmutable('2017-11-01 00:00:00');
        $expectedEnd = new \DateTimeImmutable('2017-11-30 23:59:59');
        $this->assertEquals($expectedStart, $period->getStart());
        $this->assertEquals($expectedEnd, $period->getEnd());
    }
}
