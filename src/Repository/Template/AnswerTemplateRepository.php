<?php

namespace App\Repository\Template;

use App\Entity\Template\AnswerTemplate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnswerTemplate|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnswerTemplate|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnswerTemplate[]    findAll()
 * @method AnswerTemplate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerTemplateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnswerTemplate::class);
    }
}
