<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Вопрос, задание
 */
#[ORM\Table(name: 'questions')]
#[ORM\Index(name: 'questions__exercise_id__index', columns: ['exercise_id'])]
#[ORM\Entity]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Текст вопроса'])]
    private string $text;

    #[ORM\ManyToOne(targetEntity: Exercise::class, inversedBy: 'questions')]
    private Exercise $exercise;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question')]
    private Collection $answers;

    public function __construct(string $text, Exercise $exercise)
    {
        $this->answers = new ArrayCollection();

        $this->text = $text;
        $this->exercise = $exercise;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): void
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
        }
    }

    public function setText(string $text): Question
    {
        $this->text = $text;
        return $this;
    }

    public function removeAnswer(Answer $answer): void
    {
        if ($this->answers->contains($answer)) {
            $this->answers->remove($answer);
        }
    }
}
