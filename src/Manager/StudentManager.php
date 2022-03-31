<?php

namespace App\Manager;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;

class StudentManager
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function save(Student $student): void
    {
        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }

    public function delete(Student $student): void
    {
        $this->entityManager->remove($student);
        $this->entityManager->flush();
    }
}
