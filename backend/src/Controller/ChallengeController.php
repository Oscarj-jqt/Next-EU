<?php

namespace App\Controller;

use App\Dto\CreateChallengeRequest;
use App\Entity\Challenge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ChallengeController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/api/create-challenge', name: 'createChallenge', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $getRankRequest = new CreateChallengeRequest(
            validUntil: $data['validUntil'],
            title: $data['title'],
            description: $data['description'],
        );

        if (count($validator->validate($getRankRequest)) > 0) {
            return new JsonResponse(JsonResponse::HTTP_BAD_REQUEST);
        }

        $challenge = new Challenge(
            title: $getRankRequest->getTitle(),
            description: $getRankRequest->getDescription(),
            validUntil: $getRankRequest->getValidUntil(),
        );

        $this->entityManager->persist($challenge);
        $this->entityManager->flush();

        return new JsonResponse(
            status: Response::HTTP_CREATED
        );
    }
}
