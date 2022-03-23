<?php

namespace App\Repository\Template;

use App\Entity\Template\AnswerTemplate;
use App\Entity\Template\QuestionTemplate;
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

    /**
     * Получить правильные шаблоны ответов на шаблон вопроса
     *
     * @return AnswerTemplate[]
     */
    public function getRightAnswerForQuestion(QuestionTemplate $questionTemplate): array
    {
        return $this->createQueryBuilder('a')
            ->andWhere(['a.questionTemplate = :questionTemplate'])
            ->setParameter('questionTemplate', $questionTemplate)
            ->getQuery()
            ->getResult()
        ;
    }
}
