<?php

namespace App\Controller;

use App\Dto\CreateUserRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/api/create-user', name: 'user_register', methods: ['POST'])]
    public function register(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $createUserRequest = new CreateUserRequest(
            country: $data['country'],
            username: $data['username'],
            password: $data['password'],
        );

        if (count($validator->validate($createUserRequest)) > 0) {
            return new JsonResponse(JsonResponse::HTTP_BAD_REQUEST);
        }

        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $createUserRequest->getUsername()]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already taken'], JsonResponse::HTTP_CONFLICT);
        }

        $user = new User();
        $user->setUsername($createUserRequest->getUsername());
        $user->setPassword($createUserRequest->getPassword());
        $user->setCountry($createUserRequest->getCountry());

        // Password hashing
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        // saving to database
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'User registered successfully',
            'username' => $user->getUsername(),
        ], Response::HTTP_CREATED);
    }
}
