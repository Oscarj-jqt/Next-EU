<?php

namespace App\Controller;

use App\Dto\CreateVideoRequest;
use App\Dto\GetVideosRequest;
use App\Service\VideoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class VideoController extends AbstractController
{
    public function __construct(
        private readonly VideoService $videoService,
        private readonly EntityManagerInterface $entityManager
    ) {}

    #[Route('/api/create-video', name: 'createVideo', methods: ['POST'])]
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $createVideoRequest = new CreateVideoRequest(
            title: $data['title'],
            category: $data['category'],
            country: $data['country'],
            userId: $data['userId'],
            videoUrl: $data['videoUrl'],
            description: $data['description'],
            thumbnail: $data['thumbnail'] ?? null,
        );

        // Validation
        $violations = $validator->validate($createVideoRequest);
        if (count($violations) > 0) {
            return new JsonResponse(
                data: ['errors' => (string)$violations],
                status: JsonResponse::HTTP_BAD_REQUEST
            );
        }

        // Retrieve the user
        $user = $this->getDoctrine()->getRepository(User::class)->find($createVideoRequest->getUserId());
        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        // Create video
        $video = $this->videoService->createVideo($createVideoRequest, $user);

        return new JsonResponse(
            data: ['message' => 'Video created successfully', 'videoId' => $video->getId()],
            status: JsonResponse::HTTP_CREATED
        );
    }

    #[Route('/api/save-videos', name: 'saveVideos', methods: ['POST'])]
    public function saveVideos(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $videoData = $data['videos'];


        $saveVideoRequests = array_map(fn($video) => new SaveVideoRequest(
            title: $video['title'],
            category: $video['category'],
            country: $video['country'],
            userId: $video['userId'],
            videoUrl: $video['videoUrl'],
            description: $video['description'] ?? null,
            thumbnail: $video['thumbnail'] ?? null,
            googleMapsUrl: $video['googleMapsUrl'] ?? null
        ), $videoData);

        // Validation
        $violations = [];
        foreach ($saveVideoRequests as $request) {
            $violations[] = $this->validator->validate($request);
        }

        foreach ($violations as $violation) {
            if (count($violation) > 0) {
                return new JsonResponse(
                    data: ['errors' => (string)$violation],
                    status: JsonResponse::HTTP_BAD_REQUEST
                );
            }
        }

        $savedVideos = $this->videoService->saveVideos($saveVideoRequests);

        return new JsonResponse(
            data: ['message' => 'Videos saved successfully', 'savedVideos' => $savedVideos],
            status: JsonResponse::HTTP_OK
        );
    }

    #[Route('/api/get-videos', name: 'getVideos', methods: ['GET'])]
    public function getVideos(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Creating the GetVideosRequest object from the incoming data
        $getVideosRequest = new GetVideosRequest(
            category: $data['category'],
            country: $data['country'],
            userId: $data['userId'] ?? null
        );

        // Validation
        $violations = $validator->validate($getVideosRequest);
        if (count($violations) > 0) {
            return new JsonResponse(
                data: ['errors' => (string)$violations],
                status: JsonResponse::HTTP_BAD_REQUEST
            );
        }

        // Retrieve user if userId is provided
        $user = null;
        if ($getVideosRequest->getUserId()) {
            $user = $this->entityManager
                ->getRepository(User::class)
                ->find($getVideosRequest->getUserId());
        }

        // Get videos based on category and country (you can modify this if needed)
        $videos = $this->entityManager
            ->getRepository(Video::class)
            ->findBy(
                [
                    'category' => $getVideosRequest->getCategory(),
                    'country' => $getVideosRequest->getCountry(),
                ],
                ['createdAt' => 'DESC'],
                //The limit we display
                10
            );

        $result = array_map(function (Video $video) use ($user) {
            return [
                'id' => $video->getId(),
                'title' => $video->getTitle(),
                'description' => $video->getDescription(),
                'category' => $video->getCategory(),
                'country' => $video->getCountry(),
                'isFromCurrentUser' => $user && $video->getUser() === $user,
                'videoUrl' => $video->getVideoUrl(),
                'thumbnail' => $video->getThumbnail(),
                'createdAt' => $video->getCreatedAt()->format('Y-m-d H:i:s'),
            ];
        }, $videos);

        return new JsonResponse(
            data: $result,
            status: JsonResponse::HTTP_OK
        );
    }
}
