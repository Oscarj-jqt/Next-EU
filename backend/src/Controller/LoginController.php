<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/login', name: 'user_login', methods: ['POST'])]
    public function login(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return new JsonResponse(['message' => 'Username and password are required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // checking if user exists
        $user = $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        // Verify password
        if (!$passwordHasher->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Invalid password'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        return new JsonResponse([
            'message' => 'Login successful',
            'username' => $user->getUsername(),
        ], JsonResponse::HTTP_OK);
    }
}
