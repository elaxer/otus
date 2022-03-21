<?php

namespace App\Entity\Template;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Шаблон занятия, упражнения
 */
#[ORM\Table(name: 'exercise_templates')]
#[ORM\Entity]
class ExerciseTemplate
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getTimeToComplete(): ?int
    {
        return $this->timeToComplete;
    }

    public function getQuestionTemplates(): Collection
    {
        return $this->questionTemplates;
    }
}
