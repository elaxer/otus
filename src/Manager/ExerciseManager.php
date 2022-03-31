<?php

namespace App\Manager;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;

class ExerciseManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(Exercise $exercise): void
    {
        $this->entityManager->persist($exercise);
        $this->entityManager->flush();
    }
}
