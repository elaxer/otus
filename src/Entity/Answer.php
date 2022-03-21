<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ответ на вопрос
 */
#[ORM\Table(name: 'answers')]
#[ORM\Index(name: 'answer__question_id__index', columns: ['question_id'])]
#[ORM\Entity]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'answers')]
    private Question $question;

    #[ORM\Column(type: 'string', options: ['comment' => 'Текст ответа на вопрос'])]
    private string $text;

    #[ORM\Column(type: 'boolean', options: ['comment' => 'Является ли этот ответ правильным'])]
    private bool $isRight;

    public function __construct(Question $question, string $text, bool $isRight)
    {
        $this->question = $question;
        $this->text = $text;
        $this->isRight = $isRight;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function isRight(): bool
    {
        return $this->isRight;
    }

    public function setText(string $text): Answer
    {
        $this->text = $text;
        return $this;
    }

    public function setIsRight(bool $isRight): Answer
    {
        $this->isRight = $isRight;
        return $this;
    }
}
