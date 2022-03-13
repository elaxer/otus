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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return Exercise
     */
    public function getExercise(): Exercise
    {
        return $this->exercise;
    }

    /**
     * @return Collection
     */
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
}
