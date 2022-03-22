<?php

namespace App\Entity\Template;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Шаблон вопроса
 */
#[ORM\Table(name: 'question_templates')]
#[ORM\Index(name: 'question_templates__exercise_template_id__index', columns: ['exercise_template_id'])]
#[ORM\Entity]
class QuestionTemplate implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Текст вопроса'])]
    private string $text;

    #[ORM\ManyToOne(targetEntity: ExerciseTemplate::class, inversedBy: 'questionTemplates')]
    private ExerciseTemplate $exerciseTemplate;

    #[ORM\OneToMany(targetEntity: AnswerTemplate::class, mappedBy: 'questionTemplate')]
    private Collection $answerTemplates;

    public function __construct(string $text, ExerciseTemplate $exerciseTemplate)
    {
        $this->answerTemplates = new ArrayCollection();

        $this->text = $text;
        $this->exerciseTemplate = $exerciseTemplate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getExerciseTemplate(): ExerciseTemplate
    {
        return $this->exerciseTemplate;
    }

    /**
     * @return Collection|AnswerTemplate[]
     */
    public function getAnswerTemplates(): Collection
    {
        return $this->answerTemplates;
    }

    public function setText(string $text): QuestionTemplate
    {
        $this->text = $text;
        return $this;
    }

    public function addAnswerTemplate(AnswerTemplate $answerTemplate): void
    {
        if (!$this->answerTemplates->contains($answerTemplate)) {
            $this->answerTemplates->add($answerTemplate);
        }
    }

    public function removeAnswerTemplate(AnswerTemplate $answerTemplate): void
    {
        if ($this->answerTemplates->contains($answerTemplate)) {
            $this->answerTemplates->remove($answerTemplate);
        }
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'answerTemplates' => $this->answerTemplates->toArray(),
        ];
    }
}
