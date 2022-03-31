<?php

namespace App\Service;

use App\Entity\Course;
use App\Entity\Student;
use App\Entity\Template\ExerciseTemplate;

/**
 * Сервис для работы с курсами
 */
interface CourseServiceInterface
{
    /**
     * Записать студента на курс
     *
     * @param Course $course Курс, куда необходимо записывать студента
     * @param Student $student Студент, которого необходимо записать на курс
     */
    public function registerStudent(Course $course, Student $student): void;

    /**
     * Добавить в курс занятие на основе шаблона занятия
     *
     * @param Course $course Курс, в который необходимо добавить упражнение
     * @param ExerciseTemplate $exerciseTemplate Шаблон упражнения, на основе которого необходимо создать упражнение для курса
     */
    public function addExerciseFromTemplate(Course $course, ExerciseTemplate $exerciseTemplate): void;
}
