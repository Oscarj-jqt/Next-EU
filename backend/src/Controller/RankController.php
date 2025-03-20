<?php

namespace App\Controller;

use App\Dto\GetRankRequest;
use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RankController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/api/get-rank', name: 'getRank', methods: ['GET'])]
    public function register(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $getRankRequest = new GetRankRequest(
            country: $data['country'],
        );

        if (count($validator->validate($getRankRequest)) > 0) {
            return new JsonResponse(JsonResponse::HTTP_BAD_REQUEST);
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
            ->setParameter('countryFilter', $getRankRequest->getCountry())
            ->groupBy('v.id')
            ->orderBy('likeCount', 'DESC')
            ->getQuery()
            ->getResult();

        // Prepare result
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
            status: Response::HTTP_OK
        );
    }
}
