<?php

namespace App\Service;

use App\Dto\CreateVideoRequest;
use App\Dto\GetVideosRequest;
use App\Entity\Video;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class VideoService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Method to get videos
    public function getVideos(GetVideosRequest $request): array
    {
        $qb = $this->entityManager->getRepository(Video::class)->createQueryBuilder('v');


        if ($request->getCategory()) {
            $qb->andWhere('v.category = :category')
                ->setParameter('category', $request->getCategory());
        }

        if ($request->getCountry()) {
            $qb->andWhere('v.country = :country')
                ->setParameter('country', $request->getCountry());
        }

        // 10 videos max
        $qb->setMaxResults(10)
            ->orderBy('v.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }

    // Method to create a video with dto
    public function createVideo(CreateVideoRequest $request, User $user): Video
    {
        $video = new Video();
        $video->setTitle($request->getTitle())
            ->setCategory($request->getCategory())
            ->setCountry($request->getCountry())
            ->setVideoUrl($request->getVideoUrl())
            ->setDescription($request->getDescription())
            ->setThumbnail($request->getThumbnail())
            ->setUser($user);

        // Saving new video in the database
        $this->entityManager->persist($video);
        $this->entityManager->flush();

        return $video;
    }

    // Method to save videos
    public function saveVideos(array $videoData): array
    {
        $savedVideos = [];

        foreach ($videoData as $data) {
            $video = new Video();
            $video->setTitle($data['title'])
                ->setCategory($data['category'])
                ->setCountry($data['country'])
                ->setVideoUrl($data['videoUrl'])
                ->setDescription($data['description'])
                ->setThumbnail($data['thumbnail'] ?? null);

            $this->entityManager->persist($video);
            $savedVideos[] = $video;
        }


        $this->entityManager->flush();

        return $savedVideos;
    }


}
