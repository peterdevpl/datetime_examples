<?php

namespace Piotr\DateTimeExamples\Tests;

use PHPUnit\Framework\TestCase;
use Piotr\DateTimeExamples\MonthPeriod;

class MonthPeriodTest extends TestCase
{
    /**
     * @dataProvider getDateRanges
     */
    public function testMonth(string $today, string $expectedStartDay, string $expectedEndDay)
    {
        $now = new \DateTimeImmutable($today);
        $period = new MonthPeriod($now);

        $expectedStart = new \DateTimeImmutable($expectedStartDay);
        $expectedEnd = new \DateTimeImmutable($expectedEndDay);
        $this->assertEquals($expectedStart, $period->getStart());
        $this->assertEquals($expectedEnd, $period->getEnd());
    }

    public function getDateRanges()
    {
        return [
            'November'  => ['2017-11-11', '2017-11-01 00:00:00', '2017-11-30 23:59:59'],
            'Leap year' => ['2016-02-11', '2016-02-01 00:00:00', '2016-02-29 23:59:59'],
        ];
    }
}
