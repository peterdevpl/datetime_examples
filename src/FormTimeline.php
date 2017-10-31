<?php

namespace Piotr\DateTimeExamples;

class FormTimeline
{
    private $now;
    private $openingDate;
    private $earlyBirdDate;
    private $closingDate;

    public function __construct(
        \DateTimeImmutable $now,
        \DateTimeImmutable $openingDate,
        \DateTimeImmutable $closingDate,
        \DateTimeImmutable $earlyBirdDate = null
    ) {
        if ($openingDate >= $closingDate) {
            throw new \InvalidArgumentException('The opening date must be earlier than the closing date');
        }

        if ($earlyBirdDate && (($earlyBirdDate < $openingDate) || ($earlyBirdDate >= $closingDate))) {
            throw new \InvalidArgumentException('The early bird date must be between opening and closing');
        }

        $this->now = $now;
        $this->openingDate = $openingDate;
        $this->earlyBirdDate = $earlyBirdDate;
        $this->closingDate = $closingDate;
    }

    public function isActive(): bool
    {
        return
            ($this->now >= $this->openingDate) &&
            ($this->now < $this->closingDate);
    }

    public function isEarlyBird(): bool
    {
        return $this->earlyBirdDate && ($this->now < $this->earlyBirdDate);
    }
}
