<?php

namespace App\Manager\Template;

use App\Entity\Template\QuestionTemplate;
use Doctrine\ORM\EntityManagerInterface;

class QuestionTemplateManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(QuestionTemplate $questionTemplate): void
    {
        $this->entityManager->persist($questionTemplate);
        $this->entityManager->flush();
    }
}
