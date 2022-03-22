<?php

namespace App\Service;

use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Template\ExerciseTemplate;
use App\Factory\ExerciseFactoryInterface;
use App\Manager\CourseManager;
use App\Manager\ExerciseManager;

class CourseService implements CourseServiceInterface
{
    public function __construct(
        private ExerciseFactoryInterface $exerciseFactory,
        private CourseManager $courseManager,
        private ExerciseManager $exerciseManager,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function registerStudent(Course $course, Student $student): void
    {
        $course->addStudent($student);

        $this->courseManager->save($course);
    }

    /**
     * {@inheritDoc}
     */
    public function addExerciseFromTemplate(Course $course, ExerciseTemplate $exerciseTemplate): void
    {
        $exercise = $this->exerciseFactory->createFromTemplate($exerciseTemplate, $course);

        $course->addExercise($exercise);

        $this->exerciseManager->save($exercise);
    }
}
