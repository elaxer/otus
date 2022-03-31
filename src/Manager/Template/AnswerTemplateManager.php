<?php

namespace App\Manager\Template;

use App\Entity\Template\AnswerTemplate;
use Doctrine\ORM\EntityManagerInterface;

class AnswerTemplateManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(AnswerTemplate $answerTemplate): void
    {
        $this->entityManager->persist($answerTemplate);
        $this->entityManager->flush();
    }
}
