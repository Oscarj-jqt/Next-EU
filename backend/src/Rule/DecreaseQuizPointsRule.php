<?php

namespace App\Rule;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class DecreaseQuizPointsRule
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function apply(User $user): mixed
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->update(User::class, 'u')
            ->set('u.points', 'u.points - 1')
            ->where('u.id = :id')
            ->setParameter('id', $user->getId())
            ->getQuery()
            ->execute();
    }
}
