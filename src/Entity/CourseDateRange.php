<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Продолжительность курса
 */
#[ORM\Embeddable]
class CourseDateRange
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

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
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

}
