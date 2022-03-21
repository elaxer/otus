<?php

namespace App\Repository\Template;

use App\Entity\Template\ExerciseTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExerciseTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciseTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciseTemplate[]    findAll()
 * @method ExerciseTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciseTemplate::class);
    }
}