<?php

namespace App\Entity\Template;

use Doctrine\ORM\Mapping as ORM;

/**
 * Шаблон ответа на вопрос
 */
#[ORM\Table(name: 'answer_templates')]
#[ORM\Index(name: 'answer_templates__question_template_id__index')]
class AnswerTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: QuestionTemplate::class, inversedBy: 'answerTemplates')]
    private QuestionTemplate $questionTemplate;

    #[ORM\Column(type: 'string', options: ['comment' => 'Текст ответа на вопрос'])]
    private string $text;

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
}
