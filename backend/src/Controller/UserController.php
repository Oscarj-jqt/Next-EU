<?php

namespace App\Controller;

use App\Dto\GetUserDetailsRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController
{
    public function __construct(
        private readonly EntityManager $entityManager,
    ) {
    }

    #[Route('/api/get-user-details/{username}', name: 'getUserDetails', methods: ['GET'])]
    public function getUserDetails(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $validateQuizRequest = new GetUserDetailsRequest(
            username: $data['username'],
        );

        if (count($validator->validate($validateQuizRequest)) > 0) {
            return new JsonResponse(status: JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => $validateQuizRequest->getUsername()]);

        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        return new JsonResponse(data: $user, status: JsonResponse::HTTP_OK);
    }
}
