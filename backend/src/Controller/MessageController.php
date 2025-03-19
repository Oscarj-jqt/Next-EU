<?php

namespace App\Controller;

use App\Dto\CreateMessageRequest;
use App\Dto\GetMessagesRequest;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessageController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/api/create-message', name: 'createMessage', methods: ['POST'])]
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $createMessageRequest = new CreateMessageRequest(
            category: $data['category'],
            content: $data['content'],
            country: $data['country'],
            userId: $data['userId']
        );

        if (count($validator->validate($createMessageRequest)) > 0) {
            return new JsonResponse(status: JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($createMessageRequest->getUserId());

        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        $message = new Message();
        $message->setCategory($createMessageRequest->getCategory());
        $message->setContent($createMessageRequest->getContent());
        $message->setCountry($createMessageRequest->getCountry());
        $message->setUser($user);

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return new JsonResponse(status: JsonResponse::HTTP_OK);
    }

    #[Route('/api/get-messages', name: 'getMessages', methods: ['get'])]
    public function getMessages(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $getMessagesRequest = new GetMessagesRequest(
            category: $data['category'],
            country: $data['country'],
            userId: $data['userId']
        );

        if (count($validator->validate($getMessagesRequest)) > 0) {
            return new JsonResponse(status: JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = null;
        if ($getMessagesRequest->getUserId()) {
            $user = $this->entityManager
                ->getRepository(User::class)
                ->find($getMessagesRequest->getUserId());
        }

        $messages = $this->entityManager
            ->getRepository(Message::class)
            ->findBy([
                'category' => $getMessagesRequest->getCategory(),
                'country' => $getMessagesRequest->getCountry(),
            ], ['createdAt' => 'DESC']
            );

        $result = array_map(function (Message $message) use ($user) {
            return [
                'id' => $message->getId(),
                'category' => $message->getCategory(),
                'content' => $message->getContent(),
                'country' => $message->getCountry(),
                'isFromCurrentUser' => $user && $message->getUser() === $user,
                'createdAt' => $message->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }, $messages);

        return new JsonResponse(data: $result, status: JsonResponse::HTTP_OK);
    }
}
