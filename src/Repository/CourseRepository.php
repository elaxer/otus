<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    /**
     * Получить курсы студента
     *
     * @return Student[]
     */
    public function getByStudent(Student $student): array
    {
        return $this->createQueryBuilder('c')
            ->setParameter('student', $student)
            ->andWhere(':student MEMBER OF c.students')
            ->getQuery()
            ->getResult()
        ;
    }
}
