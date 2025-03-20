<?php

namespace App\Rule;

use App\Entity\Challenge;
use Doctrine\ORM\EntityManagerInterface;

class GetCurrentActiveChallengeRule
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function applies(): ?Challenge
    {
        return $this->entityManager
            ->getRepository(Challenge::class)
            ->createQueryBuilder('c')
            ->where('c.validUntil >= :today')
            ->setParameter('today', new \DateTime())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
