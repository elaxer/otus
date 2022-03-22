<?php

namespace App\Factory;

use App\Entity\Exercise;
use App\Entity\Template\ExerciseTemplate;

/**
 * Фабрика для создания курсов
 */
interface ExerciseFactoryInterface
{
    /**
     * Создать курс на основе шаблона курса
     */
    public function createFromTemplate(ExerciseTemplate $exerciseTemplate): Exercise;
}
