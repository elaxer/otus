<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Продолжительность курса
 */
#[ORM\Embeddable]
class CourseDateRange implements JsonSerializable
{
    #[ORM\Column(type: 'date')]
    private DateTimeInterface $startDate;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $endDate;

    public function __construct(DateTimeInterface $startDate, DateTimeInterface $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * Является ли курс активным
     *
     * @param DateTimeInterface $today Сегодняшняя дата
     */
    public function isActive(DateTimeInterface $today = new DateTimeImmutable('today')): bool
    {
        return $today >= $this->startDate && $today <= $this->endDate;
    }

    public function setStartDate(DateTimeInterface $startDate): CourseDateRange
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function setEndDate(DateTimeInterface $endDate): CourseDateRange
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'startDate' => $this->startDate->format('Y-m-d'),
            'endDate' => $this->endDate->format('Y-m-d'),
        ];
    }
}
