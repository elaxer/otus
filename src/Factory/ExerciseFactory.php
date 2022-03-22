<?php

namespace App\Factory;

use App\Entity\Answer;
use App\Entity\Exercise;
use App\Entity\Question;
use App\Entity\Template\ExerciseTemplate;

class ExerciseFactory implements ExerciseFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createFromTemplate(ExerciseTemplate $exerciseTemplate): Exercise
    {
        $exercise = new Exercise($exerciseTemplate->getName(), $exerciseTemplate->getTimeToComplete());
        foreach ($exerciseTemplate->getQuestionTemplates() as $questionTemplate) {
            $question = new Question($exercise, $questionTemplate->getText());
            foreach ($questionTemplate->getAnswerTemplates() as $answerTemplate) {
                $question->addAnswer(new Answer($question, $answerTemplate->getText(), $answerTemplate->isRight()));
            }

            $exercise->addQuestion($question);
        }

        return $exercise;
    }
}
