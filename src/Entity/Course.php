<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Курс
 */
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Название курса'])]
    private string $name;

    #[ORM\Embedded(class: CourseDateRange::class)]
    private CourseDateRange $courseDateRange;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'courses')]
    #[ORM\JoinTable(name: 'course_students')]
    private Collection $students;

    #[ORM\OneToMany(targetEntity: Exercise::class, mappedBy: 'course')]
    private Collection $exercises;

    public function __construct(string $name, CourseDateRange $courseDateRange)
    {
        $this->students = new ArrayCollection();
        $this->exercises = new ArrayCollection();

        $this->name = $name;
        $this->courseDateRange = $courseDateRange;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCourseDateRange(): CourseDateRange
    {
        return $this->courseDateRange;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function getExercises(): Collection
    {
        return $this->exercises;
    }
}
