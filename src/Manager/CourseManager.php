<?php

namespace App\Manager;

use App\Entity\Course;
use Doctrine\ORM\EntityManagerInterface;

class CourseManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(Course $course): void
    {
        $this->entityManager->persist($course);
        $this->entityManager->flush();
    }
}
