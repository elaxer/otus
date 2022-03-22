<?php

namespace App\Manager\Template;

use App\Entity\Template\ExerciseTemplate;
use Doctrine\ORM\EntityManagerInterface;

class ExerciseTemplateManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(ExerciseTemplate $exerciseTemplate): void
    {
        $this->entityManager->persist($exerciseTemplate);
        $this->entityManager->flush();
    }
}
