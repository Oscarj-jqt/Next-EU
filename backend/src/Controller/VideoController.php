<?php

namespace App\Controller;

use App\Dto\CreateVideoRequest;
use App\Dto\GetVideosRequest;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class VideoController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/api/create-video', name: 'createVideo', methods: ['POST'])]
    public function create(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $createVideoRequest = new CreateVideoRequest(
            userId: $data['userId'],
            videoUrl: $data['videoUrl'],
        );

        // Validation
        $violations = $validator->validate($createVideoRequest);
        if (count($violations) > 0) {
            return new JsonResponse(
                data: ['errors' => (string) $violations],
                status: JsonResponse::HTTP_BAD_REQUEST
            );
        }

        // Retrieve the user
        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($createVideoRequest->getUserId());

        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        // Create Video entity
        $video = new Video();
        $video->setUser($user);
        $video->setVideoUrl($createVideoRequest->getVideoUrl());
        $video->setCreatedAt(new \DateTimeImmutable());

        // Persist to the database
        $this->entityManager->persist($video);
        $this->entityManager->flush();

        return new JsonResponse(
            data: ['message' => 'Video created successfully'],
            status: JsonResponse::HTTP_CREATED
        );
    }

    #[Route('/api/get-videos', name: 'getVideos', methods: ['GET'])]
    public function getVideos(Request $request, ValidatorInterface $validator): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $createVideoRequest = new GetVideosRequest(
            country: $data['country'],
        );

        $violations = $validator->validate($createVideoRequest);
        if (count($violations) > 0) {
            return new JsonResponse(
                data: ['errors' => (string) $violations],
                status: JsonResponse::HTTP_BAD_REQUEST
            );
        }

        $userId = 1;

        $user = $this->entityManager
            ->getRepository(User::class)
            ->find($userId);

        if (!$user) {
            return new JsonResponse(
                data: ['message' => 'User not found'],
                status: JsonResponse::HTTP_NOT_FOUND
            );
        }

        $videos = $this->entityManager
            ->getRepository(Video::class)
            ->createQueryBuilder('v')
            ->leftJoin('v.ratedByUsers', 'r')
            ->leftJoin('v.user', 'u')
            ->addSelect('COUNT(r.id) as likeCount')
            ->addSelect(
                'CASE WHEN :currentUser MEMBER OF v.ratedByUsers THEN true ELSE false END as isLikedByCurrentUser'
            )
            ->where('v.user != :currentUser')
            ->andWhere('u.country = :countryFilter')
            ->setParameter('currentUser', $user)
            ->setParameter('countryFilter', $createVideoRequest->getCountry())
            ->groupBy('v.id')
            ->orderBy('v.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        $result = array_map(function (Video $videoData) {
            /** @var Video $video */
            $video = $videoData[0];
            $likeCount = $videoData['likeCount'];
            $isLikedByCurrentUser = $videoData['isLikedByCurrentUser'];

            return [
                'id' => $video->getId(),
                'videoUrl' => $video->getVideoUrl(),
                'user' => $video->getUser(),
                'createdAt' => $video->getCreatedAt()->format('Y-m-d H:i:s'),
                'likeCount' => $likeCount,
                'isLikedByCurrentUser' => $isLikedByCurrentUser,
            ];
        }, $videos);

        return new JsonResponse(
            data: $result,
            status: JsonResponse::HTTP_OK
        );
    }
}
