<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ученик, студент
 */
#[ORM\Table(name: 'students')]
#[ORM\Entity]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', options: ['comment' => 'Почта ученика'], unique: true)]
    private string $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
