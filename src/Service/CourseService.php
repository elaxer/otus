<?php

namespace App\Service;

use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Template\ExerciseTemplate;
use App\Factory\ExerciseFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Сервис для работы с курсами
 */
class CourseService
{
    public function __construct(private ExerciseFactoryInterface $exerciseFactory, private EntityManagerInterface $entityManager) {}

    /**
     * Записать студента на курс
     */
    public function registerStudent(Course $course, Student $student): void
    {
        $course->addStudent($student);

        $this->entityManager->persist($course);
        $this->entityManager->flush();
    }

    /**
     * Добавить в курс занятие на основе шаблона занятия
     */
    public function addExerciseFromTemplate(Course $course, ExerciseTemplate $exerciseTemplate): void
    {
        $exercise = $this->exerciseFactory->createFromTemplate($exerciseTemplate);

        $course->addExercise($exercise);

        $this->entityManager->persist($exerciseTemplate);
        $this->entityManager->flush();
    }
}
