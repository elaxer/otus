<?php

namespace App\Entity\Template;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;

/**
 * Шаблон ответа на вопрос
 */
#[ORM\Table(name: 'answer_templates')]
#[ORM\Index(name: 'answer_templates__question_template_id__index', columns: ['question_template_id'])]
#[ORM\Entity]
class AnswerTemplate implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: QuestionTemplate::class, inversedBy: 'answerTemplates')]
    private QuestionTemplate $questionTemplate;

    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    #[ORM\Column(type: 'string', options: ['comment' => 'Текст ответа на вопрос'])]
    private string $text;

    #[ORM\Column(type: 'boolean', options: ['comment' => 'Является ли этот ответ правильным'])]
    private bool $isRight;

    public function __construct(QuestionTemplate $questionTemplate, string $text, bool $isRight)
    {
        $this->questionTemplate = $questionTemplate;
        $this->text = $text;
        $this->isRight = $isRight;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionTemplate(): QuestionTemplate
    {
        return $this->questionTemplate;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isRight(): bool
    {
        return $this->isRight;
    }

    public function setQuestionTemplate(QuestionTemplate $questionTemplate): AnswerTemplate
    {
        $this->questionTemplate = $questionTemplate;

        return $this;
    }

    public function setText(string $text): AnswerTemplate
    {
        $this->text = $text;

        return $this;
    }

    public function setIsRight(bool $isRight): AnswerTemplate
    {
        $this->isRight = $isRight;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'isRight' => $this->isRight,
        ];
    }
}
