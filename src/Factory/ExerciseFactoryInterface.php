<?php

namespace App\Factory;

use App\Entity\Course;
use App\Entity\Exercise;
use App\Entity\Template\ExerciseTemplate;

/**
 * Фабрика для создания курсов
 */
interface ExerciseFactoryInterface
{
    /**
     * Создать курс на основе шаблона курса
     *
     * @param ExerciseTemplate $exerciseTemplate Шаблон упражнения
     * @param Course $course Курс, для которого добавляем упражнение
     */
    public function createFromTemplate(ExerciseTemplate $exerciseTemplate, Course $course): Exercise;
}
