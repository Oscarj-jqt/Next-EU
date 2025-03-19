<?php

namespace App\Controller;

use App\Dto\CreateVideoRequest;
use App\Dto\GetVideosRequest;
use App\Entity\Video;
use App\Entity\User;
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
title: $data['title'],
description: $data['description'],
category: $data['category'],
country: $data['country'],
userId: $data['userId'],
videoUrl: $data['videoUrl'],
thumbnail: $data['thumbnail'] ?? null,
googleMapsUrl: $data['googleMapsUrl'] ?? null
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
$video->setTitle($createVideoRequest->getTitle());
$video->setDescription($createVideoRequest->getDescription());
$video->setCategory($createVideoRequest->getCategory());
$video->setCountry($createVideoRequest->getCountry());
$video->setUser($user);
$video->setVideoUrl($createVideoRequest->getVideoUrl());
$video->setThumbnail($createVideoRequest->getThumbnail());
$video->setGoogleMapsUrl($createVideoRequest->getGoogleMapsUrl());
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

$getVideosRequest = new GetVideosRequest(
category: $data['category'],
country: $data['country'],
userId: $data['userId']
);

// Validation
$violations = $validator->validate($getVideosRequest);
if (count($violations) > 0) {
return new JsonResponse(
data: ['errors' => (string) $violations],
status: JsonResponse::HTTP_BAD_REQUEST
);
}

// Retrieve user
$user = null;
if ($getVideosRequest->getUserId()) {
$user = $this->entityManager
->getRepository(User::class)
->find($getVideosRequest->getUserId());
}

// Get videos
$videos = $this->entityManager
->getRepository(Video::class)
->findBy(
[
'category' => $getVideosRequest->getCategory(),
'country' => $getVideosRequest->getCountry(),
],
['createdAt' => 'DESC']
);

// Prepare result
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
'googleMapsUrl' => $video->getGoogleMapsUrl(),
'createdAt' => $video->getCreatedAt()->format('Y-m-d H:i:s'),
];
}, $videos);

return new JsonResponse(
data: $result,
status: JsonResponse::HTTP_OK
);
}
}
