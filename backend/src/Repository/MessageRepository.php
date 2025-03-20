<?php

namespace App\Repository;

use App\Entity\Message;
use App\Enum\CategoryEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    /**
     * @return Message[] Returns an array of Message objects
     */
    public function findMessagesByCategory(CategoryEnum $category): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.category = :category')
            ->setParameter('category', $category)
            ->orderBy('m.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
}
