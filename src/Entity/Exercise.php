<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Задание, упражнение
 */
#[ORM\Table(name: 'exercises')]
#[ORM\Entity]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', options: ['comment' => 'Название упражнения'])]
    private string $name;

    #[ORM\Column(type: 'string', options: ['comment' => 'Время в секундах на выполнение задания'], nullable: true)]
    private ?int $timeToComplete;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'exercise')]
    private Collection $questions;

    public function __construct(string $name, ?int $timeToComplete)
    {
        $this->questions = new ArrayCollection();

        $this->name = $name;
        $this->timeToComplete = $timeToComplete;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTimeToComplete(): ?int
    {
        return $this->timeToComplete;
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function setName(string $name): Exercise
    {
        $this->name = $name;
        return $this;
    }

    public function setTimeToComplete(?int $timeToComplete): Exercise
    {
        $this->timeToComplete = $timeToComplete;
        return $this;
    }

    public function addQuestion(Question $question): void
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
        }
    }

    public function removeQuestion(Question $question): void
    {
        if ($this->questions->contains($question)) {
            $this->questions->remove($question);
        }
    }
}
