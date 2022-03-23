<?php

namespace App\Factory;

use App\Entity\Exercise;
use App\Entity\Template\ExerciseTemplate;

interface ExerciseFactoryInterface
{
    public function createFromTemplate(ExerciseTemplate $exerciseTemplate): Exercise;
}
