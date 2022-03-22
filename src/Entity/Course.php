<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Курс
 */
#[ORM\Entity]
#[ORM\Table(name: 'courses')]
class Course implements JsonSerializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, options: ['comment' => 'Название курса'])]
    private string $name;

    #[ORM\Embedded(class: CourseDateRange::class)]
    private CourseDateRange $courseDateRange;

    #[ORM\ManyToMany(targetEntity: Student::class, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'course_students')]
    private Collection $students;

    #[ORM\OneToMany(targetEntity: Exercise::class, mappedBy: 'course', cascade: ['persist'])]
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

    public function setName(string $name): Course
    {
        $this->name = $name;
        return $this;
    }

    public function addStudent(Student $student): void
    {
        if (!$this->students->contains($student)) {
            $this->students->add($student);
        }
    }

    public function removeStudent(Student $student): void
    {
        if ($this->students->contains($student)) {
            $this->students->remove($student);
        }
    }

    public function addExercise(Exercise $exercise): void
    {
        if (!$this->exercises->contains($exercise)) {
            $this->exercises->add($exercise);
        }
    }

    public function removeExercise(Exercise $exercise): void
    {
        if ($this->exercises->contains($exercise)) {
            $this->exercises->remove($exercise);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'courseDateRange' => $this->courseDateRange,
            'exercises' => $this->exercises->toArray(),
            'students' => $this->students->toArray(),
        ];
    }
}
