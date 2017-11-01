<?php

namespace Piotr\DateTimeExamples\Tests;

use PHPUnit\Framework\TestCase;
use Piotr\DateTimeExamples\FormTimeline;

class FormTimelineTest extends TestCase
{
    public function testIsActive()
    {
        $now = new \DateTimeImmutable('2017-05-01 00:00:00', new \DateTimeZone('UTC'));
        $opening = $now;
        $closing = $opening->add(new \DateInterval('P2M'));

        $timeline = new FormTimeline($now, $opening, $closing);
        $this->assertTrue($timeline->isActive());
    }

    public function testIsInactive()
    {
        $now = new \DateTimeImmutable('2017-05-01 00:00:00', new \DateTimeZone('UTC'));
        $opening = $now->add(new \DateInterval('P1D'));
        $closing = $opening->add(new \DateInterval('P2M'));

        $timeline = new FormTimeline($now, $opening, $closing);
        $this->assertFalse($timeline->isActive());
    }

    public function testEarlyBird()
    {
        $now = new \DateTimeImmutable('2017-05-01 00:00:00', new \DateTimeZone('UTC'));
        $opening = $now;
        $earlyBird = $opening->add(new \DateInterval('P7D'));
        $closing = $opening->add(new \DateInterval('P2M'));

        $timeline = new FormTimeline($now, $opening, $closing, $earlyBird);
        $this->assertTrue($timeline->isEarlyBird());
    }

    public function testNotAnEarlyBird()
    {
        $opening = new \DateTimeImmutable('2017-05-01 00:00:00', new \DateTimeZone('UTC'));
        $earlyBird = $opening->add(new \DateInterval('P7D'));
        $now = $earlyBird->add(new \DateInterval('PT1S'));
        $closing = $opening->add(new \DateInterval('P2M'));

        $timeline = new FormTimeline($now, $opening, $closing, $earlyBird);
        $this->assertFalse($timeline->isEarlyBird());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidOpeningDates()
    {
        $now = new \DateTimeImmutable('2017-05-01 00:00:00', new \DateTimeZone('UTC'));
        $opening = $now;
        $closing = $opening->sub(new \DateInterval('PT1S'));

        new FormTimeline($now, $opening, $closing);
    }

    /**
     * @dataProvider getInvalidEarlyBirdDates
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidEarlyBirdDates(string $date)
    {
        $utc = new \DateTimeZone('UTC');
        $now = new \DateTimeImmutable('2017-05-01 00:00:00', $utc);
        $opening = $now;
        $closing = $opening->add(new \DateInterval('P2M'));
        $earlyBird = new \DateTimeImmutable($date, $utc);

        new FormTimeline($now, $opening, $closing, $earlyBird);
    }

    public function getInvalidEarlyBirdDates()
    {
        return [
            ['2017-04-30 23:59:59'],
            ['2017-07-01 00:00:00'],
        ];
    }
}
