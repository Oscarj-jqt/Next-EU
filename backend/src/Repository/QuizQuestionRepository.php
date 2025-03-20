<?php

namespace App\Repository;

use App\Entity\QuizQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizQuestion>
 */
class QuizQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,
    ) {
        parent::__construct($registry, QuizQuestion::class);
    }

    /**
     * @return QuizQuestion[]
     */
    public function findRandomQuestions(int $limit = 5): array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('RAND()')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
