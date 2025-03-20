<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateVideoRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'User ID is required')]
        public int $userId,

        #[Assert\NotBlank(message: 'Video URL is required')]
        #[Assert\Url(message: 'Invalid URL format')]
        public string $videoUrl,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getVideoUrl(): string
    {
        return $this->videoUrl;
    }
}
