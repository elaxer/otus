<?php

namespace App\Entity\Template;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Шаблон занятия, упражнения
 */
#[ORM\Table(name: 'exercise_templates')]
#[ORM\Entity]
class ExerciseTemplate implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', options: ['comment' => 'Название упражнения'])]
    private string $name;

    #[ORM\Column(type: 'string', options: ['comment' => 'Время в секундах на выполнение задания'], nullable: true)]
    private ?int $timeToComplete;

    #[ORM\OneToMany(targetEntity: QuestionTemplate::class, mappedBy: 'exerciseTemplate')]
    private Collection $questionTemplates;

    public function __construct(string $name, ?int $timeToComplete)
    {
        $this->questionTemplates = new ArrayCollection();

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

    /**
     * @return Collection|QuestionTemplate[]
     */
    public function getQuestionTemplates(): Collection
    {
        return $this->questionTemplates;
    }

    public function setName(string $name): ExerciseTemplate
    {
        $this->name = $name;

        return $this;
    }

    public function setTimeToComplete(?int $timeToComplete): ExerciseTemplate
    {
        $this->timeToComplete = $timeToComplete;

        return $this;
    }

    public function addQuestionTemplate(QuestionTemplate $questionTemplate): void
    {
        if (!$this->questionTemplates->contains($questionTemplate)) {
            $this->questionTemplates->add($questionTemplate);
        }
    }

    public function removeQuestionTemplate(QuestionTemplate $questionTemplate): void
    {
        if ($this->questionTemplates->contains($questionTemplate)) {
            $this->questionTemplates->remove($questionTemplate);
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'timeToComplete' => $this->timeToComplete,
            'questionTemplates' => $this->questionTemplates->toArray(),
        ];
    }
}
